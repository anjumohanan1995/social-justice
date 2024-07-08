@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Add Police Station</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active"> Add Police Station</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        {{-- <h4>Tooltip form validation</h4>
                        <p class="f-m-light mt-1">
                            If your form layout allows it, you can swap the <code>.{valid|invalid}</code>-feedback classes for<code>.{valid|invalid}</code>-tooltip classes to display validation feedback in a styled tooltip. Be sure to have a parent with <code>position: relative</code> on it for tooltip positioning.
                        </p> --}}
                    </div>
                    <div class=" m-4 d-flex justify-content-between">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">

                        <form action="{{ route('policestation.store') }}" method="POST" class="row g-3 needs-validation custom-input">
                                    @csrf
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01"> District</label>
                                    <select id="district" name="district" class="form-control" value="{{ old('district') }}" required>
                                        <option value="">--Select District--</option>
                                        @foreach ($districts as $district)
                                        <option value="{{ $district->name }}"> {{ $district->name }} </option>
                                        @endforeach
                                    </select>

                                    @error('district')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            @foreach ($districts as $district)
                            <input type="hidden" id="district_id" name="district_id" value="{{ $district->id }}">
                            @endforeach
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01"> Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter police station name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
