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
                            <select class="form-control" name="designation">
                                @foreach ($designations as $dv)
                                    <option value="{{ $dv->id }}" 
                                        {{ in_array($dv->id, $selectedDesignations) ? 'selected' : '' }}>
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



                           
                            <hr/>
                           
                            @foreach($permissions as $key => $per)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                            name="permissions[]" 
                                            value="{{ $per->id }}" 
                                            id="permission_{{ $per->id }}"
                                            {{ in_array($per->id, $rolePermissions) ? 'checked' : '' }}>
                                            
                                        <label class="form-check-label" for="permission_{{ $per->id }}">
                                            {{ $per->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
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

@endsection
