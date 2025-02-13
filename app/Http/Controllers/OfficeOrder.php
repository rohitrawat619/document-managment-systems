<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeOrder as OfficeOrders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Division;
use App\Models\User;
use App\Models\OfficeOrderUpload;
use Illuminate\Support\Facades\Log;

class OfficeOrder extends Controller
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

    public function officeOrder(Request $request)
    {
        $office_order = OfficeOrders::from('office_order as o')
                            ->select('o.*','u.name as uploader_name','d.name as division_name','ds.name as uploader_designation')
                            ->leftJoin('users as u','u.id','=','o.uploaded_by')
                            ->leftJoin('divisions as d','d.id','=','o.division_id')
                            ->leftJoin('designations as ds','ds.id','=','u.designation')
                            ->where('o.is_deleted',0)
                            ->get();

                            // dd($office_order);

        return view('backend.document_types.office_order.index',compact('office_order'));
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

            return view('backend.document_types.office_order.create',compact('divisions','users'));
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
                'upload_file.*' => 'mimes:pdf|max:20480' 
               
            ];

            $messages = [
                'file_no.regex'  =>'File No Should be in Correct Format',
                'upload_file.*.mimes' => 'Each file should be in PDF format',
                'upload_file.*.max' => 'Each file should be smaller than 20MB'
            ];

           

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->route('admin.document.office_order.create')->withErrors($validator)->withInput();
            }
            

            $new_user = OfficeOrders::create([
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
                'uploaded_by' => $roleId
            ]);


            $user = $request->user;


            if ($request->hasFile('upload_file')) {
                $uploadedFiles = $request->file('upload_file');
                foreach ($uploadedFiles as $file) {
                    
                    $path = $file->store('office_order_uploads', 'public');

                        OfficeOrderUpload::create([
                        'file_path' => $path,
                        'user_id' => $user,
                        'record_id' => $new_user->id, 
                        'file_name' => $file->getClientOriginalName() 
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.document.office_order.index')->with('success','Form Created Successfully !!');

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
        
        $office_order = OfficeOrders::where('id', $user_id)->first();
        $data = $office_order->id;
        $div = $office_order->user_id;
        
        $office_order_upload = OfficeOrderUpload::where('record_id', $data)->get()->toArray();
         //dd($office_order_upload);
        //echo '<pre>'; print_r($office_order); die;
        $divisions = Division::where('id', $div)->first();
        // dd($divisions);
        return view('backend.document_types.office_order.edit', compact('divisions', 'office_order', 'office_order_upload'));
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
            'date_of_upload' => 'required',
            'upload_file' => 'nullable|array|min:1',
            'upload_file.*' => 'mimes:pdf|max:20480'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.document.office_order.edit', ['id' => base64_encode($user_id)])
                             ->withErrors($validator)
                             ->withInput();
        }
        
        $office_order = officeOrders::find($id);

    $office_order->update([
        'computer_no' => $request->computer_no,
        'file_no' => $request->file_no,
        'date_of_issue' => $request->date_of_issue,
        'subject' => $request->subject,
        'issuer_name' => $request->issuer_name,
        'issuer_designation' => $request->issuer_designation,
        'file_type' => $request->file_type,
        'division_id' => $request->division,
        'date_of_upload' => $request->date_of_upload
    ]);
     
    //$user = $request->user;

        if ($request->hasFile('upload_file')) {
            foreach ($request->file('upload_file') as $file) {
                $path = $file->store('office_order_uploads', 'public');
                OfficeOrderUpload::create([
                    'file_path' => $path,
                    'user_id' => $office_order->user_id,
                    'record_id' => $office_order->id,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        DB::commit();
        return redirect()->route('admin.document.office_order.index')->with('success', 'Office Order Updated Successfully!');
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

        $file = OfficeOrderUpload::find($fileId);
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
        $privacy = OfficeOrders::find($user_id);
        $privacy->is_deleted = '1';
        $privacy->deleted_by = $auth_id;
        $privacy->deleted_at = date('Y-m-d H:i:s');
        $privacy->save();
        return response()->json(['success'=>true]);
    }

    
}
