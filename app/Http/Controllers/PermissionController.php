<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PermissionController extends Controller
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
        $permission = Permission::where('is_deleted',0)->get();

        return view('backend.permission.index',compact('permission'));
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('backend.permission.create');
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
                return redirect()->route('admin.permission.create')->withErrors($validator)->withInput();
            }

            $permission_exist = Permission::where(['name'=>$request->name,'is_deleted'=>'0'])->count();

            if($permission_exist > 0)
            {
                return redirect()->route('admin.permission.create')->withErrors(['name'=>['The permission name already exists !!']])->withInput();
            }

            $new_permission = new Permission();
            $new_permission->name= $request->name;
            $new_permission->unique_key= Str::uuid()->toString();
            $new_permission->save();

            DB::commit();

            return redirect()->route('admin.permission.index')->with('success','Permission Created Successfully !!');

        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }

    public function edit(Request $request){

        $permission_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $permission = Permission::where('id', $permission_id)->first();

            return view('backend.permission.edit', compact('permission'));
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
                return redirect()->route('admin.permission.edit',['id'=>base64_encode($permission_id)])->withErrors($validator)->withInput();
            }

            $permission_exist = Permission::where(['name'=>$request->name,'is_deleted'=>'0'])->where('id','<>', $permission_id)->count();

            if($permission_exist > 0)
            {
                return redirect()->route('admin.permission.edit',['id'=>base64_encode($permission_id)])->withErrors(['name'=>['The Permission name already exists !!']])->withInput();
            }

            $new_permission = Permission::find($permission_id);
            $new_permission->name= $request->name;
            $new_permission->save();

            DB::commit();

            return redirect()->route('admin.permission.index')->with('success','Permissions Updated Successfully !!');
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function status(Request $request)
    {
        $permission_id=base64_decode($request->id);
        $type = base64_decode($request->type);

        DB::beginTransaction();
        try{

            if(stripos($type,'disable')!==false)
            {
                $users=User::where('permission_id',$permission_id)->get();
                if(count($users)>0)
                {
                    return response()->json(['success'=>false]);
                }

                $user = Permission::find($permission_id);
                $user->is_active = '0';
                $user->save();
            }
            elseif(stripos($type,'enable')!==false)
            {
                $user = Permission::find($permission_id);
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
        $permission_id =base64_decode($request->id);
        // $id = $request->id;
        // dd($permission_id);
        $user_id = Auth::user()->id;
        $users=Permission::where('id',$permission_id)
                    ->get();
            if(count($users)>0)
            {
                $privacy = Permission::find($permission_id);
                $privacy->is_deleted = '1';
                $privacy->deleted_by = $user_id;
                $privacy->deleted_at = date('Y-m-d H:i:s');
                $privacy->save();

        return response()->json(['success'=>true]);
                
            }
            return response()->json(['success'=>false]);

        // return redirect('/roles')
        //     ->with('success', 'Role deleted successfully');
    }

}

