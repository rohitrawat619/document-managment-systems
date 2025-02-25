<?php

namespace App\Http\Controllers;
use App\Models\MinutesMetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\MinutesMettingUpload;
use Illuminate\Http\Request;

class MinutesOfMetting extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function minutes_of_metting(Request $request)
    {
            $query = MinutesMetting::from('minutes_of_metting as o')
            ->select('o.*', 'u.name as uploader_name', 'd.name as division_name', 'ds.name as uploader_designation')
            ->leftJoin('users as u', 'u.id', '=', 'o.uploaded_by')
            ->leftJoin('divisions as d', 'd.id', '=', 'o.division_id')
            ->leftJoin('designations as ds', 'ds.id', '=', 'u.designation')
            ->where('o.is_deleted', 0);

            // Apply filter if 'computer_no' is provided
            if ($request->filled('search')) {
                $computer_no = $request->get('search');
                $query->where('o.computer_no', 'like', "%{$computer_no}%");
            }

            // Fetch the paginated result
            $minutes_of_metting = $query->orderBy('o.id', 'asc')->paginate(10);
                            
        return view('backend.document_types.minutes_of_metting.index',compact('minutes_of_metting'));
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

            return view('backend.document_types.minutes_of_metting.create',compact('divisions','users'));
        }

        

        $roleId = Auth::user()->role_id;

 
        DB::beginTransaction();
        try{

            $rules = [
              
    
                'date_of_Meeting' => 'required',
                'user' => 'required',
                'subject' => 'required|string',
                'agenda' => 'required|string',
                'issuer_designation' => 'required|string',
                'division' => 'required',
                'date_of_upload' => 'required',
                'upload_file' => 'required|array|min:1', 
                'upload_file.*' => 'mimes:pdf|max:20480' 
               
            ];

            $messages = [
                'file_no.regex'  =>'File No Should be in Correct Format',
                'upload_file.*.mimes' => 'Each file should be in PDF format',
                'upload_file.*.max' => 'Each file should be smaller than 20MB'
            ];

           

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                dd($validator->errors()); 
            }
            // if ($validator->fails()) {
            //     return redirect()->route('admin.document.minutes_of_metting.create')->withErrors($validator)->withInput();
            // }
            

            $new_user = MinutesMetting::create([
                'user_id' => $request->user,
                'date_of_Meeting' => $request->date_of_Meeting,
                'subject' => $request->subject,
                'agenda' => $request->agenda,
                'issuer_designation' => $request->issuer_designation,
                'division_id' => $request->division,
                'date_of_upload' => $request->date_of_upload,
                'uploaded_by' => $roleId,
                'keyword' => $request->key
            ]);


            $user = $request->user;


            if ($request->hasFile('upload_file')) {
                $uploadedFiles = $request->file('upload_file');
                foreach ($uploadedFiles as $file) {
                    
                    $path = $file->store('minutes_of_metting_uploads', 'public');

                        MinutesMettingUpload::create([
                        'file_path' => $path,
                        'user_id' => $user,
                        'record_id' => $new_user->id, 
                        'file_name' => $file->getClientOriginalName() 
                    ]);
                }
            }

            DB::commit();
            return response()->json('Form Created Successfully !!');
           // return redirect()->route('admin.document.minutes_of_metting.index')->with('success','Form Created Successfully !!');

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
        
        $minutes_of_metting = MinutesMetting::where('id', $user_id)->first();
        $data = $minutes_of_metting->id;
        $div = $minutes_of_metting->user_id;
        
        $minutes_of_metting_upload = MinutesMettingUpload::where('record_id', $data)->get()->toArray();
         //dd($minutes_of_metting_upload);
        //echo '<pre>'; print_r($minutes_of_metting); die;
        $divisions = Division::where('id', $div)->first();

        return view('backend.document_types.minutes_of_metting.edit', compact('divisions', 'minutes_of_metting', 'minutes_of_metting_upload'));
    }
    
    
    DB::beginTransaction();
    try {
       
        $validator = Validator::make($request->all(), [
          
            'date_of_Meeting' => 'required',
            'subject' => 'required|string',
            'agenda' => 'required|string',
            'issuer_designation' => 'required|string',
            'division' => 'required',
            'date_of_upload' => 'required',
            'upload_file' => 'nullable|array|min:1',
            'upload_file.*' => 'mimes:pdf|max:20480'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.document.minutes_of_metting.edit', ['id' => base64_encode($user_id)])
                             ->withErrors($validator)
                             ->withInput();
        }
        
        $minutes_of_metting = MinutesMetting::find($id);

    $minutes_of_metting->update([
        
        'date_of_Meeting' => $request->date_of_Meeting,
        'subject' => $request->subject,
        'agenda' => $request->agenda,
        'issuer_designation' => $request->issuer_designation,
        'division_id' => $request->division,
        'date_of_upload' => $request->date_of_upload,
        'keyword' => $request->key
    ]);
     
    //$user = $request->user;

        if ($request->hasFile('upload_file')) {
            foreach ($request->file('upload_file') as $file) {
                $path = $file->store('minutes_of_metting_upload', 'public');
                MinutesMettingUpload::create([
                    'file_path' => $path,
                    'user_id' => $minutes_of_metting->user_id,
                    'record_id' => $minutes_of_metting->id,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        DB::commit();
        return response()->json('Office Memorandum Updated Successfully!');
        //return redirect()->route('admin.document.minutes_of_metting.index')->with('success', 'Office Memorandum Updated Successfully!');
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

        $file = MinutesMettingUpload::find($fileId);
        if ($file) {
            $file->delete();
        }

        return response()->json(['message' => 'File deleted successfully']);
    }

    return response()->json(['error' => 'File not found'], 404);
}

public function destroy(Request $request)
    {  
        $user_id =base64_decode($request->id);
        $auth_id = Auth::user()->id;
        $privacy = MinutesMetting::find($user_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $auth_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();
        return response()->json(['success'=>true]);
    }


}
