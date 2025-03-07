<?php

namespace App\Http\Controllers;

use App\Models\VIPReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\VIPReferenceUpload;

class VIPReferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vip_reference(Request $request)
{
    $vip_reference = VIPReference::where('is_deleted', 0)->paginate(10); 
    return view('backend.document_types.vip_reference.index', compact('vip_reference'));
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
    
            return view('backend.document_types.vip_reference.create', compact('divisions', 'users','designation'));
        }
     

        $roleId = Auth::user()->role_id;

     
        DB::beginTransaction();
        try{

            $rules = [
              
                'computer_no' => 'required',
                'file_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
                'subject' => 'required|string',
                'action' => 'required|string',
                'issuer_name' => 'required|string',
                'vip' => 'required|string',
                'issuer_designation' => 'required|string',
                'date_of_upload' => 'required',
                'date_of_receipt' => 'required',
                'date_of_sent' => 'required',
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
            

            $new_user = VIPReference::create([
                'computer_no' => $request->computer_no,
                'file_no'=> $request->file_no,
                'user_id' => Auth::id(),
                'date_of_receipt' => $request->date_of_receipt,
                'date_of_sent' => $request->date_of_sent,
                'subject' => $request->subject,
                'vip' => $request->vip,
                'action' => $request->action,
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
                    
                    $path = $file->store('vip_reference_upload', 'public');

                    VIPReferenceUpload::create([
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
        
        $vip_reference = VIPReference::where('id', $user_id)->first();
        // dd($VIPReference);
        $data = $vip_reference->id;
        $div = $vip_reference->user_id;

        $vip_reference_upload = VIPReferenceUpload::where('record_id', $data)->get()->toArray();
        // dd($VIPReference_upload);
        //echo '<pre>'; print_r($VIPReference); die;
        $divisions = Division::where('id', $div)->first();
        // dd($divisions);
        return view('backend.document_types.vip_reference.edit', compact('divisions', 'vip_reference', 'vip_reference_upload'));
    }
    
    
    DB::beginTransaction();
    try {
       
        $validator = Validator::make($request->all(), [
            'computer_no' => 'required',
            'file_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
            'subject' => 'required|string',
            'issuer_name' => 'required|string',
            'issuer_designation' => 'required|string',
            'key' => 'required',
            'date_of_upload' => 'required',
            'upload_file' => 'nullable|array|min:1',
            'upload_file.*' => 'mimes:pdf|max:20480'
        ]);

        if ($validator->fails()) {
            // return redirect()->route('admin.document.VIPReference.edit', ['id' => base64_encode($user_id)])
            //                  ->withErrors($validator)
            //                  ->withInput();
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $VIPReference = VIPReference::find($id);

        $VIPReference->update([
            'computer_no' => $request->computer_no,
            'file_no' => $request->file_no,
            'date_of_receipt' => $request->date_of_receipt,
            'subject' => $request->subject,
            'action' => $request->action,
            'issuer_name' => $request->issuer_name,
            'issuer_designation' => $request->issuer_designation,
            'date_of_upload' => $request->date_of_upload,
            'keyword' => $request->key
        ]);
     
    //$user = $request->user;

        if ($request->hasFile('upload_file')) {
            foreach ($request->file('upload_file') as $file) {
                $path = $file->store('vip_reference_upload', 'public');
                VIPReferenceUpload::create([
                    'file_path' => $path,
                    'user_id' => $VIPReference->user_id,
                    'record_id' => $VIPReference->id,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        DB::commit();
        return response()->json(['message' => 'VIP Reference Updated successfully!']);
        //return redirect()->route('admin.document.VIPReference.index')->with('success', 'VIPReferenceModel Updated Successfully!');
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

        $file = VIPReferenceUpload::find($fileId);
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
        $privacy = VIPReference::find($user_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $auth_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();
        return response()->json(['success'=>true]);
    }
}
