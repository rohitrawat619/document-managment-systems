<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
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
        $division = Division::where('is_deleted',0)->get();

        return view('backend.division.index',compact('division'));
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('backend.division.create');
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
                return redirect()->route('admin.division.create')->withErrors($validator)->withInput();
            }

            $division_exist = Division::where(['name'=>$request->name,'is_deleted'=>'0'])->count();

            if($division_exist > 0)
            {
                return redirect()->route('admin.division.create')->withErrors(['name'=>['The division name already exists !!']])->withInput();
            }

            $new_division = new Division();
            $new_division->name= $request->name;
            $new_division->save();

            DB::commit();

            return redirect()->route('admin.division.index')->with('success','Division Created Successfully !!');

        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }

    public function edit(Request $request){

        $division_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $division = Division::where('id', $division_id)->first();

            return view('backend.division.edit', compact('division'));
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
                return redirect()->route('admin.division.edit')->withErrors($validator)->withInput();
            }

            $division_exist = Division::where(['name'=>$request->name,'is_deleted'=>'0'])->where('id','<>', $division_id)->count();

            if($division_exist > 0)
            {
                return redirect()->route('admin.division.edit')->withErrors(['name'=>['The division name already exists !!']])->withInput();
            }

            $new_desig = Division::find($division_id);
            $new_desig->name= $request->name;
            $new_desig->save();

            DB::commit();

            return redirect()->route('admin.division.index')->with('success','Division Updated Successfully !!');
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function destroy(Request $request)
    {
        $division_id =base64_decode($request->id);
        // $id = $request->id;
        $user_id = Auth::user()->id;
        $users=User::where('division',$division_id)
                    ->get();
            if(count($users)>0)
            {
                return response()->json(['success'=>false]);
            }
        $privacy = Division::find($division_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $user_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();

        return response()->json(['success'=>true]);

        // return redirect('/roles')
        //     ->with('success', 'Role deleted successfully');
    }
}
