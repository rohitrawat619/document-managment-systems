<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Designation;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index(Request $request)
    {
        // $roles = Role::where('is_deleted',0)->get();

        $search = $request->get('search');

        // If there's a search query, filter the divisions by name
        if ($search) {
            $roles = Role::where('name', 'like', '%' . $search . '%')
                ->where('is_deleted', 0)
                ->orderBy('id', 'asc')
                ->paginate(10);
        } else {
        // If no search query, just paginate all divisions
            $roles = Role::where('is_deleted', 0)
                ->orderBy('id', 'asc')
                ->paginate(10);
        }

        return view('backend.roles.index',compact('roles'));

    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            $designations = Designation::all();
            $permission = Permission::all();

            return view('backend.roles.create',compact('designations','permission'));
        }

        DB::beginTransaction();
        try{

            $rules = [
                'name'=> 'required|regex:/^[a-zA-Z][a-zA-Z0-9]+$/u|min:1|max:255',
            ];

            $messages = [
                'name.regex' => 'The name must be combination of letter or numbers'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->route('admin.roles.create')->withErrors($validator)->withInput();
            }

            $role_exist = Role::where(['name'=>$request->name,'is_deleted'=>'0'])->count();

            if($role_exist > 0)
            {
                return redirect()->route('admin.roles.create')->withErrors(['name'=>['The role name already exists !!']])->withInput();
            }

            $new_role = new Role();
            $new_role->name = $request->name;
            $new_role->permission_id = implode(",",$request->permissions); 
            $new_role->designation_id = $request->designation;
            $new_role->unique_key= Str::uuid()->toString();
            $new_role->save();

            DB::commit();

            return redirect()->route('admin.roles.index')->with('success','Role Created Successfully !!');

        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }

    public function edit(Request $request){

        $role_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $roles = Role::where('id', $role_id)->first();

            /*** fetch for designation selected bu user */

            $designations = DB::table('designations')->get(); 

            $selectedDesignations = DB::table('roles')
                ->where('id', $role_id)
                ->pluck('designation_id')
                ->toArray(); 

            
            /*** fetch for particular permission given by the user */

            $rolePermissions = explode(',', $roles->permission_id); 

            $permissions = DB::table('permissions')
                ->select('permissions.id', 'permissions.name')
                ->get();
        
            return view('backend.roles.edit', compact('roles','rolePermissions','permissions','designations','selectedDesignations'));
        }

        DB::beginTransaction();
        try{
            $rules = [
                'name'=> 'required|regex:/^[a-zA-Z][a-zA-Z0-9 ]+$/u|min:1|max:255',
            ];

            $messages = [
                'name.regex' => 'The name must be combination of letter or numbers'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->route('admin.roles.edit',['id'=>base64_encode($role_id)])->withErrors($validator)->withInput();
            }

            $role_exist = Role::where(['name'=>$request->name,'is_deleted'=>'0'])->where('id','<>', $role_id)->count();

            if($role_exist > 0)
            {
                return redirect()->route('admin.roles.edit',['id'=>base64_encode($role_id)])->withErrors(['name'=>['The role name already exists !!']])->withInput();
            }

            $new_role = Role::find($role_id);
            $new_role->name= $request->name;
            $new_role->permission_id = implode(",",$request->permissions); 
            $new_role->designation_id = $request->designation;
            $new_role->save();

            DB::commit();

            return redirect()->route('admin.roles.index')->with('success','Role Updated Successfully !!');
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function status(Request $request)
    {
        $role_id=base64_decode($request->id);
        $type = base64_decode($request->type);

        DB::beginTransaction();
        try{

            if(stripos($type,'disable')!==false)
            {
                $users=User::where('role_id',$role_id)->get();
                if(count($users)>0)
                {
                    return response()->json(['success'=>false]);
                }

                $user = Role::find($role_id);
                $user->is_active = '0';
                $user->save();
            }
            elseif(stripos($type,'enable')!==false)
            {
                $user = Role::find($role_id);
                $user->is_active = '1';
                $user->save();
            }

            DB::commit();
            return response()->json(['success'=>true,'type'=>$type,'message'=>'Status change successfully.']);
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function destroy(Request $request)
    {
        $role_id =base64_decode($request->id);
        // $id = $request->id;
        $user_id = Auth::user()->id;
        $users=User::where('role_id',$role_id)
                    ->get();
            if(count($users)>0)
            {
                return response()->json(['success'=>false]);
            }
        $privacy = Role::find($role_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $user_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();

        return response()->json(['success'=>true]);

        // return redirect('/roles')
        //     ->with('success', 'Role deleted successfully');
    }

}
