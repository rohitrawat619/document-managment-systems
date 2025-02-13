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
                        <li class="breadcrumb-item"><a href="{{route('admin.document.notification.index')}}">Notification</a>
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
                        <form action="{{route('admin.document.notification.create')}}" method="post" class="row g-3" enctype="multipart/form-data">
                            @csrf
                                <div class="col-md-6">
                                    <label for="User" class="form-label">User <span class="text-danger">*</span></label>
                                    <select class="form-control" name="user">
                                        <option value="">--Select--</option>
                                        @if(count($users)>0)
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('user'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            
                            @if(Auth::user()->is_admin == 1)
                                <div class="col-md-6">
                                    <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                                    <select class="form-control" name="division">
                                        <option value="">--Select--</option>
                                        <!-- Divisions will be populated dynamically based on the selected user -->
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
                                <label for="upload_file" class="form-label">Upload File <small>(In PDF Format, Max: 20MB)</small> <span class="text-danger">*</span></label>
                                    <div class="field_wrapper">
                                        <div class="file-input-group d-flex align-items-center">
                                            <input type="file" class="form-control" id="upload_file" name="upload_file[]">
                                            <a href = "javascript:void(0);" type="button" class="btn btn-primary ms-2 my-2 view_pdf">View PDF</a>
                                            <a href="javascript:void(0);" class="add_button ms-2" title="Add field">
                                                <img src="{{ url('assets/images/link-images/add-icon.png') }}" />
                                            </a>
                                        </div>
                                    </div>
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
                            <div class = "col-md-12">
                            <div id="pdf_viewer">

                            </div>
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
<script>
    $(document).ready(function(){
        var maxField = 5; 
        var addButton = $('.add_button'); 
        var wrapper = $('.field_wrapper');
        <?php $removeIconUrl = url('assets/images/link-images/remove-icon.png'); ?>
        var removeIconUrl = '{{ $removeIconUrl }}';
        
        var fieldHTML = '<div class="file-input-group d-flex align-items-center"><input type="file" class="form-control" name="upload_file[]"><a href = "javascript:void(0);" type="button" class="btn btn-primary ms-2 my-2 view_pdf">View PDF</a><a href="javascript:void(0);" class="remove_button ms-2"><img src="' + removeIconUrl + '"/></a></div>';
        var x = 1;

        // Add new file input field
        $(addButton).click(function(){
            if(x < maxField){ 
                x++; 
                $(wrapper).append(fieldHTML); 
            } else {
                alert('A maximum of ' + maxField + ' fields are allowed to be added.');
            }
        });

        // Remove file input field
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); 
            x--;
        });

        // View PDF in the same page
        $(wrapper).on('click', '.view_pdf', function() {
            var fileInput = $(this).siblings('input[type="file"]')[0]; 
            var file = fileInput.files[0]; 
            if (file && file.type === 'application/pdf') {
                var fileURL = URL.createObjectURL(file);
                var iframe = '<iframe src="' + fileURL + '" width="100%" height="600px" style="border: none;"></iframe>';
                $('#pdf_viewer').html(iframe);
            } else {
                alert("Please upload a valid PDF file to view.");
            }
        });
    });

    /*** dependent dropdown for selecting divisions by users */
    $(document).ready(function() {
        // Listen for changes on the 'user' dropdown
        $('select[name="user"]').on('change', function() {
            var userId = $(this).val(); // Get the selected user's ID

            if(userId) {
                //console.log(userId);
                // Make an AJAX request to get the corresponding divisions
                $.ajax({
                    url: "{{ route('admin.document.notification.get-divisions-by-user') }}",
                    type: 'GET',
                    data: { user_id: userId },
                    
                    success: function(response) {
                        // Clear the current division dropdown
                        $('select[name="division"]').empty();

                        // Add a default 'Select' option
                        $('select[name="division"]').append('<option value="">--Select--</option>');

                        // Populate the division dropdown with the returned divisions
                        if(response.length > 0) {
                            $.each(response, function(index, division) {
                                $('select[name="division"]').append(
                                    '<option value="' + division.id + '">' + division.name + '</option>'
                                );
                            });
                        } else {
                            $('select[name="division"]').append('<option value="">No divisions available</option>');
                        }
                    },
                    error: function() {
                        alert('Error fetching divisions.');
                    }
                });
            } else {
                // If no user is selected, clear the division dropdown
                $('select[name="division"]').empty();
                $('select[name="division"]').append('<option value="">--Select--</option>');
            }
        });
    });
</script>
@endpush
@endsection




