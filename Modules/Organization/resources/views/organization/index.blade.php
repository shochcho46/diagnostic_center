@extends('layouts.app')

@push('custome-css')

@endpush

@section('content')

<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Organization</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('admin.permissionIndex') }}">Organization</a>
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div>

    <div class="app-content">
        <div class="container">
            <div class="row">
                <h1 class="mt-3">Organization List</h1>
                <div class="d-flex justify-content-between align-items-end mt-3 mb-3">


                    <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-end gap-1">
                        @include('components.daterange')
                        @include('components.search')
                    </form>

                    <a href="{{ route('admin.organizationCreate') }}" class="btn btn-outline-primary">
                         <i class="mdi mdi-plus-circle mdi-12px"></i>
                    </a>
                </div>


                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Add By</th>
                            <th scope="col">City</th>
                            <th scope="col">Upazila</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Status</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Is Sms</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($datas as $index => $item)
                            <tr>
                                <th scope="row">{{ $datas->firstItem() + $index }}</th>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if($item->hasMedia('logo'))
                                        <img src="{{ $item->getFirstMediaUrl('logo') }}" alt="{{ $item->name }}" width="50">
                                        <small class="text-muted">{{ $item->name }}</small>
                                    @else
                                        {{ $item->name }}
                                    @endif

                                </td>
                                <td>{{ $item?->admin->name }}</td>
                                <td>{{ $item?->district->name }}</td>
                                <td>{{ $item?->upazila->name }}</td>
                                <td>{{ $item?->contact_number }}</td>
                                <td>
                                    @if($item->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @elseif($item->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif($item->status == 2)
                                        <span class="badge bg-warning">Pending-Payment</span>
                                    @endif
                                </td>
                                <td>{{ $item?->start_date }}</td>
                                <td>{{ $item?->end_date }}</td>
                                <td>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input toggle-sms" type="checkbox" role="switch" data-id="{{ $item->id }}" id="flexSwitchCheckDefault{{ $item->id }}" {{ $item->is_sms == 1 ? 'checked' : '' }} >
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Sms</label>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('admin.permissionEdit', $item->id) }}" class="btn btn-sm btn-outline-info"> <i class="mdi mdi-pencil "></i></a>

                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="{{ route('admin.organizationDestroy', $item->id) }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No items found.</td>
                            </tr>
                        @endforelse
                        @include('components.delete')
                        </tbody>
                    </table>

                    <div class="d-flex mt-3">
                        {{ $datas->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



@push('custome-js')

<script>
    $(document).ready(function () {
        $('.toggle-sms').on('change', function () {
            var itemId = $(this).data('id');
            var isChecked = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.organizationToggleSms') }}", // Define this route in web.php
                type: "GET",
                data: {
                    id: itemId
                },
                success: function (response) {
                    toastr.success(response.message);
                },
                error: function (xhr) {
                    alert("An error occurred. Please try again.");
                }
            });
        });
    });
</script>
@endpush
