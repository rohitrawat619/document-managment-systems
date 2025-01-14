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
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.roles.create')}}" type="button" class="btn btn-primary">Add</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-12">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="col-xl-12 mx-auto">
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover table-bordered roleTable">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $k => $r)
                                    <tr>
                                        <th scope="row">{{$k + 1}}</th>
                                        <td>{{$r->name}}</td>
                                        <td>
                                            <div class="d-flex order-actions">
												<a href="{{route('admin.roles.edit',['id'=>base64_encode($r->id)])}}" class="" title="Edit"><i class="bx bxs-edit"></i></a>
												<a href="javascript:;" class="ms-3 deleteBtn" title="Delete" data-id="{{base64_encode($r->id)}}"><i class="bx bxs-trash"></i></a>
                                                @if($r->is_active==1)
                                                    <a href="javascript:;" class="ms-3 status" data-dc="{{base64_encode($r->id)}}" data-id="{{base64_encode($r->id)}}" data-type="{{base64_encode('disable')}}" title="Inactive"><i class="bx bx-x-circle"></i></a>
                                                    <a href="javascript:;" class="ms-3 status d-none" data-ac="{{base64_encode($r->id)}}" data-id="{{base64_encode($r->id)}}" data-type="{{base64_encode('enable')}}" title="Active"><i class="bx bxs-check-circle"></i></a>
                                                @else
                                                    <a href="javascript:;" class="ms-3 status d-none" data-dc="{{base64_encode($r->id)}}" data-id="{{base64_encode($r->id)}}" data-type="{{base64_encode('disable')}}" title="Inactive"><i class="bx bx-x-circle"></i></a>
                                                    <a href="javascript:;" class="ms-3 status" data-ac="{{base64_encode($r->id)}}" data-id="{{base64_encode($r->id)}}" data-type="{{base64_encode('enable')}}" title="Active"><i class="bx bxs-check-circle"></i></a>
                                                @endif
											</div>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="5">No Records Found</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
@push('scripts')
    <script>
       $(document).on('click', '.status', function (event) {
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');

            // Correct way to call SweetAlert2
            Swal.fire({
                title: "Are you Want to Change The Status of This Role?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#189bc3",
                cancelButtonColor: "#d33",
                confirmButtonText: "YES",
                cancelButtonText: "CANCEL",
                reverseButtons: true // Ensure the 'Cancel' button is on the right
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{route('admin.roles.status')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': id,
                            'type': type
                        },
                        success: function (response) {
                            if (response.success == false) {
                                toastr.error('This Role is Already Assigned to The Users');
                            }
                            if (response.success) {
                                if (response.type == 'enable') {
                                    $('table.roleTable tr').find("[data-ac='" + id + "']").fadeIn("slow").removeClass("d-none");
                                    $('table.roleTable tr').find("[data-dc='" + id + "']").fadeOut("slow").addClass("d-none");
                                    $('table.roleTable tr').find("[data-a='" + id + "']").fadeOut("slow").addClass("d-none");
                                    $('table.roleTable tr').find("[data-d='" + id + "']").fadeIn("slow").removeClass("d-none");
                                } else if (response.type == 'disable') {
                                    $('table.roleTable tr').find("[data-dc='" + id + "']").fadeIn("slow").removeClass("d-none");
                                    $('table.roleTable tr').find("[data-ac='" + id + "']").fadeOut("slow").addClass("d-none");
                                    $('table.roleTable tr').find("[data-d='" + id + "']").fadeOut("slow").addClass("d-none");
                                    $('table.roleTable tr').find("[data-a='" + id + "']").fadeIn("slow").removeClass("d-none");
                                }
                            }
                            // Close SweetAlert
                            Swal.close();
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            // handle error
                        }
                    });
                } else {
                    // If the user clicked 'Cancel' or dismissed the SweetAlert
                    Swal.close();
                }
            });
       });

       $(document).on('click', '.deleteBtn', function (event) {
            var id = $(this).attr('data-id');

            // Correct way to call SweetAlert2
            Swal.fire({
                title: "Are You Sure You Want to Delete?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#189bc3",
                cancelButtonColor: "#d33",
                confirmButtonText: "YES",
                cancelButtonText: "CANCEL",
                reverseButtons: true // Ensure the 'Cancel' button is on the right
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{route('admin.roles.delete')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': id,
                        },
                        success: function (response) {
                            if (response.success == false) {
                                toastr.error('This Role is Already Assigned to The Users');
                            }
                            if (response.success) {
                                toastr.success('Role Deleted Successfully');
                                window.setTimeout(function(){
                                    window.location.reload();
                                },2000);
                            }
                            // Close SweetAlert
                            Swal.close();
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            // handle error
                        }
                    });
                } else {
                    // If the user clicked 'Cancel' or dismissed the SweetAlert
                    Swal.close();
                }
            });
       });
    </script>
@endpush
@endsection
