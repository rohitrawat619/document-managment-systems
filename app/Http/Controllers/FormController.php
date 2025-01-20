<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeMemorandum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Division;

class FormController extends Controller
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

    public function officeMemorandum(Request $request)
    {
        $office_memorandum = OfficeMemorandum::from('office_memorandum as o')
                            ->select('o.*','u.name as uploader_name','d.name as division_name','ds.name as uploader_designation')
                            ->leftJoin('users as u','u.id','=','o.uploaded_by')
                            ->leftJoin('divisions as d','d.id','=','o.division_id')
                            ->leftJoin('designations as ds','ds.id','=','u.designation')
                            ->where('o.is_deleted',0)
                            ->get();

        return view('backend.document_types.office_memorandum.index',compact('office_memorandum'));
    }

    public function officeMemorandumCreate(Request $request)
    {
        if($request->isMethod('get'))
        {
            $divisions = Division::all();

            return view('backend.document_types.office_memorandum.create',compact('divisions'));
        }

        DB::beginTransaction();
        try{

            $rules = [
                'first_name'=> 'required|regex:/^[a-zA-Z]+$/u|min:1|max:255',
                'last_name'=> 'nullable|regex:/^[a-zA-Z]+$/u|min:0|max:255',
                'file_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
                'email' => 'required|email:dns,rfc|unique:users,email',
                'mobile' => 'required|regex:/^((?!(0))[0-9\s\-\+\(\)]{5,})$/',
                'division' => 'required',
                'designation' => 'required',
                'role' => 'required',
                'password' => 'required|same:confirm_password|min:10',
                'confirm_password' => 'required|string'
            ];

            $messages = [
                'name.regex' => 'The name must be combination of letter',
                'mobile.regex'=>'Mobile Number must be Valid !!',
                'email.unique'  =>'Email id has already been taken',
                'file_no.regex'  =>'File No Should be in Correct Format',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->route('admin.document_types.office_memorandum.create')->withErrors($validator)->withInput();
            }

            $mobile = preg_replace('/\D/', '', $request->input('mobile'));

            $name = trim(preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $request->input('first_name').' '.$request->input('last_name')));

            $raw_pass =$request->input('password');

            if (!preg_match("/^(?=.{10,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@%£!]).*$/", $raw_pass)){

                return redirect()->route('admin.document_types.office_memorandum.create')->withErrors(['password'=>'Password must be atleast 10 characters long including (Atleast 1 uppercase letter(A–Z), Lowercase letter(a–z), 1 number(0–9), 1 non-alphanumeric symbol(‘$@%£!’) !'])->withInput();
            }

            $new_user = OfficeMemorandum::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $name,
                'email' => $request->email,
                'phone' => $mobile,
                'phone_code' => $request->input('mobile_code'),
                'phone_iso' => $request->input('mobile_iso'),
                'division' => $request->division,
                'designation' => $request->designation,
                'role_id' => $request->role,
                'password' => bcrypt($request->password)
            ]);

            $user_name = 'omms_'.$request->first_name.($new_user->id+1);

            OfficeMemorandum::where('id',$new_user->id)->update([
                'user_name' => $user_name
            ]);

            DB::commit();

            return redirect()->route('admin.document_types.office_memorandum.index')->with('success','Form Created Successfully !!');

        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }
}
