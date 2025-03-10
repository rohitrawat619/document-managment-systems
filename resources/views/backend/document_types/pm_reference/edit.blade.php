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
                        <li class="breadcrumb-item"><a href="{{route('admin.document.pm_reference.index')}}">PM Reference</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <form id="pm_referenceForm" action="{{ route('admin.document.pm_reference.edit', $pm_reference->id) }}" method="post" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <label for="computer_no" class="form-label">Computer No.(E/P) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="computer_no" name="computer_no" value="{{ $pm_reference->computer_no }}" placeholder="computer no">
                                @if ($errors->has('computer_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('computer_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="file_no" class="form-label">File No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="file_no" name="file_no" value="{{ $pm_reference->file_no }}" placeholder="L-1222/1/2024-IA-I-(R)">
                                @if ($errors->has('file_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('file_no') }}</strong>
                                    </span>
                                @endif
                                <div id="file_no1" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_receipt" class="form-label">Date of Receipt <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_of_receipt" name="date_of_receipt" value="{{ $pm_reference->date_of_receipt }}" placeholder="date of issue">
                                @if ($errors->has('date_of_receipt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_of_receipt') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="subject" name="subject" value="{{ $pm_reference->subject }}" placeholder="">
                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="action" class="form-label">Action Taken <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="action" name="action" value="{{ $pm_reference->action }}" >
                                <div id="action_error" style="color: red; display: none;"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="issuer_name" class="form-label">Issuer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="issuer_name" name="issuer_name" value="{{ $pm_reference->issuer_name }}" readonly>
                                @if ($errors->has('issuer_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('issuer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="issuer_designation" class="form-label">Issuer Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="issuer_designation" name="issuer_designation" value="{{ $pm_reference->issuer_designation }}" readonly>
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
                                <label for="keyword" class="form-label">Keywords <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="key" name="key" value="{{ str_replace(',', ' ', $pm_reference->keyword) }}" placeholder="">
                                @if ($errors->has('keyword'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('keyword') }}</strong>
                                    </span>
                                @endif
                                <div id="key_error" style="color: red; display: none;"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="upload_file" class="form-label">Upload File <small>(In PDF Format, Max: 20MB)</small> <span class="text-danger">*</span></label>

                                <div class="field_wrapper">
                                    @if(count($pm_reference_upload) == 0)
                                        <div class="file-input-group d-flex align-items-center">
                                            <input type="file" class="form-control" name="upload_file[]">
                                            <a href="javascript:void(0);" class="remove_button ms-2" style="display:none;">
                                                <img src="{{ url('assets/images/link-images/remove-icon.png') }}" />
                                            </a>
                                        </div>
                                    @else
                                        @foreach($pm_reference_upload as $key => $omu)
                                        <div class="file-input-group d-flex align-items-center" id="file-{{ $key }}" >
                                            <input type="file" class="form-control" name="upload_file[]" disabled>
                                            <input type="hidden" name="existing_files[]" value="{{ $omu['file_path'] }}">
                                            <span class="ms-2">{{ $omu['file_name'] }}</span>
                                            <!-- Include data-id attribute here -->
                                            <button type="button" class="view_pdf ms-2 my-2 btn btn-primary" data-file="{{ Storage::url($omu['file_path']) }}">View PDF</button>
                                            <a href="javascript:void(0);" class="remove_button ms-2 my-2" title="Remove file" data-id="{{ $omu['id'] }}">
                                                <img src="{{ url('assets/images/link-images/remove-icon.png') }}" />
                                            </a>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Add button -->
                                <a href="javascript:void(0);" class="add_button ms-2" title="Add field">
                                    <img src="{{ url('assets/images/link-images/add-icon.png') }}" />
                                </a>

                                @if ($errors->has('upload_file'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('upload_file') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div id="pdfViewer" style="margin-top: 20px;">
                            <iframe id="pdfIframe" width="100%" height="600px" style="display:none;" frameborder="0"></iframe>
                            </div>

                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button id ="sub" type="submit" class="btn btn-primary px-4" style="margin-bottom: 1%;margin-left: 1%;">Submit</button>
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
            if($('#file_no').val()=="")
				{
                    $('#file_no1').text("Please Enter File No").show();
					$('#file_no').focus();
					return false;
				}
                var fileNoRegex = /^[A-Z][-][0-9]+[\/][0-9][\/]+[0-9]+[-][A-Z-()]+$/u;

                if (!fileNoRegex.test($('#file_no').val())) {
                    $('#file_no1').text("Invalid File No format. Please follow the correct format").show();
                    $('#file_no').focus();
                    return false;
                }

                var keyValue = $('#key').val().trim().replace(/\s+/g, ' '); 

                if (keyValue === "") {
                    $('#key_error').text("Please Enter Keywords").show();
                    $('#key').focus();
                    return false;
                }

                var characterCount = keyValue.replace(/\s/g, '').length;

                if (characterCount < 5) {
                    $('#key_error').text("Minimum 5 characters required.").show();
                    $('#key').focus();
                    return false; 
                }

        });
    });
</script>

<script>

$(document).ready(function() { 
    $('#pm_referenceForm').on('submit', function(e) {
        e.preventDefault();  

        var keywords = $('#key').val();
        var formattedKeywords = keywords.trim().replace(/\s+/g, ',');
        $('#key').val(formattedKeywords);

        var formData = new FormData(this);  

        $.ajax({
            url: $(this).attr('action'),  
            type: 'POST',
            data: formData,
            processData: false,  
            contentType: false, 
            success: function(response) { 
                    // alert(response);
                    // window.location.href = "{{ route('admin.document.pm_reference.index') }}";
                    Swal.fire({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "{{ route('admin.document.pm_reference.index') }}";
                });
            },
            error: function(xhr, status, error) {
              
                Swal.fire({
                title: "Error!",
                text: "An error occurred. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
            }
        });
    });
});


$(document).ready(function() {
    var maxField = 5; 
    var addButton = $('.add_button'); 
    var wrapper = $('.field_wrapper'); 
    <?php $removeIconUrl = url('assets/images/link-images/remove-icon.png'); ?>
    var removeIconUrl = '{{ $removeIconUrl }}';

    var fieldHTML = '<div class="file-input-group d-flex align-items-center">' +
                    '<input type="file" class="form-control" name="upload_file[]">' +
                    '<button type="button" class="view_pdf ms-2 my-2 btn btn-primary" style="display:none;">View PDF</button>' + 
                    '<a href="javascript:void(0);" class="remove_button ms-2 my-2">' +
                    '<img src="' + removeIconUrl + '" alt="remove" />' +
                    '</a>'  +
                    '</div>';

    var x = wrapper.children('div').length; 

    $(addButton).click(function() {
        if (x < maxField) { 
            x++; 
            $(wrapper).append(fieldHTML); 

            $(wrapper).find('input[type="file"]').last().change(function(e) {
                var file = e.target.files[0];
                var viewButton = $(this).siblings('.view_pdf');  
                if (file && file.type === 'application/pdf') {
                    viewButton.show();
                    viewButton.click(function() {
                        var fileURL = URL.createObjectURL(file);
                        $('#pdfIframe').attr('src', fileURL).show(); 
                    });
                }
            });
        } else {
            alert('A maximum of ' + maxField + ' fields are allowed to be added.');
        }
    });

    $(wrapper).on('click', '.remove_button', function(e) {
    e.preventDefault(); 
    
    var filePath = $(this).siblings('input[type="hidden"]').val();
    var fileId = $(this).data('id');

    if (filePath) {
        if (confirm('Are you sure you want to delete this file?')) {
            var $currentElement = $(this).closest('.file-input-group'); 
            $.ajax({
                url: "{{ route('admin.document.pm_reference.delete_file') }}", 
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    file_path: filePath,
                    file_id: fileId,
                    delete_from_storage: true
                },
                success: function(response) {
                    alert('File deleted successfully!');
                    $currentElement.find('input[type="hidden"]').val(''); 
                    $currentElement.remove(); 
                    location.reload();

                    var currentFileCount = $('.file-input-group').length;

                    
                    if (currentFileCount >= 5) {
                        alert('You cannot add more than 5 files.');
                    }
                },
                error: function() {
                    alert('An error occurred while deleting the file.');
                }
            });
        }
    } else {
        $(this).closest('.file-input-group').remove();
        x--;
    }
});



    $(document).on('click', '.view_pdf', function() {
        var fileURL = $(this).data('file'); 
        $('#pdfIframe').attr('src', fileURL).show();
    });
});
</script>

@endpush
@endsection













