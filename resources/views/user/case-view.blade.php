@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Preview Case</h4>
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
                            <li class="breadcrumb-item">Case</li>
                            <li class="breadcrumb-item active">Preview Case</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header" hidden>
                    {{-- <h4>Tooltip form validation</h4>
                    <p class="f-m-light mt-1">
                        If your form layout allows it, you can swap the <code>.{valid|invalid}</code>-feedback classes for <code>.{valid|invalid}</code>-tooltip classes to display validation feedback in a styled tooltip. Be sure to have a parent with <code>position: relative</code> on it for tooltip positioning.
                    </p> --}}
                </div>

                <div class="m-4 d-flex justify-content-between">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <style>
                        /* Style for form container */
                        .form-container {
                            max-width: 8000px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #f8f9fa;
                            border: 1px solid #ced4da;
                            border-radius: 8px;
                        }

                        /* Style for form title */
                        .form-title {
                            font-size: 24px;
                            margin-bottom: 20px;
                        }

                        /* Style for form sections */
                        .form-section {
                            margin-bottom: 30px;
                        }

                        /* Style for form labels */
                        .form-label {
                            font-weight: bold;
                        }

                        /* Style for form data */
                        .form-data {
                            font-size: 16px;
                        }
                    </style>

                    <div class="container">
                        <div class="form-container">
                            <h2 class="form-title">Case ID: {{ @$opposition->case_id }}</h2>
                            <div class="row form-section">
                                <div class="col-md-4">
                                    <h5>Beneficiary</h5>
                                    <div class="mb-3">
                                        <label for="beneficiaryName" class="form-label">Name:</label>
                                        <p class="form-data">{{ @$opposition->applicant_name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="beneficiaryAddress" class="form-label">Address:</label>
                                        <p class="form-data">{{ @$opposition->address }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="beneficiaryDistrict" class="form-label">District:</label>
                                        <p class="form-data">{{ @$opposition->user->district->name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="beneficiaryPincode" class="form-label">Pincode:</label>
                                        <p class="form-data">{{ @$opposition->user->pincode }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="beneficiaryPhone" class="form-label">Phone Number:</label>
                                        <p class="form-data">{{ @$opposition->user->phone }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="beneficiaryEmail" class="form-label">Email:</label>
                                        <p class="form-data">{{ @$opposition->user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Opposition</h5>
                                    <div class="mb-3">
                                        <label for="oppositionName" class="form-label">Name:</label>
                                        <p class="form-data">{{ @$opposition->opposition_name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppositionAddress" class="form-label">Address:</label>
                                        <p class="form-data">{{ @$opposition->opposition_address }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppositionDistrict" class="form-label">District:</label>
                                        <p class="form-data">{{ @$opposition->district->name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppositionPincode" class="form-label">Pincode:</label>
                                        <p class="form-data">{{ @$opposition->pincode }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppositionPhone" class="form-label">Phone Number:</label>
                                        <p class="form-data">{{ @$opposition->opposition_mobile }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppositionEmail" class="form-label">Email:</label>
                                        <p class="form-data">test@gmail.com</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="mb-3">
                                            <button id="submitButton" class="btn btn-primary">File for Appeal</button>
                                        </div><br><br><br><br><br>
                                        {{-- <div class="mb-3">
                                            <label for="executionPetition" class="form-label">Execution Petition:</label>
                                            <input type="file" class="form-control" id="executionPetition" name="executionPetition">
                                        </div> --}}

                                </div>

                            </div>
                        </div>
                    </div>



                </div>

                <div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
@endsection