<?php

namespace App\Http\Controllers;
use App\Models\Guidelines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\GuidelinesUpload;


class GuidelineController extends Controller
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

    public function guideline(Request $request)
    {
                $query = Guidelines::from('guidelines as o')
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
                $guideline = $query->orderBy('o.id', 'asc')->paginate(10);


        return view('backend.document_types.guideline.index',compact('guideline'));
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
     
        // if($request->isMethod('get'))
        // {
        //     $divisions = Division::all();

        //     $users = User::all();

        //     return view('backend.document_types.guideline.create',compact('divisions','users'));
        // }

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
    
            return view('backend.document_types.guideline.create', compact('divisions', 'users','designation'));
        }

     

        $roleId = Auth::user()->role_id;

     
        DB::beginTransaction();
        try{

            $rules = [
              
                'computer_no' => 'required',
                'file_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
                'date_of_issue' => 'required',
                'user' => 'required',
                'subject' => 'required|string',
                'issuer_name' => 'required|string',
                'issuer_designation' => 'required|string',
                'file_type' => 'required',
                'division' => 'required',
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
                // dd($validator->errors()); // Yeh validation errors show karega
                return response()->json(['errors' => $validator->errors()], 422);
            }
            
            // if ($validator->fails()) {
            //     return redirect()->route('admin.document.guideline.create')->withErrors($validator)->withInput();
            // }
            

            $new_user = Guidelines::create([
                'computer_no' => $request->computer_no,
                'file_no'=> $request->file_no,
                'user_id' => $request->user,
                'date_of_issue' => $request->date_of_issue,
                'subject' => $request->subject,
                'issuer_name' => $request->issuer_name,
                'issuer_designation' => $request->issuer_designation,
                'file_type' => $request->file_type,
                'division_id' => $request->division,
                'date_of_upload' => $request->date_of_upload,
                'uploaded_by' => $roleId,
                'keyword' => $request->key
            ]);


            $user = $request->user;

           
            if ($request->hasFile('upload_file')) {  
            $a = $request->file('upload_file');
                //dd($a);
                foreach ($a as $file) {
                    
                    $path = $file->store('guideline_uploads', 'public');

                        GuidelinesUpload::create([
                        'file_path' => $path,
                        'user_id' => $user,
                        'record_id' => $new_user->id, 
                        'file_name' => $file->getClientOriginalName() 
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Form created successfully!']);
            //return redirect()->route('admin.document.guideline.index')->with('success','Form Created Successfully !!');

        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }

    // edit function for office memorandum and office memorandum uploads

    public function edit(Request $request,$id)
    {
       
    $user_id = base64_decode($request->id);
    // dd($user_id);

    if($request->isMethod('get')) {
        
        $guideline = Guidelines::where('id', $user_id)->first();
        // dd($guideline);
        $data = $guideline->id;
        $div = $guideline->user_id;

        $guideline_upload = GuidelinesUpload::where('record_id', $data)->get()->toArray();
        // dd($guideline_upload);
        //echo '<pre>'; print_r($guideline); die;
        $divisions = Division::where('id', $div)->first();
        // dd($divisions);
        return view('backend.document_types.guideline.edit', compact('divisions', 'guideline', 'guideline_upload'));
    }
    
    
    DB::beginTransaction();
    try {
       
        $validator = Validator::make($request->all(), [
            'computer_no' => 'required',
            'file_no'=> 'required|regex:/^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u|min:1|max:255',
            'date_of_issue' => 'required',
            'subject' => 'required|string',
            'issuer_name' => 'required|string',
            'issuer_designation' => 'required|string',
            'file_type' => 'required',
            'division' => 'required',
            'key' => 'required',
            'date_of_upload' => 'required',
            'upload_file' => 'nullable|array|min:1',
            'upload_file.*' => 'mimes:pdf|max:20480'
        ]);

        if ($validator->fails()) {
            // return redirect()->route('admin.document.guideline.edit', ['id' => base64_encode($user_id)])
            //                  ->withErrors($validator)
            //                  ->withInput();
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $guideline = Guidelines::find($id);

    $guideline->update([
        'computer_no' => $request->computer_no,
        'file_no' => $request->file_no,
        'date_of_issue' => $request->date_of_issue,
        'subject' => $request->subject,
        'issuer_name' => $request->issuer_name,
        'issuer_designation' => $request->issuer_designation,
        'file_type' => $request->file_type,
        'division_id' => $request->division,
        'date_of_upload' => $request->date_of_upload,
        'keyword' => $request->key
    ]);
     
    //$user = $request->user;

        if ($request->hasFile('upload_file')) {
            foreach ($request->file('upload_file') as $file) {
                $path = $file->store('guideline_uploads', 'public');
                GuidelinesUpload::create([
                    'file_path' => $path,
                    'user_id' => $guideline->user_id,
                    'record_id' => $guideline->id,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        DB::commit();
        return response()->json(['message' => 'Guidelines Updated Successfully!']);
        //return redirect()->route('admin.document.guideline.index')->with('success', 'Guidelines Updated Successfully!');
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

        $file = GuidelinesUpload::find($fileId);
        if ($file) {
            $file->delete();
        }

        return response()->json(['message' => 'File deleted successfully']);
    }

    return response()->json(['error' => 'File not found'], 404);
}

    // function for deleting records of office memorandum

    public function destroy(Request $request)
    {  
        $user_id =base64_decode($request->id);
        $auth_id = Auth::user()->id;
        $privacy = Guidelines::find($user_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $auth_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();
        return response()->json(['success'=>true]);
    }

    
}

