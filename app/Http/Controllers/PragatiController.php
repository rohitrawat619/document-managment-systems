<?php

namespace App\Http\Controllers;

use App\Models\Pragati;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\PragatiUpload;


class PragatiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cabinet_note(Request $request)
{
    $cabinet_note = Pragati::where('is_deleted', 0)->paginate(10); 
    return view('backend.document_types.pragati.index', compact('cabinet_note'));
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
    
            return view('backend.document_types.pragati.create', compact('divisions', 'users','designation'));
        }
     

        $roleId = Auth::user()->role_id;

     
        DB::beginTransaction();
        try{

            $rules = [
              
                'computer_no' => 'required',
                'file_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
                'agenda' => 'required|string',
                'action' => 'required|string',
                'date_of_reply' => 'required',
                'issuer_name' => 'required|string',
                'issuer_designation' => 'required|string',
                'date_of_upload' => 'required',
                'date_of_receipt' => 'required',
                'upload_file' => 'required|array|min:1', 
                'upload_file.*' => 'mimes:pdf|max:20480',
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
            

            $new_user = Pragati::create([
                'computer_no' => $request->computer_no,
                'file_no'=> $request->file_no,
                'user_id' => Auth::id(),
                'date_of_receipt' => $request->date_of_receipt,
                'agenda' => $request->agenda,
                'action_taken' => $request->action,
                'date_of_reply' => $request->date_of_reply,
                'issuer_name' => $request->issuer_name,
                'issuer_designation' => $request->issuer_designation,
                'date_of_upload' => $request->date_of_upload,
                'uploaded_by' => $roleId,
                'keywords' => $request->key
            ]);


            $user = $request->user;

           
            if ($request->hasFile('upload_file')) {  
            $a = $request->file('upload_file');
                //dd($a);
                foreach ($a as $file) {
                    
                    $path = $file->store('pragati_uploads', 'public');

                    PragatiUpload::create([
                        'file_path' => $path,
                        'user_id' => Auth::id(),
                        'record_id' => $new_user->id, 
                        'file_name' => $file->getClientOriginalName() 
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Form created successfully!']);
            
        }
        catch (\Exception $e) {
            DB::rollback();
            return $e;
        }

    }


    public function edit(Request $request,$id)
    {
       
    $user_id = base64_decode($request->id);
    // dd($user_id);

    if($request->isMethod('get')) {
        
        $cabinet_note = Pragati::where('id', $user_id)->first();
        // dd($CabinateNote);
        $data = $cabinet_note->id;
        $div = $cabinet_note->user_id;

        $cabinet_note_upload = PragatiUpload::where('record_id', $data)->get()->toArray();
        // dd($CabinateNote_upload);
        //echo '<pre>'; print_r($CabinateNote); die;
        $divisions = Division::where('id', $div)->first();
        // dd($divisions);
        return view('backend.document_types.pragati.edit', compact('divisions', 'cabinet_note', 'cabinet_note_upload'));
    }
    
    
    DB::beginTransaction();
    try {
       
        $validator = Validator::make($request->all(), [
            'computer_no' => 'required',
            'file_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
           'agenda' => 'required|string',
            'action' => 'required|string',
            'date_of_reply' => 'required',
            'issuer_name' => 'required|string',
            'issuer_designation' => 'required|string',
            'key' => 'required',
            'date_of_upload' => 'required',
            'upload_file' => 'nullable|array|min:1',
            'upload_file.*' => 'mimes:pdf|max:20480'
        ]);

        if ($validator->fails()) {
            // return redirect()->route('admin.document.CabinateNote.edit', ['id' => base64_encode($user_id)])
            //                  ->withErrors($validator)
            //                  ->withInput();
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $CabinateNote = Pragati::find($id);

        $CabinateNote->update([
            'computer_no' => $request->computer_no,
            'file_no' => $request->file_no,
            'date_of_receipt' => $request->date_of_receipt,
            'agenda' => $request->agenda,
            'action_taken' => $request->action,
            'date_of_reply' => $request->date_of_reply,
            'issuer_name' => $request->issuer_name,
            'issuer_designation' => $request->issuer_designation,
            'date_of_upload' => $request->date_of_upload,
            'keywords' => $request->key
        ]);
     
    //$user = $request->user;

        if ($request->hasFile('upload_file')) {
            foreach ($request->file('upload_file') as $file) {
                $path = $file->store('pragati_uploads', 'public');
                PragatiUpload::create([
                    'file_path' => $path,
                    'user_id' => $CabinateNote->user_id,
                    'record_id' => $CabinateNote->id,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        DB::commit();
        return response()->json(['message' => 'Cabinet Note Updated successfully!']);
        //return redirect()->route('admin.document.CabinateNote.index')->with('success', 'CabinateNoteModel Updated Successfully!');
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

        $file = PragatiUpload::find($fileId);
        // if ($file) {
        //     $file->delete();
        // }
        if (!$file) {
            return response()->json(['error' => 'Record not found'], 404);
        }

      
    }
}
public function destroy(Request $request)
    {  
        $user_id =base64_decode($request->id);
        $auth_id = Auth::user()->id;
        $privacy = Pragati::find($user_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $auth_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();
        return response()->json(['success'=>true]);
    }

}
