<?php

namespace App\Http\Controllers;

use App\Models\Rebuttals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\RebuttalsUpload;

class RebuttalsController extends Controller
{
public function __construct()
    {
        $this->middleware('auth');
    }

public function rebuttals(Request $request)
 {
    $rebuttals = Rebuttals::where('is_deleted', 0)->paginate(10); 
    return view('backend.document_types.rebuttals.index', compact('rebuttals'));
 }

 public function getDivisionsByUser(Request $request)
 { 
     $userId = $request->user_id;

     $user = User::find($userId);
     if ($user) {
         $divisionIds = explode(',', $user->division); 
         $divisions = Division::whereIn('id', $divisionIds)->get();

         return response()->json($divisions);
     }

     return response()->json([]);
 }


 public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $authUser = Auth::user();
            
            $designation = DB::table('users')
           ->join('designations','designations.id','=','users.designation')
           ->select('designations.name','designations.id')
           ->where('users.designation','=',$authUser->designation)
          ->first();

            //echo '<pre>'; print_r($designation); die;
    
            if ($authUser->id == 1) {
              
                $divisions = Division::all();
                $users = User::all();
            } else {
               
                $divisions = Division::where('id', $authUser->id)->get();
                $users = User::where('id', $authUser->id)->get();
            }
    
            return view('backend.document_types.rebuttals.create', compact('divisions', 'users','designation'));
        }
     

        $roleId = Auth::user()->role_id;

     
        DB::beginTransaction();
        try{

            $rules = [
              
                'computer_no' => 'required',
                'receipt_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
                'case_no' => 'required',
                'court_name' => 'required|string',
                'petitioner' => 'required|string',
                'respondent' => 'required|string',
                'subject' => 'required|string',
                'issuer_name' => 'required|string',
                'issuer_designation' => 'required|string',
                'date_of_upload' => 'required',
                'upload_file' => 'required|array|min:1', 
                'upload_file.*' => 'required|mimes:pdf,doc,docx|max:20480',
                'key' => 'required',
               
            ];

            $messages = [
             'file_no.regex'  =>'File No Should be in Correct Format',
                 'upload_file.*.mimes' => 'Each file should be in PDF format',
                 'upload_file.*.max' => 'Each file should be smaller than 20MB'
            ];

           

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                // dd($validator->errors()); 
                return response()->json(['errors' => $validator->errors()], 422);
            }
            
            // if ($validator->fails()) {
            //     return redirect()->route('admin.document.rebuttals.create')->withErrors($validator)->withInput();
            // }
            

            $new_user = Rebuttals::create([
                'computer_no' => $request->computer_no,
                'receipt_no'=> $request->receipt_no,
                'user_id' => Auth::id(),
                'court_name' => $request->court_name,
                'case_no' => $request->case_no,
                'petitioner' => $request->petitioner,
                'respondent' => $request->respondent,
                'subject' => $request->subject,
                'issuer_name' => $request->issuer_name,
                'issuer_designation' => $request->issuer_designation,
                'date_of_upload' => $request->date_of_upload,
                'uploaded_by' => $roleId,
                'keyword' => $request->key
            ]);


            $user = $request->user;

           
            if ($request->hasFile('upload_file')) {  
            $a = $request->file('upload_file');
                //dd($a);
                foreach ($a as $file) {
                    
                    $path = $file->store('rebuttals_upload', 'public');

                    RebuttalsUpload::create([
                        'file_path' => $path,
                        'user_id' => Auth::id(),
                        'record_id' => $new_user->id, 
                        'file_name' => $file->getClientOriginalName() 
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Form created successfully!']);
            //return redirect()->route('admin.document.rebuttals.index')->with('success','Form Created Successfully !!');

        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }


    public function edit(Request $request,$id)
    {
       
    $user_id = base64_decode($request->id);
    // dd($user_id);

    if($request->isMethod('get')) {
        
        $rebuttals = Rebuttals::where('id', $user_id)->first();
        // dd($rebuttals);
        $data = $rebuttals->id;
        $div = $rebuttals->user_id;

        $rebuttals_upload = RebuttalsUpload::where('record_id', $data)->get()->toArray();
        // dd($rebuttals_upload);
        //echo '<pre>'; print_r($rebuttals); die;
        $divisions = Division::where('id', $div)->first();
        // dd($divisions);
        return view('backend.document_types.rebuttals.edit', compact('divisions', 'rebuttals', 'rebuttals_upload'));
    }
    
    
    DB::beginTransaction();
    try {
       
        $validator = Validator::make($request->all(), [
            'computer_no' => 'required',
            'receipt_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
            'case_no' => 'required',
            'court_name' => 'required|string',
            'petitioner' => 'required|string',
            'respondent' => 'required|string',
            'subject' => 'required|string',
            'issuer_name' => 'required|string',
            'issuer_designation' => 'required|string',
            'key' => 'required',
            'date_of_upload' => 'required',
            'upload_file' => 'required|array|min:1', 
            'upload_file.*' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if ($validator->fails()) {
           // dd($validator->errors()->toArray());die;
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $rebuttals = Rebuttals::find($id);

        $rebuttals->update([
            'computer_no' => $request->computer_no,
            'receipt_no' => $request->receipt_no,
            'court_name' => $request->court_name,
            'case_no' => $request->case_no,
            'petitioner' => $request->petitioner,
            'respondent' => $request->respondent,
            'subject' => $request->subject,
            'issuer_name' => $request->issuer_name,
            'issuer_designation' => $request->issuer_designation,
            'date_of_upload' => $request->date_of_upload,
            'keyword' => $request->key
        ]);
     
    //$user = $request->user;

        if ($request->hasFile('upload_file')) {
            foreach ($request->file('upload_file') as $file) {
                $path = $file->store('rebuttals_upload', 'public');
                RebuttalsUpload::create([
                    'file_path' => $path,
                    'user_id' => $rebuttals->user_id,
                    'record_id' => $rebuttals->id,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        DB::commit();
        return response()->json(['message' => 'Rebuttals Updated successfully!']);
        //return redirect()->route('admin.document.rebuttals.index')->with('success', 'rebuttalsModel Updated Successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

public function deleteFile(Request $request)
{
    $filePath = $request->file_path;
    $fileId = $request->file_id;
    $deleteFromStorage = $request->delete_from_storage; 

    if ($filePath) {
        
        if ($deleteFromStorage) {
           
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                
            } else {
                
            }
        }

        $file = RebuttalsUpload::find($fileId);
        if (!$file) {
            return response()->json(['error' => 'Record not found'], 404);
        }


    }

}

public function destroy(Request $request)
    {  
        $user_id =base64_decode($request->id);
        $auth_id = Auth::user()->id;
        $privacy = Rebuttals::find($user_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $auth_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();
        return response()->json(['success'=>true]);
    }

}
