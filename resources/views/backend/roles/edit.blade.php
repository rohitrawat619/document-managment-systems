@extends('layouts.backend.admin')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Roles</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">Roles</a>
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
                        <form action="{{route('admin.roles.edit',['id'=>base64_encode($roles->id)])}}" method="post" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$roles->name}}" placeholder="Role Name">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                                <select class="form-control" id="multi-select" name="designation[]" multiple="multiple">
                                    @foreach ($designations as $dv)
                                    <option value="{{ $dv->id }}" {{ in_array($dv->id, $selectedDesignations) ? 'selected' : '' }}>
                                        {{ $dv->name }}
                                    </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('designation'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('designation') }}</strong>
                                </span>
                                @endif
                            </div>

                            <hr />

                            <!-- General Permissions Dropdown -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>General Permissions</h5>
                                </div>

                                <div class="col-md-6">
                                    <label for="general-permissions" class="form-label">Select Permission</label>
                                    <select class="form-control" id="general-permissions">
                                        <option value="">-- Select Permission --</option>
                                        @foreach($permissions as $per)
                                        @if(!in_array($per->id, [40, 41, 42, 43]))
                                        <option value="{{ $per->id }}">{{ $per->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr />

                            <!-- Selected Permissions Table -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Selected Permissions & Actions</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Permission Name</th>
                                                <th>Read</th>
                                                <th>Write</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="permissions-table">
                                            <!-- Selected permissions will be added here dynamically -->
                                        </tbody>
                                    </table>
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
    /** select 2 multi select */
    $(document).ready(function() {
        $('#multi-select').select2();
    });



    $(document).ready(function() {
        // Initialize Select2 for dropdown
        $('#general-permissions').select2();

        // Handle dropdown selection
        $('#general-permissions').on('change', function() {
            var permissionId = $(this).val();
            var permissionName = $("#general-permissions option:selected").text();

            if (permissionId && $("#row_" + permissionId).length == 0) {
                var newRow = `
                    <tr id="row_${permissionId}">
                        <td>${permissionName}</td>
                        <td><input type="checkbox" name="permissions[${permissionId}][]" value="read"></td>
                        <td><input type="checkbox" name="permissions[${permissionId}][]" value="write"></td>
                        <td><input type="checkbox" name="permissions[${permissionId}][]" value="update"></td>
                        <td><input type="checkbox" name="permissions[${permissionId}][]" value="delete"></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-permission" data-id="${permissionId}">Remove</button></td>
                    </tr>
                `;
                $('#permissions-table').append(newRow);
            }
        });

        // Remove selected permission
        $(document).on('click', '.remove-permission', function() {
            var id = $(this).data('id');
            $('#row_' + id).remove();
        });
    });
</script>

@endpush

@endsection