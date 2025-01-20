@extends('layouts.backend.admin')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Document Type</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.document.office_memorandum.index')}}">Office Memorandum</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <form action="{{route('admin.document.office_memorandum.create')}}" method="post" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            @if(Auth::user()->is_admin==1)
                                <div class="col-md-6">
                                    <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                                    <select class="form-control" name="division">
                                        <option value="">--Select--</option>
                                        @if(count($divisions)>0)
                                            @foreach ($divisions as $dv)
                                                <option value="{{$dv->id}}">{{$dv->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('division'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('division') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label for="computer_no" class="form-label">Computer No.(E/P) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="computer_no" name="computer_no" placeholder="computer no">
                                @if ($errors->has('computer_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('computer_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="file_no" class="form-label">File No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="file_no" name="file_no" placeholder="L-1222/1/2024-IA-I-(R)">
                                @if ($errors->has('file_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('file_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_issue" class="form-label">Date of Issue <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_of_issue" name="date_of_issue" placeholder="date of issue">
                                @if ($errors->has('date_of_issue'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_of_issue') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="">
                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="issuer_name" class="form-label">Issuer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="issuer_name" name="issuer_name" placeholder="">
                                @if ($errors->has('issuer_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('issuer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="issuer_designation" class="form-label">Issuer Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="issuer_designation" name="issuer_designation" placeholder="">
                                @if ($errors->has('issuer_designation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('issuer_designation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_upload" class="form-label">Date of Upload <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_of_upload" name="date_of_upload" value="{{date('Y-m-d')}}" placeholder="date of issue" readonly>
                                @if ($errors->has('date_of_upload'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_of_upload') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="upload_file" class="form-label">Upload File <small>(In PDF Format, Max:20MB)</small> <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="upload_file" name="upload_file[]" multiple>
                                @if ($errors->has('upload_file'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('upload_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="file_type" class="form-label">File Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="file_type">
                                    <option value="">--Select--</option>
                                    <option value="0">Confidential</option>
                                    <option value="1">Non-Confidential</option>
                                </select>
                                @if ($errors->has('file_type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('file_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--end row-->
    </div>
</div>
@push('scripts')

@endpush
@endsection
