@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Add Order</h4>
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
                        <li class="breadcrumb-item active"> Add Order</li>
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

                        <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation custom-input">
                                    @csrf
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01"> Order type</label>
                                    <select id="type" name="type" class="form-control" value="{{ old('type') }}" required>
                                        <option value="">--Select type-</option>
                                        <option value="type 1">type 1</option>
                                        <option value="type 2">type 2</option>
                                    </select>
                                    @error('district')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01"> File</label>
                                    <input type="file" id="file" name="file" class="form-control"  required>
                                    @error('file')
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
