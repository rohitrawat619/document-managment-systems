<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Division;
use App\Models\Designation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
            $search = $request->get('search'); // Get search query

            /*** fetch designations from roles table */

            $designation = Designation::all();

            $desig = DB::table('roles')
            ->join('users','roles.id','=','users.role_id')
            ->join('designations','designations.id','=','roles.designation_id')
            ->select('designations.name','designations.id')
            ->get()->toArray();

         //   echo '<pre>';print_r($desig); die;
            
            $users = User::from('users as u')
                ->select(
                    'u.id', 
                    'u.name', 
                    'u.email', 
                    'u.phone', 
                    'u.phone_code', 
                    'u.phone_iso', 
                    'ds.name as designation_name', 
                    DB::raw('GROUP_CONCAT(dv.name) as division_name')
                )
                ->leftJoin('divisions as dv', DB::raw("FIND_IN_SET(dv.id, u.division)"), ">", DB::raw('"0"'))
                ->leftJoin('designations as ds', 'u.designation', '=', 'ds.id')
                ->where('u.is_deleted', 0)
                ->whereNotNull('u.role_id');

            // Apply search filter if there is a search query
            if ($search) {
                $users->where(function ($users) use ($search) {
                    $users->where('u.name', 'like', '%' . $search . '%') // Search by user name
                        ->orWhere('dv.name', 'like', '%' . $search . '%'); // Search by division name
                });
            }

            // Group and paginate results
            $users = $users->groupBy('u.id', 'u.name', 'u.email', 'u.phone', 'u.phone_code', 'u.phone_iso', 'ds.name')
                ->paginate(10);

            return view('backend.users.index',compact('users'));
    }


    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            $divisions = Division::all();

            $designations = Designation::all();

            $roles = Role::all();

            return view('backend.users.create',compact('divisions','designations','roles'));
        }

        //echo "<pre>"; print_r($_POST); die;

        DB::beginTransaction();
        try{

            $rules = [
                'first_name'=> 'required|regex:/^[a-zA-Z]+$/u|min:1|max:255',
                'last_name'=> 'nullable|regex:/^[a-zA-Z]+$/u|min:0|max:255',
                'email' => 'required|email:dns,rfc|unique:users,email',
                'mobile' => 'required|regex:/^((?!(0))[0-9\s\-\+\(\)]{5,})$/',
                'division' => 'required|array',
                'password' => 'required|same:confirm_password|min:10',
                'confirm_password' => 'required|string'
            ];

            $messages = [
                'name.regex' => 'The name must be combination of letter',
                'mobile.regex'=>'Mobile Number must be Valid !!',
                'email.unique'  =>'Email id has already been taken',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                //dd($validator);
                return redirect()->route('admin.users.create')->withErrors($validator)->withInput();
            }

            $mobile = preg_replace('/\D/', '', $request->input('mobile'));

            $name = trim(preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $request->input('first_name').' '.$request->input('last_name')));

            $raw_pass =$request->input('password');

            if (!preg_match("/^(?=.{10,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@%£!]).*$/", $raw_pass)){

                return redirect()->route('admin.users.create')->withErrors(['password'=>'Password must be atleast 10 characters long including (Atleast 1 uppercase letter(A–Z), Lowercase letter(a–z), 1 number(0–9), 1 non-alphanumeric symbol(‘$@%£!’) !'])->withInput();
            }

            $new_user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $name,
                'email' => $request->email,
                'phone' => $mobile,
                'phone_code' => $request->input('mobile_code'),
                'phone_iso' => $request->input('mobile_iso'),
                'division' => implode(",", $request->division),
                'designation' => $request->designation_id,
                'role_id' => $request->role_id,
                'password' => bcrypt($request->password)
            ]);

            $user_name = 'omms_'.$request->first_name.($new_user->id+1);

            User::where('id',$new_user->id)->update([
                'user_name' => $user_name
            ]);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success','User Created Successfully !!');

        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }

    public function getDesignations($roleId)
    {
        $role = Role::find($roleId);
        if (!$role) {
            return response()->json([]);
        }

        // Convert comma-separated IDs to an array
        $designationIds = explode(',', $role->designation_id);

        // Fetch matching designations
        $designations = Designation::whereIn('id', $designationIds)->get();

        return response()->json($designations);

    }

    public function edit(Request $request){

        $user_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $users = User::where('id', $user_id)->first();

            $selectedDivision = explode(',', $users->division); // Convert string to array

            $divisions = DB::table('divisions')->get();

            $designations = Designation::all();

            $roles = Role::all();

            return view('backend.users.edit', compact('users','divisions','designations','roles','selectedDivision'));
        }

        DB::beginTransaction();
        try{
            $rules = [
                'first_name'=> 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
                'last_name'=> 'nullable|regex:/^[a-zA-Z ]+$/u|min:0|max:255',
                'email' => 'required|email:dns,rfc|unique:users,email,'.$user_id,
                'mobile' => 'required|regex:/^((?!(0))[0-9\s\-\+\(\)]{5,})$/',
                'division' => 'required',
                // 'designation' => 'required'
            ];

            $messages = [
                'name.regex' => 'The name must be combination of letter',
                'mobile.regex'=>'Mobile Number must be Valid !!',
                'email.unique'  =>'Email id has already been taken',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->route('admin.users.edit',['id'=>base64_encode($user_id)])->withErrors($validator)->withInput();
            }

            $mobile = preg_replace('/\D/', '', $request->input('mobile'));

            $name = trim(preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $request->input('first_name').' '.$request->input('last_name')));

            $user = User::find($user_id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $name,
                'email' => $request->email,
                'phone' => $mobile,
                'phone_code' => $request->input('mobile_code'),
                'phone_iso' => $request->input('mobile_iso'),
                'division' => implode(",",$request->division),
                //'designation' => $request->designation,
            ]);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success','User Updated Successfully !!');
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function status(Request $request)
    {
        $user_id=base64_decode($request->id);
        $type = base64_decode($request->type);

        DB::beginTransaction();
        try{

            if(stripos($type,'disable')!==false)
            {
                $user = User::find($user_id);
                $user->is_active = '0';
                $user->save();
            }
            elseif(stripos($type,'enable')!==false)
            {
                $user = User::find($user_id);
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
        $user_id =base64_decode($request->id);
        // $id = $request->id;
        $user_id = Auth::user()->id;

        $privacy = User::find($user_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $user_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();

        return response()->json(['success'=>true]);

        // return redirect('/roles')
        //     ->with('success', 'Role deleted successfully');
    }
}
