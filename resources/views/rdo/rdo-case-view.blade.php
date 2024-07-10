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
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

{{-- <style>
    .button-container {
        display: flex;
        align-items: center;
        gap: 10px; /* Adds space between elements */
    }

    .button-container input[type="date"] {
        padding: 8px; /* Adds padding inside the input field */
        border: 1px solid #ccc; /* Adds a border to the input field */
        border-radius: 5px; /* Rounds the corners of the input field */
        background-color: #f9f9f9; /* Sets the background color of the input field */
        color: #333; /* Sets the text color inside the input field */
        font-size: 14px; /* Sets the font size of the text inside the input field */
    }

    .view-btn {
        background-color: #4CAF50; /* Green background color */
        color: white; /* White text color */
        padding: 10px 20px; /* Adds padding to the button */
        text-align: center; /* Centers the text inside the button */
        text-decoration: none; /* Removes underline from the link */
        display: inline-block; /* Allows setting the width and height */
        font-size: 16px; /* Sets the font size */
        margin: 4px 2px; /* Adds margin around the button */
        cursor: pointer; /* Changes cursor to pointer on hover */
        border-radius: 5px; /* Rounds the corners of the button */
    }

    .view-btn i {
        margin-right: 5px; /* Adds space between the icon and text */
    }

    .uploadItem {
        padding: 10px 20px; /* Adds padding to the button */
        border-radius: 5px; /* Rounds the corners of the button */
        font-size: 16px; /* Sets the font size */
    }

    .uploadrejectItem {
        padding: 10px 20px; /* Adds padding to the button */
        border-radius: 5px; /* Rounds the corners of the button */
        font-size: 16px; /* Sets the font size */
    }
</style> --}}

<style>
    /* Style for View button */
    .view-btn {
        display: inline-block;
        padding: 8px 12px;
        background-color: #007bff; /* Blue background color */
        color: #fff; /* White text color */
        border: none;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .view-btn:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

    /* Style for Submit button */
    .btn-primary {
        background-color: #28a745; /* Green background color */
        color: #fff; /* White text color */
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #218838; /* Darker green on hover */
    }

    /* Style for Accept button */
    .btn-success {
        background-color: #28a745; /* Green background color */
        color: #fff; /* White text color */
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838; /* Darker green on hover */
    }

    /* Style for Reject button */
    .btn-danger {
        background-color: #dc3545; /* Red background color */
        color: #fff; /* White text color */
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333; /* Darker red on hover */
    }
</style>

<style>
    /* Styling for the date input */
    #hearingDateInput {
        padding: 0.5em;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none; /* Removes the default blue outline on focus */
    }
</style>

<div class="container">
    <div class="button-container">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('ViewCases', ['id' => $caseDetails->_id]) }}" class="view-btn">
                    <i class="fas fa-eye"></i>
                </a>
                <!-- Approve/Reject Buttons -->
                <input type="date" id="hearingDateInput">
                <button class="btn btn-primary" type="button" onclick="updateHearingDate()">Submit</button>
            </div>
            <div class="col-3"></div>
            <div class="col-3">
                @if(@$caseDetails->Rdo_case_status == "null")
                <button class="uploadItem btn btn-success">Accept</button>
                <button class="uploadrejectItem btn btn-danger">Reject</button>
                @elseif(@$caseDetails->Rdo_case_status == "1")
                    <button class="btn btn-success">Accepted</button>
                @elseif(@$caseDetails->Rdo_case_status == "0")
                    <button class="btn btn-danger">Rejected</button>
                @endif
            </div>
    </div>
</div><br><br>

    <div class="form-container">
        <h2 class="form-title">Case ID: {{ @$caseDetails->case_id }}</h2>

        <!-- Beneficiary Section -->
        <div class="row form-section">
            <div class="col-md-12">
                <h5 style="font-weight: bold; text-decoration: underline;">Beneficiary</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><b>Name</b></th>
                                <th><b>Address</b></th>
                                <th><b>District</b></th>
                                <th><b>Pincode</b></th>
                                <th><b>Phone Number</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $caseDetails->name ?? 'N/A' }}</td>
                                <td>{{ $caseDetails->address ?? 'N/A' }}</td>
                                <td>{{ $caseDetails->district_name ?? 'N/A' }}</td>
                                <td>{{ $caseDetails->pincode ?? 'N/A' }}</td>
                                <td>{{ $caseDetails->applicant_phone_number ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr> <!-- Horizontal line between sections -->

        <!-- Opposition Section -->
        <div class="row form-section">
            <div class="col-md-12">
                <h5 style="font-weight: bold; text-decoration: underline;">Opposition</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><b>Name</b></th>
                                <th><b>Relationship</b></th>
                                <th><b>Mobile</b></th>
                                <th><b>Address</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($caseDetails->opposition_name) && is_array($caseDetails->opposition_name))
                                @foreach($caseDetails->opposition_name as $index => $name)
                                    <tr>
                                        <td>{{ $name }}</td>
                                        <td>{{ $caseDetails->opposition_relationship[$index] ?? 'N/A' }}</td>
                                        <td>{{ $caseDetails->opposition_mobile[$index] ?? 'N/A' }}</td>
                                        <td>{{ $caseDetails->opposition_address[$index] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No data available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr> <!-- Horizontal line between sections -->

        <!-- Stakeholder Section -->
        <div class="row form-section">
            <div class="col-md-12">
                <h5 style="font-weight: bold; text-decoration: underline;">Stakeholder</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><b>RDO</b></th>
                                <th><b>Police Station</b></th>
                                <th><b>Municipality/Panchayat/Corporation</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $caseDetails->rdo ?? 'N/A' }}</td>
                                <td>{{ $caseDetails->police_station ?? 'N/A' }}</td>
                                <td>{{ $caseDetails->panchayat ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr> <!-- Horizontal line between sections -->

        <!-- Case Details -->
        <div class="row form-section">
            <div class="col-md-12">
                <h5 style="font-weight: bold; text-decoration: underline;">Case Details:</h5>
                <p class="form-control" id="caseDetails" rows="5">{{ $caseDetails->case_details }}</p>
            </div>
        </div>
    </div><br>

        {{-- <!-- View Cases Button -->
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <button class="btn btn-primary edit-btn">
                    <a href="{{ route('ViewCases', ['id' => $caseDetails->_id]) }}" style="color: white; text-decoration: none;">View Cases</a>
                </button>
            </div>
        </div> --}}

        <input type="hidden" name="request_id" id="request_id" value="{{ $caseDetails->_id }}">
        <input type="hidden" name="case_id" id="case_id" value="{{ @$caseDetails->case_id }}">

    </div>
</div>

{{-- submit modal --}}
<div class="modal fade" id="upload-popup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Upload the Order</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadOrderForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="orderType" class="form-label">Order Type:</label>
                        <select id="orderType" class="form-select" name="orderType">
                            <option value="maintanence">Order for maintenance - Pay</option>
                            <option value="protection">Protection</option>
                            <option value="property">Property</option>
                            <option value="concilation">Conciliation</option>
                            <option value="interim Order">Interim Order</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="orderFile" class="form-label">Upload File:</label>
                        <input type="file" id="orderFile" name="orderFile" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="button" class="approveItem btn btn-success" onclick="approve()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="rejection-upload-popup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Upload the Order</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadRejectionOrderForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="rejectionOrderType" class="form-label">Reason:</label>
                        <select id="rejectionOrderType" class="form-select" name="rejectionOrderType">
                            <option value="dropped">Dropped</option>
                            <option value="deceased">Deceased</option>
                            <option value="notmaintenanceact">Not Maintenance Act</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rejectionOrderFile" class="form-label">Upload File:</label>
                        <input type="file" id="rejectionOrderFile" name="rejectionOrderFile" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="button" class="rejectItem btn btn-success" onclick="reject()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Approve Modal -->
<div class="modal fade" id="approve-popup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Are you sure?</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure to Accept this Application?</h4>
                </div>
                <form id="approveForm">
                    @csrf
                    <div class="text-center">
                        <h5>Reason for Accept</h5>
                        <textarea class="form-control" name="approve_reason" id="approve_reason" required></textarea>
                        <span id="approval-error"></span>
                    </div>
                    <input type="hidden" id="requestId" name="requestId" value="" />
                    <div class="text-center">
                        <button type="button" onclick="approve()" class="btn btn-primary mt-4 mb-0 me-2">Yes</button>
                        <button type="button" class="btn btn-default mt-4 mb-0" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejection-popup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Are you sure to reject this Application?</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="rejectForm">
                    @csrf
                    <div class="text-center">
                        <h5>Reason for Rejection</h5>
                        <textarea class="form-control" name="reject_reason" id="reject_reason" required></textarea>
                        <span id="rejection-error"></span>
                    </div>
                    <input type="hidden" id="requestId2" name="requestId2" value="" />
                    <div class="text-center">
                        <button type="button" onclick="reject()" class="btn btn-primary mt-4 mb-0 me-2">Yes</button>
                        <button type="button" class="btn btn-default mt-4 mb-0" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
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

        <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Initialize toastr -->
<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        preventDuplicates: true,
        showDuration: 300,
        hideDuration: 1000,
        timeOut: 5000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'
    };
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", ".uploadItem", function() {
                console.log("Upload button clicked");
                $('#upload-popup').modal('show');
            });

            $(document).on("click", ".approveItem", function() {
                console.log("Approve button clicked");
                var id = $(this).attr('data-id');
                $('#requestId').val(id);
                $('#approve-popup').modal('show');
            });

            $(document).on("click", ".uploadrejectItem", function() {
                console.log("Reject-item-Upload button clicked");
                $('#rejection-upload-popup').modal('show');
            });

            $(document).on("click", ".rejectItem", function() {
                console.log("Reject button clicked");
                var id = $(this).attr('data-id');
                $('#requestId2').val(id);
                $('#rejection-popup').modal('show');
            });
        });

        function approve() {
            var reason = $('#approve_reason').val();
    var ordertype = $('#orderType').val();
    var orderfile = $('#orderFile')[0].files[0];
    var request_id = $('#request_id').val();
    var case_id = $('#case_id').val();

    // Check if reason is provided
    if (reason.trim() === '') {
        toastr.error('Please provide a reason for approval.', 'Error!');
        return; // Exit function if reason is not provided
    }

    var formData = new FormData();
    formData.append("id", request_id);
    formData.append("reason", reason);
    formData.append("ordertype", ordertype);
    formData.append("orderfile", orderfile);
    formData.append("case_id", case_id);
    formData.append("_token", "{{ csrf_token() }}");

    $.ajax({
        url: "{{ route('caseData.Rdo.approve') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            toastr.success(response.success, 'Success!');
            $('#approve-popup').modal('hide');
            $('#success_message').fadeIn().html(response.success);
            setTimeout(function() {
                $('#success_message').fadeOut("slow");
            }, 2000);
            setTimeout(function() {
                window.location.href = response.redirect;
            }, 2000);
        },
        error: function(xhr, status, error) {
            toastr.error('An error occurred. Please try again.', 'Error!');
        }
    });
}


function reject() {
            var reason = $('#reject_reason').val();
    var rejectionOrderType = $('#rejectionOrderType').val();
    var orderfile = $('#rejectionOrderFile')[0].files[0];
    var request_id = $('#request_id').val();
    var case_id = $('#case_id').val();

    // Check if reason is provided
    if (reason.trim() === '') {
        toastr.error('Please provide a reason for rejection.', 'Error!');
        return; // Exit function if reason is not provided
    }

    var formData = new FormData();
    formData.append("id", request_id);
    formData.append("reason", reason);
    formData.append("rejectionOrderType", rejectionOrderType);
    formData.append("orderfile", orderfile);
    formData.append("case_id", case_id);
    formData.append("_token", "{{ csrf_token() }}");

    $.ajax({
        url: "{{ route('caseData.Rdo.reject') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            toastr.success(response.success, 'Success!');
            $('#rejection-popup').modal('hide');
            $('#success_message').fadeIn().html(response.success);
            setTimeout(function() {
                $('#success_message').fadeOut("slow");
            }, 2000);
            setTimeout(function() {
                window.location.href = response.redirect;
            }, 2000);
        },
        error: function(xhr, status, error) {
            toastr.error('An error occurred. Please try again.', 'Error!');
        }
    });
}
    </script>

<script>
    function updateHearingDate() {
        // Get the selected date from the input
        var hearingDate = document.getElementById('hearingDateInput').value;
        var request_id = $('#request_id').val(); // Assuming you are using jQuery for this

        // Prepare the data to send
        var data = {
            hearingDate: hearingDate, // Add a comma to separate properties
            id: request_id
        };

        // Ajax request
        $.ajax({
            type: 'POST', // Use 'POST' method
            url: "{{ route('caseData.Rdo.approve') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}" // Add CSRF token
            },
            data: data,
            success: function(response) {
            console.log(response);
            toastr.success(response.success, 'Success!');
            $('#success_message').fadeIn().html(response.success);
            setTimeout(function() {
                $('#success_message').fadeOut("slow");
            }, 2000);
            setTimeout(function() {
                window.location.href = response.redirect;
            }, 2000);
        },
        error: function(xhr, status, error) {
            toastr.error('An error occurred. Please try again.', 'Error!');
        }
        });
    }
</script>




@endsection
