@extends('layouts.backend.admin')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">System</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Designation</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.designation.create')}}" type="button" class="btn btn-primary">Add</a>
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
                            @foreach($designation as $r)
                                <tr>
                                    <!-- Show row number continuously across pages -->
                                    <th scope="row">{{ ($designation->currentPage() - 1) * $designation->perPage() + $loop->iteration }}</th>
                                    <td>{{ $r->name }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('admin.designation.edit', ['id' => base64_encode($r->id)]) }}" title="Edit">
                                                <i class="bx bxs-edit"></i>
                                            </a>
                                            <a href="javascript:;" class="ms-3 deleteBtn" title="Delete" data-id="{{ base64_encode($r->id) }}">
                                                <i class="bx bxs-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                         <!-- Pagination Links -->
                         <div class="d-flex justify-content-center mt-4">
                            {{ $designation->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
@push('scripts')
    <script>


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
                        url: "{{route('admin.designation.delete')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': id,
                        },
                        success: function (response) {
                            if (response.success == false) {
                                toastr.error('This Designation is Already Assigned to The Users');
                            }
                            if (response.success) {
                                toastr.success('Designation Deleted Successfully');
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
