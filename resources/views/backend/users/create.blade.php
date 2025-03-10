@extends('layouts.backend.admin')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a>
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
                        <form id = "userFrom" action="" method="post" class="row g-3">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                                <div id="first_name_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                                <div id="last_name_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                            <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                            <select class="form-control" id="division" name="division[]" multiple="multiple">
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
                            <div id="division_error" style="color: red; display: none;"></div>
                            </div>  
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-control" id="role" name="role_id">
                                    <option value="">--Select--</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                                <div id="role_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                            <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                                <select class="form-control" id="designation" name="designation_id">
                                        <option value="">Select Designation</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">NIC Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <div id="email_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label><br>
                                <input type="hidden" id="code" name ="mobile_code" value="91" >
                                <input type="hidden" id="iso" name ="mobile_iso" value="in" >
                                <input type="text" class="form-control mobile" id="mobile" name="mobile">
                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                                <div id="mobile_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="******">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <div id="password_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="*******">
                                @if ($errors->has('confirm_password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                                <div id="confirm_password_error" style="color: red; display: none;"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" id="submit" class="btn btn-primary px-4">Submit</button>
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
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script>
      $(".mobile").intlTelInput({
          initialCountry: "in",
          separateDialCode: true,
          // preferredCountries: ["ae", "in"],
          preferredCountries: ["in"],
          onlyCountries: ["in"],
          geoIpLookup: function (callback) {
              $.get('https://ipinfo.io', function () {
              }, "jsonp").always(function (resp) {
                  var countryCode = (resp && resp.country) ? resp.country : "";
                  callback(countryCode);
              });
          },
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
      });

      /* ADD A MASK IN PHONE1 INPUT (when document ready and when changing flag) FOR A BETTER USER EXPERIENCE */

      var mask1 = $(".mobile").attr('placeholder').replace(/[0-9]/g, 0);

      $(document).ready(function () {
          $('.mobile').mask(mask1);
      });

      //
      $(".mobile").on("countrychange", function (e, countryData) {
          $(".mobile").val('');
          var mask1 = $(".mobile").attr('placeholder').replace(/[0-9]/g, 0);
          $('.mobile').mask(mask1);
          $('#code').val($(".mobile").intlTelInput("getSelectedCountryData").dialCode);
          $('#iso').val($(".mobile").intlTelInput("getSelectedCountryData").iso2);
      });

      
    /** select 2 multi select */
    
    $(document).ready(function() {
    $('#division').select2();
    });

    /*** Dependent dropdown for auto selected designations */

    $(document).ready(function(){
    $('#role').change(function(){
        var roleId = $(this).val();
        if(roleId) {
            $.ajax({
                
                url: '/get-designations/' + roleId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#designation').empty().append('<option value="">Select Designation</option>');
                    $.each(data, function(index, designation){
                        $('#designation').append('<option value="'+designation.id+'">'+designation.name+'</option>');
                    });
                }
            });
        } else {
            $('#designation').empty().append('<option value="">Select Designation</option>');
        }
    });
});

/** code for jquery errors */

$(document).ready(function () {
        $('#submit').click(function(e){

                if($('#first_name').val()=="")
				{
					$('#first_name_error').text("Please Enter First Name").show();
					$('#first_name').focus();
					return false;
				}

                if($('#last_name').val()=="")
				{
                    $('#last_name_error').text("Please Enter last name").show();
					$('#last_name').focus();
					return false;invalid-feedback
				}

                if($('#division').val()=="")
				{
                    $('#division_error').text("Please Select Division").show();
					$('#division').focus();
					return false;
				}

                if($('#role').val()=="")
				{
                    $('#role_error').text("Please Select Role").show();
					$('#role').focus();
					return false;
				}

                if($('#email').val()=="")
				{
                    $('#email_error').text("Please Enter Email").show();
					$('#email').focus();
					return false;
				}

                if($('#mobile').val()=="")
				{
                    $('#mobile_error').text("Please Enter Mobile No.").show();
					$('#mobile').focus();
					return false;
                }
                if($('#password').val()=="")
				{
                    $('#password_error').text("Please Enter Password").show();
					$('#password').focus();
					return false;
                }
                if($('#confirm_password').val()=="")
				{
                    $('#confirm_password_error').text("Please Enter Confirm Password").show();
					$('#confirm_password').focus();
					return false;
                }
        });
   


    /**  code for submitting form using ajax */

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var userFormUrl = "{{ url('admin/users/create') }}";
    $('#userFrom').on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this); 

        $.ajax({
            url: userFormUrl, 
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.btn-primary1').prop('disabled', true).text('Submitting...');
            },
            success: function(response) {
                $('.btn-primary1').prop('disabled', false).text('Submit');
                // alert(response);
                //      window.location.href = "{{ route('admin.users.index') }}";
                Swal.fire({
                title: "Success!",
                text: response.message,
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "{{ route('admin.users.index') }}";
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
                text: "An error occurred. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
                }
            }
        });
    });
});

   
    </script>
    
@endpush
@endsection
