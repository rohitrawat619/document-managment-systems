<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
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

    public function index(Request $request)
    {
        $designation = Designation::where('is_deleted',0)->orderBy('id', 'asc')->paginate(10);

        return view('backend.designation.index',compact('designation'));
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('backend.designation.create');
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
                return redirect()->route('admin.designation.create')->withErrors($validator)->withInput();
            }

            $designation_exist = Designation::where(['name'=>$request->name,'is_deleted'=>'0'])->count();

            if($designation_exist > 0)
            {
                return redirect()->route('admin.designation.create')->withErrors(['name'=>['The designation name already exists !!']])->withInput();
            }

            $new_designation = new Designation();
            $new_designation->name= $request->name;
            $new_designation->save();

            DB::commit();

            return redirect()->route('admin.designation.index')->with('success','Designation Created Successfully !!');

        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }

    public function edit(Request $request){

        $designation_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $designation = Designation::where('id', $designation_id)->first();

            return view('backend.designation.edit', compact('designation'));
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
                //dd('ok');
                return redirect()->route('admin.designation.edit')->withErrors($validator)->withInput();
            }

            $designation_exist = Designation::where(['name'=>$request->name,'is_deleted'=>'0'])->where('id','<>', $designation_id)->count();

            if($designation_exist > 0)
            {
                return redirect()->route('admin.designation.edit')->withErrors(['name'=>['The designation name already exists !!']])->withInput();
            }

            $new_desig = Designation::find($designation_id);
            $new_desig->name= $request->name;
            $new_desig->save();

            DB::commit();

            return redirect()->route('admin.designation.index')->with('success','Designation Updated Successfully !!');
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function destroy(Request $request)
    {
        $designation_id =base64_decode($request->id);
        // $id = $request->id;
        $user_id = Auth::user()->id;
        $users=User::where('designation',$designation_id)
                    ->get();
            if(count($users)>0)
            {
                return response()->json(['success'=>false]);
            }
        $privacy = Designation::find($designation_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $user_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();

        return response()->json(['success'=>true]);

        // return redirect('/roles')
        //     ->with('success', 'Role deleted successfully');
    }
}
