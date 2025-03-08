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
                        <li class="breadcrumb-item"><a href="{{route('admin.document.cabinet_note.index')}}">Pragati</a>
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
                        <form action="" id ="cabinet_noteForm" method="post" class="row g-3" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                               
                            <div class="col-md-6">
                                <label for="computer_no" class="form-label">Computer No.(E/P) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="computer_no" name="computer_no" placeholder="computer no">
                                @if ($errors->has('computer_no'))
                                    <span  class="invalid-feedback">
                                        <strong>{{ $errors->first('computer_no') }}</strong>
                                    </span>
                                @endif
                                <div id="computer_no_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="file_no" class="form-label">File No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="file_no" name="file_no" placeholder="L-1222/1/2024-IA-I-(R)">
                                @if ($errors->has('file_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('file_no') }}</strong>
                                    </span>
                                @endif
                                <div id="file_no_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_receipt" class="form-label">Date of Receipt <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_of_receipt" name="date_of_receipt" >
                                <div id="date_of_receipt_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Agenda <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="agenda" name="agenda" placeholder="">
                                <div id="agenda_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="action" class="form-label">Action Taken <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="action" name="action" placeholder="">
                                <div id="action_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_receipt" class="form-label">Date of Reply <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_of_reply" name="date_of_reply" >
                                <div id="date_of_reply_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="issuer_name" class="form-label">Issuer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="issuer_name" name="issuer_name" value="{{$users[0]->name}}" placeholder="" readonly>
                                <div id="issuer_name_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="issuer_designation" class="form-label">Issuer Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="issuer_designation" name="issuer_designation" value="{{$designation->name}}" placeholder="" readonly>
                                <div id="issuer_designation_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_upload" class="form-label">Date of Upload <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_of_upload" name="date_of_upload" value="{{date('Y-m-d')}}" placeholder="date of issue" readonly>
                                @if ($errors->has('date_of_upload'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_of_upload') }}</strong>
                                    </span>
                                @endif
                                <div id="date_of_upload_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="keywords" class="form-label" minlengt="5">Keywords <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="key" name="key" placeholder="">
                                <div id="key_error" style="color: red; display: none;"></div>
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
                                <div id="upload_file_error" style="color: red; display: none;"></div>
                            </div>

                            <div class = "col-md-12">
                            <div id="pdf_viewer">

                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" id="sub" class="btn btn-primary px-4">Submit</button>
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

<script type="text/javascript">
	$(document).ready(function () {
        $('#sub').click(function(e){

                if($('#computer_no').val()=="")
				{
                    $('#computer_no_error').text("Please Enter Computer No").show();
					$('#computer_no').focus();
					return false;invalid-feedback
				}

                if($('#file_no').val()=="")
				{
                    $('#file_no_error').text("Please Enter File No").show();
					$('#file_no').focus();
					return false;
				}
                var fileNoRegex = /^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u;

                if (!fileNoRegex.test($('#file_no').val())) {
                    $('#file_no_error').text("Invalid File No format. Please follow the correct format").show();
                    $('#file_no').focus();
                    return false;
                }

                if($('#date_of_reply').val()=="")
				{
                    $('#date_of_reply_error').text("Please Enter Date of Receipt").show();
					$('#date_of_reply').focus();
					return false;
				}
                
                if($('#agenda').val()=="")
				{
                    $('#agenda_error').text("Please Enter Agenda").show();
					$('#agenda').focus();
					return false;
				}

                if($('#action').val()=="")
				{
                    $('#action_error').text("Please Enter Action Taken").show();
					$('#action').focus();
					return false;
				}

                if($('#issuer_name').val()=="")
				{
                    $('#issuer_name_error').text("Please Enter Issuer Name").show();
					$('#issuer_name').focus();
					return false;
				}

                if($('#issuer_designation').val()=="")
				{
                    $('#issuer_designation_error').text("Please Enter Issuer Designation").show();
					$('#issuer_designation').focus();
					return false;
				}

                if($('#date_of_upload').val()=="")
				{
                    $('#date_of_upload_error').text("Please Enter Date of upload").show();
					$('#date_of_upload').focus();
					return false;
				}


                if($('#upload_file').val()=="")
				{
                    $('#upload_file_error').text("Please Upload File").show();
					$('#upload_file').focus();
					return false;
				}
                var keyValue = $('#key').val()
                if($('#key').val()=="")
				{
                    $('#key_error').text("Please Enter Keywords").show();
					$('#key').focus();
					return false;
				}

                else if (keyValue.length < 5)
                 {
                    $('#key_error').text("Minimum 5 characters required.").show();
                    $('#key').focus();
                    return false; 
                } 
                
            var fileInput2 = document.getElementById('upload_file');
            var file2 = fileInput2.files[0];
            var fileSize2 = file2.size; 
            var fileType2 = file2.type;
            var allowedTypes1 = ['application/pdf'];
            if (fileSize2 > "20000000" ) {
                $('#upload_file1').text("File size must be less then 20MB").show();
                //alert('File size must be less then 20MB');
				$('#upload_file').focus();
                return false;
            }

            if (!allowedTypes1.includes(fileType2)) {
                $('#upload_file1').text("Invalid file type. Allowed types are: PDF.").show();
               // alert('Invalid file type. Allowed types are: PDF.');
				$('#upload_file').focus();
                return false;
            }


                
        });
    });
</script>


<script>

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var cabinet_noteStoreUrl = "{{ url('admin/document/pragati/create') }}";
    $('#cabinet_noteForm').on('submit', function(e) {
        e.preventDefault();

        var keywords = $('#key').val();
        var formattedKeywords = keywords.trim().replace(/\s+/g, ',');
        $('#key').val(formattedKeywords);

        let formData = new FormData(this); 
        formData.append('user_id', "{{ auth()->id() }}");
        $('.invalid-feedback').text('').hide(); 

        $.ajax({
    url: cabinet_noteStoreUrl, 
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function() {
        $('.btn-primary1').prop('disabled', true).text('Submitting...');
    },
    success: function(response) {
        $('.btn-primary1').prop('disabled', false).text('Submit');
        //  alert(response);
        // window.location.href = "{{ route('admin.document.cabinet_note.index') }}";
        Swal.fire({
            title: "Success!",
            text: response.message, 
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.document.pragati.index') }}";
            }
        });
    },
    error: function(xhr) {
        console.log(xhr);
        $('.btn-primary1').prop('disabled', false).text('Submit');

        if (xhr.responseJSON && xhr.responseJSON.errors) {
            var errors = xhr.responseJSON.errors;
            $.each(errors, function(key, value) {
                $('#' + key + '_error').text(value[0]).show(); 
            });
        } else {
            Swal.fire({
                title: "Error!",
                text: xhr.responseJSON?.message || "An error occurred. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    }
});

    });
});

</script>




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
                    url: "{{ route('admin.document.pragati.get-divisions-by-user') }}",
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




