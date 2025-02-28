<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\AchievementUpload;

class AchievementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function achievenment(Request $request)
{
    $achievenment = Achievement::where('is_deleted', 0)->paginate(10); 
    return view('backend.document_types.achievenment.index', compact('achievenment'));
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
     
        if($request->isMethod('get'))
        {
            $divisions = Division::all();

            $users = User::all();

            return view('backend.document_types.achievenment.create',compact('divisions','users'));
        }

     

        $roleId = Auth::user()->role_id;

     
        DB::beginTransaction();
        try{

            $rules = [
              
                'computer_no' => 'required',
                'file_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
                'subject' => 'required|string',
                'issuer_name' => 'required|string',
                'issuer_designation' => 'required|string',
                'date_of_upload' => 'required',
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
                 dd($validator->errors()); // Yeh validation errors show karega
               // return response()->json(['errors' => $validator->errors()], 422);
            }
            
            // if ($validator->fails()) {
            //     return redirect()->route('admin.document.achievenment.create')->withErrors($validator)->withInput();
            // }
            

            $new_user = Achievement::create([
                'computer_no' => $request->computer_no,
                'file_no'=> $request->file_no,
                'user_id' => Auth::id(),
                'date_of_publication' => $request->date_of_publication,
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
                    
                    $path = $file->store('achievenment_upload', 'public');

                    AchievementUpload::create([
                        'file_path' => $path,
                        'user_id' => Auth::id(),
                        'record_id' => $new_user->id, 
                        'file_name' => $file->getClientOriginalName() 
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Form created successfully!']);
            //return response()->json('Form Created Successfully !!');
            //return redirect()->route('admin.document.achievenment.index')->with('success','Form Created Successfully !!');

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
        
        $achievenment = Achievement::where('id', $user_id)->first();
        // dd($achievement);
        $data = $achievenment->id;
        $div = $achievenment->user_id;

        $achievenment_upload = AchievementUpload::where('record_id', $data)->get()->toArray();
        // dd($achievement_upload);
        //echo '<pre>'; print_r($achievement); die;
        $divisions = Division::where('id', $div)->first();
        // dd($divisions);
        return view('backend.document_types.achievenment.edit', compact('divisions', 'achievenment', 'achievenment_upload'));
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
            // return redirect()->route('admin.document.achievement.edit', ['id' => base64_encode($user_id)])
            //                  ->withErrors($validator)
            //                  ->withInput();
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $achievement = Achievement::find($id);

        $achievement->update([
            'computer_no' => $request->computer_no,
            'file_no' => $request->file_no,
            'date_of_publication' => $request->date_of_publication,
            'subject' => $request->subject,
            'issuer_name' => $request->issuer_name,
            'issuer_designation' => $request->issuer_designation,
            'date_of_upload' => $request->date_of_upload,
            'keyword' => $request->key
        ]);
     
    //$user = $request->user;

        if ($request->hasFile('upload_file')) {
            foreach ($request->file('upload_file') as $file) {
                $path = $file->store('achievenment_upload', 'public');
                AchievementUpload::create([
                    'file_path' => $path,
                    'user_id' => $achievement->user_id,
                    'record_id' => $achievement->id,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        DB::commit();
        return response()->json(['message' => 'Achievenment Updated successfully!']);
        //return redirect()->route('admin.document.achievement.index')->with('success', 'achievementModel Updated Successfully!');
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

        $file = AchievementUpload::find($fileId);
        // if ($file) {
        //     $file->delete();
        // }
        if (!$file) {
            return response()->json(['error' => 'Record not found'], 404);
        }

       // return response()->json(['message' => 'File deleted successfully']);
    }

   // return response()->json(['error' => 'File not found'], 404);
}

public function destroy(Request $request)
    {  
        $user_id =base64_decode($request->id);
        $auth_id = Auth::user()->id;
        $privacy = Achievement::find($user_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $auth_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();
        return response()->json(['success'=>true]);
    }

}

