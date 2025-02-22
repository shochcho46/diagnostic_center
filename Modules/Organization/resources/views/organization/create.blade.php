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
        <div class="container-fluid">
            <div class="row">
                <h1 class="mt-3">Organization List</h1>
                <div class="text-end m-3">
                    <a href="{{ route('admin.permissionIndex') }}" class="btn btn-outline-primary"><span class="mdi mdi-format-list-text"></span></a>
                </div>

                <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Organization List</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form action="{{route('admin.organizationStore')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row mt-1">
                                <div class="col-md-3 col-12">
                                    @include('components.division')
                                </div>
                                <div class="col-md-3 col-12">
                                    <div id="district-container">
                                        @include('components.district')
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div id="upzila-container">
                                        @include('components.upazila')
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div id="union-container">
                                        @include('components.union')
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">

                            <div class="col-md-3 col-12 mb-3">
                                <label for="name" class="form-label">Diagnostic Center Name</label>
                                <input type="text" class="form-control text-lowercase" id="name" name="name" placeholder="Diagnostic Center Name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 col-12 mb-3">
                                <label for="contact_number" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" required>
                                @error('contact_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 col-12 mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 col-12 mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 col-12 mb-3">
                                <label for="is_sms" class="form-label">Is SMS</label>
                                <select class="form-control" id="is_sms" name="is_sms" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('is_sms')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 col-12 mb-3">
                                @include('components.trueorfalse')
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address" required></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-12 mb-3">
                                <label for="image" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                            </div>




                            </div>

                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                </div>

            </div>
        </div>
    </div>
@endsection



@push('custome-js')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
