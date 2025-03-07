@php
use Illuminate\Support\Facades\Session;
@endphp

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
                        <li class="breadcrumb-item active" aria-current="page">Presentations</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                @php
                $userPermissions = session::get('user_permissions');
                @endphp

                @php
                $hasPermission = in_array(42, $userPermissions);
                @endphp

                <a href="{{ $hasPermission ? route('admin.document.office_memorandum.create') : 'javascript:void(0);' }}" 
                    class="btn btn-primary {{ $hasPermission ? '' : 'no-permission' }}" 
                    title="{{ $hasPermission ? 'Add' : 'No Permission' }}" 
                    {!! $hasPermission ? '' : 'onclick="alert(\'You do not have write permission to perform this action.\');"' !!}>
                    Add
                    </a>
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
                    <div class="d-flex  mb-3">
                    <form method="GET" action="{{ route('admin.document.presentations.index') }}" class="form-inline" style="width: 100%;">
                    <div class="d-flex mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request()->get('search') }}">
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                    <a href="{{ route('admin.document.presentations.index') }}" class="btn btn-secondary ms-2">Reset</a>
                    </div>
                        <table class="table mb-0 table-hover table-bordered userTable">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Computer No.</th>
                                    <th scope="col">File No.</th>
                                    <th scope="col">Date of publication</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Presentation Approved by</th>
                                    <th scope="col">Issued by Name & Designation</th>
                                    <th scope="col">Uploaded By Name & Designation</th>
                                    <th scope="col">Keywords</th>
                                    <th scope="col">Date of Upload</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $userPermissions = session::get('user_permissions');
                            @endphp
                            @forelse ($presentations as $k => $r)
                            <tr>
                                <!-- Adjust numbering to be continuous across pages -->
                                <th scope="row">{{ ($presentations->currentPage() - 1) * $presentations->perPage() + $k + 1 }}</th>
                                <td>{{$r->computer_no}}</td>
                                <td>{{$r->file_no}}</td>
                                <td>{{date('Y-m-d',strtotime($r->date_of_publication))}}</td>
                                <td>{{$r->subject}}</td>
                                <td>{{$r->approvedBy}}</td>
                                <td>{{$r->issuer_name}}</td>
                                <td>{{$r->issuer_designation}}</td>
                                <td>{{ str_replace(',', ' ', $r->keyword) }}</td>
                                <td>{{date('Y-m-d',strtotime($r->date_of_upload))}}</td>
                                <td>
                                     <!-- Button to Open Modal -->
                                     <button type="button" class="btn btn-primary viewDetails" 
                                            data-bs-toggle="modal" data-bs-target="#detailsModal"
                                            data-id="{{$r->id}}" 
                                            data-computer_no="{{$r->computer_no}}" 
                                            data-file_no="{{$r->file_no}}" 
                                            data-date_of_issue="{{date('Y-m-d', strtotime($r->date_of_issue))}}"
                                            data-subject="{{$r->subject}}" 
                                            data-issuer_name="{{$r->issuer_name}}" 
                                            data-issuer_designation="{{$r->issuer_designation}}" 
                                            data-keyword="{{ str_replace(',', ' ', $r->keyword) }}" 
                                            data-date_of_upload="{{date('Y-m-d', strtotime($r->date_of_upload))}}">
                                            View
                                        </button>
                                </td>
                                <td>
                                <div class="d-flex order-actions">
                                        @if(in_array(42, $userPermissions))
                                        <a href="{{ route('admin.document.office_memorandum.edit', ['id' => base64_encode($r->id)]) }}" title="Edit">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        @else
                                            <a href="javascript:void(0);" 
                                            class="disabled-link" 
                                            title="No Permission" 
                                            onclick="alert('You do not have edit permission to edit this item.');">
                                            <i class="bx bxs-edit text-muted"></i>
                                            </a>
                                        @endif

                                        @if(in_array(43, $userPermissions))
                                            <a href="javascript:;" class="ms-3 deleteBtn" title="Delete" data-id="{{ base64_encode($r->id) }}">
                                                <i class="bx bxs-trash"></i>
                                            </a>
                                        @else
                                        <a href="javascript:void(0);" class="ms-3 disabled-link" title="No Permission"
                                        onclick="alert('You do not have permission to delete this item.');">
                                            <i class="bx bxs-trash text-muted"></i>
                                        </a>
                                        @endif
                                        </div>
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="9">No Records Found</td>
                        @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $presentations->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel">Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>Computer No</th>
                <td id="modalComputerNo"></td>
              </tr>
              <tr>
                <th>File No</th>
                <td id="modalFileNo"></td>
              </tr>
              <tr>
                <th>Date of Issue</th>
                <td id="modalDateOfIssue"></td>
              </tr>
              <tr>
                <th>Subject</th>
                <td id="modalSubject"></td>
              </tr>
              <tr>
                <th>Issuer Name</th>
                <td id="modalIssuerName"></td>
              </tr>
              <tr>
                <th>Issuer Designation</th>
                <td id="modalIssuerDesignation"></td>
              </tr>
              <tr>
                <th>Keyword</th>
                <td id="modalKeyword"></td>
              </tr>
              <tr>
                <th>Date of Upload</th>
                <td id="modalDateOfUpload"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
    <script>
       $(document).on('click', '.status', function (event) {
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');

            // Correct way to call SweetAlert2
            Swal.fire({
                title: "Are you Want to Change The Status of This Form?",
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
                        url: "{{route('admin.document.presentations.status')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': id,
                            'type': type
                        },
                        success: function (response) {
                            if (response.success) {
                                if (response.type == 'enable') {
                                    $('table.userTable tr').find("[data-ac='" + id + "']").fadeIn("slow").removeClass("d-none");
                                    $('table.userTable tr').find("[data-dc='" + id + "']").fadeOut("slow").addClass("d-none");
                                    $('table.userTable tr').find("[data-a='" + id + "']").fadeOut("slow").addClass("d-none");
                                    $('table.userTable tr').find("[data-d='" + id + "']").fadeIn("slow").removeClass("d-none");
                                } else if (response.type == 'disable') {
                                    $('table.userTable tr').find("[data-dc='" + id + "']").fadeIn("slow").removeClass("d-none");
                                    $('table.userTable tr').find("[data-ac='" + id + "']").fadeOut("slow").addClass("d-none");
                                    $('table.userTable tr').find("[data-d='" + id + "']").fadeOut("slow").addClass("d-none");
                                    $('table.userTable tr').find("[data-a='" + id + "']").fadeIn("slow").removeClass("d-none");
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
                        url: "{{route('admin.presentations.delete')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': id,
                        },
                        success: function (response) {

                            if (response.success) {
                                toastr.success('Form Deleted Successfully');
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

            document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".viewDetails").forEach(button => {
            button.addEventListener("click", function () {
            document.getElementById("modalComputerNo").textContent = this.dataset.computer_no;
            document.getElementById("modalFileNo").textContent = this.dataset.file_no;
            document.getElementById("modalDateOfIssue").textContent = this.dataset.date_of_issue;
            document.getElementById("modalSubject").textContent = this.dataset.subject;
            document.getElementById("modalIssuerName").textContent = this.dataset.issuer_name;
            document.getElementById("modalIssuerDesignation").textContent = this.dataset.issuer_designation;
            document.getElementById("modalKeyword").textContent = this.dataset.keyword;
            document.getElementById("modalDateOfUpload").textContent = this.dataset.date_of_upload;
            });
        });

        // Reset modal content when it closes
        document.getElementById('detailsModal').addEventListener('hidden.bs.modal', function () {
            this.querySelectorAll(".modal-body span").forEach(span => span.textContent = "");
        });
    });



    </script>
@endpush
@endsection
