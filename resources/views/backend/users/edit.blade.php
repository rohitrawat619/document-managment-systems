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
                        <form action="{{route('admin.users.edit',['id'=>base64_encode($users->id)])}}" method="post" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{$users->first_name}}">
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{$users->last_name}}">
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                                <select class="form-control" id="multi-select" name="division[]" multiple="multiple">
                                    @foreach ($divisions as $dv)
                                        <option value="{{ $dv->id }}" {{ in_array($dv->id, $selectedDivision) ? 'selected' : '' }}>{{ $dv->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('division'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('division') }}</strong>
                                    </span>
                                @endif
                            </div>
                           
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-control" name="role_id">
                                    <option value="">--Select--</option>
                                    @if(count($roles)>0)
                                        @foreach ($roles as $dv)
                                            <option value="{{$dv->id}}" @if($dv->id==$users->role_id) selected @endif>{{$dv->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">NIC Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$users->email}}" readonly>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label><br>
                                <input type="hidden" id="code" name ="mobile_code" value="{{$users->phone_code}}" >
                                <input type="hidden" id="iso" name ="mobile_iso" value="{{$users->phone_iso}}" >
                                <input type="text" class="form-control mobile" id="mobile" name="mobile" value="{{$users->phone}}">
                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile') }}</strong>
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
    $('#multi-select').select2();
    });

    </script>
@endpush
@endsection
