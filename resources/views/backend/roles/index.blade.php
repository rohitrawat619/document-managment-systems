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
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover table-bordered">
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
												<a href="javascript:;" class="" title="Edit"><i class="bx bxs-edit"></i></a>
												<a href="javascript:;" class="ms-3" title="Delete"><i class="bx bxs-trash"></i></a>
                                                @if($r->is_active==1)
                                                    <a href="javascript:;" class="ms-3" title="Inactive"><i class="bx bx-x-circle"></i></a>
                                                @else
                                                    <a href="javascript:;" class="ms-3" title="Active"><i class="bx bxs-check-circle"></i></a>
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
@endsection
