@extends('layouts.adminapp')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="m-4 d-flex justify-content-between">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border">
                        </div>
                        <div class="card-body">
                            <form action="{{ route('rdo.update', $data->id) }}" method="POST" class="row g-3 needs-validation custom-input">
                                @csrf
                                @method('PUT') <!-- Use PUT method for update -->
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="validationTooltip01">District</label>
                                    <select class="form-control" name="district" id="district">
                                        <option value="">{{ $data->district }}</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->name }}" {{ $district->id == $data->district_id ? 'selected' : '' }}>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="validationTooltip01">Name</label>
                                    <input type="text" value="{{ $data->name }}" id="name" name="name" class="form-control" placeholder="Enter RDO name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="validationTooltip01">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="{{ $data->status }}" readonly>{{ $data->status }}</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </form>
                            <br>
                        <a href="/rdo" style="color:blue">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
