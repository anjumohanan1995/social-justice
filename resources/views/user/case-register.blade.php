@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Case Register</h4>
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
                        <li class="breadcrumb-item active"> Case Register </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .required::after {
                content: "*";
                color: red;
                margin-left: 5px;
            }
        </style>
  <style>
.upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
}

.btn-upload {
    display: inline-block;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    color: #ffffff;
    background-color: #688569;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-upload:hover {
    background-color: #45a049;
}

/* Optional: Styles for the upload icon */
.upload-icon {
    margin-right: 10px;
    vertical-align: middle;
}

.upload-icon svg {
    width: 24px;
    height: 24px;
    fill: #eb1414;
    vertical-align: middle;
}
  </style>
      <style>
        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px; /* Adjust as needed */
        }

        /* Adjusted styles for button */
        .btn-primary {
            padding: 15px 30px; /* Increased padding for larger size */
            font-size: 18px; /* Increased font size */
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4>ആപ്ലിക്കേഷൻ ഫോം</h4>
                        <h4 class="f-m-light mt-1">
                            {{-- If your form layout allows it, you can swap the <code>.{valid|invalid}</code>-feedback classes for<code>.{valid|invalid}</code>-tooltip classes to display validation feedback in a styled tooltip. Be sure to have a parent with <code>position: relative</code> on it for tooltip positioning. --}}
                            മാതാപിതാക്കളുടെയും മുതിർന്ന പൗരൻമാരുടെയും സംരക്ഷണവും ക്ഷേമവും സംബന്ധിച്ച നിയമം – 2007
                        </h4>
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
                        <form class="row g-3 needs-validation custom-input" action="{{ route('case.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                {{-- <div class="row">
                                    <div class="col-12">
                                        <label class="small required"><b>Select Part to Fill:</b></label>
                                        <select id="formPartSelector" class="form-select" required>
                                            <option value="applicant">Applicant Part</option>
                                            <option value="organization">Organization Part</option>
                                        </select>
                                    </div>
                                </div><br><br> --}}

                                {{-- <div id="applicantPart"> --}}
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">ഹർജിക്കാരൻ/ ഹർജിക്കാരുടെ
                                            പേര്<br><span class="small"> Name of Applicant </span> </label>
                                        <input type="text" value="{{ old('name') }}" class="form-control"
                                            placeholder="ഹർജിക്കാരൻ/ ഹർജിക്കാരുടെ പേര്" name="name" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">വയസ്സ് <br><span class="small"> Age</span> </label>
                                        <input type="number" value="{{ old('age') }}" class="form-control"
                                            name="age" placeholder="വയസ്സ്"  />
                                        @error('age')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">തൊഴില്‍ <br><span class="small"> Job</span> </label>
                                        <input type="text" value="{{ old('job') }}" class="form-control"
                                            name="job" placeholder="തൊഴില്‍"  />
                                        @error('job')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">പിൻകോഡ് <br><span class="small required">Pincode</span></label>
                                        <input type="text" value="{{ old('pincode') }}" class="form-control"
                                            name="pincode" id="pincode" placeholder="പിൻകോഡ്" oninput="fetchDistrict()" required />
                                        @error('pincode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">നിലവില്‍ താമസിക്കുന്ന പഞ്ചായത്ത് /മുനിസിപ്പാലിറ്റി /കോര്‍പ്പറെഷന്റെ പേര് <br><span class="small required">Name of Current Panchayat/Municipality/Corporation </span></label>
                                        <select name="panchayat" id="panchayat" class="form-control" required>
                                            <option value="">പഞ്ചായത്ത് /മുനിസിപ്പാലിറ്റി /കോര്‍പ്പറെഷന്റെ പേര് </option>
                                        </select>
                                        {{-- <input type="text" value="{{ old('panchayat') }}" class="form-control"
                                            name="panchayat" id="panchayat" placeholder="നിലവില്‍ താമസിക്കുന്ന പഞ്ചായത്ത് /മുനിസിപ്പാലിറ്റി /കോര്‍പ്പറെഷന്റെ പേര്" required  /> --}}
                                        @error('panchayat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">വാര്‍ഡ്‌ നമ്പര്‍ <br><span class="small required">Ward no </span></label>
                                        <input type="text" value="{{ old('ward_no') }}" class="form-control"
                                            name="ward_no" id="ward_no" placeholder="വാര്‍ഡ്‌ നമ്പര്‍" required  />
                                        @error('ward_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">സ്ഥിരമായ വിലാസം <br><span class="small required"> Address</span> </label>
                                        <textarea type="text" value="{{ old('address') }}" class="form-control" name="address" placeholder="സ്ഥിരമായ വിലാസം" required >{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>താമസസ്ഥലത്തിന്റെ പരിധിയിലുള്ള
                                            പോലീസ് സ്റ്റേഷൻ</b><br><span class="small">
                                            <b>Police Station Within the limits of residence
                                            </b></span> </label></h4>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="validationTooltipUsername">District<br><span class="small required">ജില്ല</span></label>
                                        <div class="input-group has-validation">
                                            <select name="district_id" id="districtid" class="form-control" required>
                                                <option value="">ജില്ല</option>
                                                <!-- Options will be populated dynamically via API -->
                                            </select>
                                            {{-- <div id="selectedValueDisplay"></div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="validationTooltipUsername">Police Station<br><span class="small required">പോലീസ് സ്റ്റേഷൻ</span></label>
                                        <div class="input-group has-validation">
                                            <select name="police_station" id="police_station" class="form-control" required>
                                                <option value="">പോലീസ് സ്റ്റേഷൻ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><br><br>
                                {{-- </div> --}}
                                {{-- <div id="organizationPart" style="display: none;"> --}}
                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>രക്ഷിതാവ് / മുതിർന്ന പൗരൻ വിവരങ്ങള്‍ നല്‍കുന്നതിനു ബുദ്ധിമുട്ട് നേരിടുന്ന വ്യക്തിയാണെങ്കില്‍, ഉത്തരവാതിത്വപ്പെട്ട അംഗീകൃത വ്യക്തി/സംഘടന എന്നിവരുടെ വിവരങ്ങള്‍ </b><br><span class="small">
                                            <b>If the individual faces difficulty in providing parental or senior citizen information, they should provide details of the responsible authorized person or organization.</b></span> </label></h4>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">i)പേര് <br><span class="small">Name </span></label>
                                        <input type="text" value="{{ old('organization_name') }}" class="form-control"
                                            name="organization_name" id="organization_name" placeholder="പേര്"   />
                                        @error('organization_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">ii)വിലാസം <br><span class="small"> Address</span> </label>
                                        <textarea type="text" value="{{ old('organization_address') }}" class="form-control" name="organization_address" placeholder="വിലാസം"  >{{ old('organization_address') }}</textarea>
                                        @error('organization_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">iii)ഫോണ്‍ നമ്പര്‍ <br><span class="small">Phone number</span></label>
                                        <input type="tel" value="{{ old('organization_phone_number') }}" class="form-control"
                                            name="organization_phone_number" id="organization_phone_number" placeholder="ഫോണ്‍ നമ്പര്‍"   />
                                        @error('organization_phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">IV)ഇമെയില്‍ ഐഡി,ഉണ്ടെങ്കില്‍<br><span class="small">Enter your email</span></label>
                                        <input type="email" value="{{ old('organization_email') }}" class="form-control"
                                            name="organization_email" id="organization_email" placeholder="ഇമെയില്‍ ഐഡി,ഉണ്ടെങ്കില്‍" />
                                        @error('organization_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                {{-- </div> --}}


                                {{-- end --}}

                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>ഹർജിക്കാരനെ ബന്ധപ്പെടാനുള്ള വിശദാംശങ്ങൾ </b><br><span class="small">
                                            <b>Applicant's contact details </b></span> </label></h4>
                                    </div>
                                </div><br>
                                <div class="row">

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">മൊബൈല്‍ നമ്പര് <br><span class="small">Phone number</span></label>
                                        <input type="tel" value="{{ old('applicant_phone_number') }}" class="form-control"
                                            name="applicant_phone_number" id="applicant_phone_number" placeholder="മൊബൈല്‍ നമ്പര് "  />
                                        @error('applicant_phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">രണ്ടാമത്തെ മൊബൈല്‍ നമ്പര്‍ <br><span class="small">Alternative Phone number</span></label>
                                        <input type="tel" value="{{ old('alter_phone_number') }}" class="form-control"
                                            name="alter_phone_number" id="alter_phone_number" placeholder="രണ്ടാമത്തെ മൊബൈല്‍ നമ്പര്‍" />
                                        @error('alter_phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">ഇമെയില്‍ ഐഡി<br><span class="small">Enter your email</span></label>
                                        <input type="email" value="{{ old('applicant_email') }}" class="form-control"
                                            name="applicant_email" id="applicant_email" placeholder="ഇമെയില്‍ ഐഡി" />
                                        @error('applicant_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">ആധാര്‍ നമ്പര്‍ <br> <span class="small">Aadhaar number </span> </label>
                                        <input type="text" class="form-control" name="aadhaar_no" id="aadhaar_no"
                                            value="{{ old('aadhaar_no') }}" placeholder="ആധാര്‍ നമ്പര്‍" />
                                        @error('aadhaar_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">ഹർജിക്കാരന്റെ പേരിൽ വസ്തുവകകൾ ഉണ്ടോ ? ഉണ്ടെങ്കിൽ വിവരിക്കുക
                                            <br> <span class="small">Are there any properties in the petitioner's name? If yes describe </span> </label>
                                            <textarea type="text" value="{{ old('petitioner_properties') }}" class="form-control" name="petitioner_properties" placeholder="ഹർജിക്കാരന്റെ പേരിൽ വസ്തുവകകൾ ഉണ്ടോ ? ഉണ്ടെങ്കിൽ വിവരിക്കുക">{{ old('petitioner_properties') }}</textarea>
                                        @error('petitioner_properties')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>അപേക്ഷക കക്ഷിയുടെ ബാങ്ക് അക്കൗണ്ട് വിവരങ്ങള്‍ (ജീവനാംശം
                                            ആവശ്യമുണ്ടെങ്കില്‍, ബാങ്ക് പാസ് ബൂക്ക് കോപ്പി സഹിതം) </b><br><span class="small">
                                            <b>Bank account details of applicant party (maintenance
                                                with bank pass book copy if )</b></span> </label></h4>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">a.) അക്കൗണ്ട് നമ്പര്‍ <br><span class="small">Bank Account number</span></label>
                                        <input type="number" value="{{ old('account_number') }}" class="form-control"
                                            name="account_number" id="account_number" placeholder="അക്കൗണ്ട് നമ്പര്‍"  />
                                        @error('account_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">b.) ബാങ്ക് / ബ്രാഞ്ച് പേര് <br><span class="small">Bank/Branch Name</span></label>
                                        <input type="text" value="{{ old('bank') }}" class="form-control"
                                            name="bank" id="bank" placeholder="ബാങ്ക് / ബ്രാഞ്ച് പേര്"  />
                                        @error('bank')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">c.) IFSC code<br><span class="small">IFSC code</span></label>
                                        <input type="text" value="{{ old('ifsc_code') }}" class="form-control"
                                            name="ifsc_code" id="ifsc_code" placeholder="IFSC code"   />
                                        @error('ifsc_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>


                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>ഹർജിക്കാരന് വരുമാനമാർഗം
                                            ഉണ്ടെങ്കിൽ വിശദീകരിക്കുക</b><br><span class="small">
                                            <b>Source of income for the applicant
                                                If yes please explain
                                            </b></span> </label></h4>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">a)പെൻഷനിൽ
                                            നിന്ന് <br><span class="small">From Pension</span></label>
                                        <input type="text" value="{{ old('pension') }}" class="form-control"
                                            name="pension" id="pension" placeholder="പെൻഷനിൽ നിന്ന്" />
                                        @error('pension')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">b)സേവിങ്സ് <br><span class="small">Savings</span></label>
                                        <input type="text" value="{{ old('savings') }}" class="form-control"
                                            name="savings" id="savings" placeholder="സേവിങ്സ് " />
                                        @error('savings')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">c)മറ്റുള്ളവ<br><span class="small">Others</span></label>
                                        <input type="text" value="{{ old('other_income') }}" class="form-control"
                                            name="other_income" id="other_income" placeholder="മറ്റുള്ളവ" />
                                        @error('other_income')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>എതിര്‍കക്ഷികളുടെ വിവരങ്ങള്‍</b><br><span class="small">
                                            <b>Information of opposite parties</b></span> </label></h4>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for=""> എതിർകക്ഷികളുടെ പേര്<br> <span class="small required">Opposition Name </span></label>
                                        </div>
                                        <div class="col-md-1">
                                            <label for=""> വയസ്സ് <br> <span class="small">Age</span> </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label for=""> ബന്ധം <br> <span class="small">Relationship </span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label for=""> മൊബൈല്‍ നമ്പര്‍ <br> <span class="small required">Mobile Number </span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label for=""> വിലാസം <br> <span class="small required">Address </span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label for=""> എതിര്‍കക്ഷിയുടെ ജോലി/പ്രതിമാസവരുമാനം(ഏകദേശം) <br> <span class="small">Opposition Job/Salary </span></label>
                                        </div>
                                    </div>

                                    <div class="row addRow">
                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(old('opposition_name')[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="എതിർകക്ഷികളുടെ പേര്" name="opposition_name[]" required />
                                            @error('opposition_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-1">
                                            <input type="text" value="{{ htmlspecialchars(old('opposition_age')[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="വയസ്സ്" name="opposition_age[]" />
                                            @error('opposition_age')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(old('opposition_relationship')[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="ബന്ധം " name="opposition_relationship[]" />
                                            @error('opposition_relationship')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(old('opposition_mobile')[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="മൊബൈല്‍ നമ്പര്‍ " name="opposition_mobile[]" required />
                                            @error('opposition_mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(old('opposition_address')[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="വിലാസം " name="opposition_address[]" required />
                                            @error('opposition_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(old('opposition_salary')[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="എതിര്‍കക്ഷിയുടെ ജോലി/പ്രതിമാസവരുമാനം(ഏകദേശം) " name="opposition_salary[]" />
                                            @error('opposition_salary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-1">
                                            <a class="insert">+</a>
                                        </div>
                                    </div>

                                    @php
                                        $i = 0;
                                    @endphp

                                    @if (!empty(old('opposition_name')))
                                        @foreach (old('opposition_name') as $index => $item)
                                            <div class="row addRow">
                                                <div class="col-md-2">
                                                    <input type="text" value="{{ old('opposition_name')[$index] }}" class="form-control case_registration--add--inputbox" placeholder="എതിർകക്ഷികളുടെ പേര്" name="opposition_name[]" required />
                                                    @error('opposition_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-1">
                                                    <input type="text" value="{{ old('opposition_age')[$index] }}" class="form-control case_registration--add--inputbox" placeholder="വയസ്സ്" name="opposition_age[]" />
                                                    @error('opposition_age')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" value="{{ old('opposition_relationship')[$index] }}" class="form-control case_registration--add--inputbox" placeholder="ബന്ധം" name="opposition_relationship[]" />
                                                    @error('opposition_relationship')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" value="{{ old('opposition_mobile')[$index] }}" class="form-control case_registration--add--inputbox" placeholder="മൊബൈല്‍ നമ്പര്‍" name="opposition_mobile[]" required />
                                                    @error('opposition_mobile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" value="{{ old('opposition_address')[$index] }}" class="form-control case_registration--add--inputbox" placeholder="വിലാസം" name="opposition_address[]" required />
                                                    @error('opposition_address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" value="{{ old('opposition_salary')[$index] }}" class="form-control case_registration--add--inputbox" placeholder="എതിര്‍കക്ഷിയുടെ ജോലി/പ്രതിമാസവരുമാനം(ഏകദേശം)" name="opposition_salary[]" />
                                                    @error('opposition_salary')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-1">
                                                    <a class="delete">-</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div id="items"></div>
                                </div>
                                <br>


                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label class="form-label">എതിര്‍കക്ഷിയില്‍ നിന്നും ഉണ്ടായ
                                            അക്രമം : / അപേക്ഷയ്ക്ക്
                                            ആധാരമായ കാരണങ്ങള്‍
                                            <br> <span class="small required">Violence from the opposite party :/
                                                Grounds for application </span> </label>
                                            <textarea type="text" value="{{ old('case_details') }}" class="form-control" name="case_details" placeholder="എതിര്‍കക്ഷിയില്‍ നിന്നും ഉണ്ടായ അക്രമം : / അപേക്ഷയ്ക്ക് ആധാരമായ കാരണങ്ങള്‍" required>{{ old('case_details') }}</textarea>
                                        @error('case_details')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>എതിര്‍കക്ഷികളില്‍ നിന്ന് ഏത്
                                            തരത്തിലുള്ള പരിഹാരം
                                            /സംരക്ഷണം / ക്ഷേമമാണ്
                                            ആവശ്യപ്പെടുന്നത് / പ്രതീക്ഷിക്കുന്നത്

                                            ?</b><br><span class="small">
                                            <b>
                                                What kind of settlement / protection / welfare is sought / expected from the opposite parties
                                            </b></span> </label></h4>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">a)പ്രതിമാസം ജീവനാംശം ലഭിക്കൽ
                                            <br> <span class="small">
                                                a)Receipt of monthly alimony </span> </label>
                                            <textarea type="text" value="{{ old('opposition_alimony') }}" class="form-control" name="opposition_alimony" placeholder="പ്രതിമാസം ജീവനാംശം ലഭിക്കൽ">{{ old('opposition_alimony') }}</textarea>
                                        @error('opposition_alimony')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">b)സ്വത്ത് തിരികെ ലഭിക്കൽ
                                            <br> <span class="small">
                                                b) Recovery of property </span> </label>
                                            <textarea type="text" value="{{ old('opposition_ property') }}" class="form-control" name="opposition_property" placeholder="സ്വത്ത് തിരികെ ലഭിക്കൽ">{{ old('opposition_property') }}</textarea>
                                        @error('opposition_property')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">c)സംരക്ഷണം ഉറപ്പു വരുത്തൽ
                                            (ഭക്ഷണം, വസ്ത്രം,താമസം )
                                            <br> <span class="small">c) Ensuring protection
                                                (Food, clothing, accommodation) </span> </label>
                                            <textarea type="text" value="{{ old('opposition_reason') }}" class="form-control" name="opposition_reason" placeholder="സംരക്ഷണം ഉറപ്പു വരുത്തൽ(ഭക്ഷണം, വസ്ത്രം,താമസം )">{{ old('opposition_reason') }}</textarea>
                                        @error('opposition_reason')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">d)മരുന്ന് / ചികിത്സ / വൈദ്യശുശ്രൂഷ ഉറപ്പാക്കുന്നതിന്
                                            <br> <span class="small">
                                                d) To secure medicine / treatment / medical care </span> </label>
                                            <textarea type="text" value="{{ old('opposition_medical') }}" class="form-control" name="opposition_medical" placeholder="മരുന്ന് / ചികിത്സ / വൈദ്യശുശ്രൂഷ ഉറപ്പാക്കുന്നതിന്">{{ old('opposition_medical') }}</textarea>
                                        @error('opposition_medical')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">e) മക്കളെ കാണുന്നതിനുള്ള
                                            അവസരം ഒരുക്കൽ
                                            <br> <span class="small">e) Oppertunity to see childrens </span> </label>
                                            <textarea type="text" value="{{ old('opposition_oppertunity') }}" class="form-control" name="opposition_oppertunity" placeholder="മക്കളെ കാണുന്നതിനുള്ള അവസരം ഒരുക്കൽ">{{ old('opposition_oppertunity') }}</textarea>
                                        @error('opposition_oppertunity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">f) എതിർകക്ഷിയെ വീട്ടിൽ നിന്നും
                                            ഒഴിവാക്കൽ
                                            <br> <span class="small">f) Avoid opposite parties from home </span> </label>
                                            <textarea type="text" value="{{ old('opposition_avoid') }}" class="form-control" name="opposition_avoid" placeholder="എതിർകക്ഷിയെ വീട്ടിൽ നിന്നും ഒഴിവാക്കൽ">{{ old('opposition_avoid') }}</textarea>
                                        @error('opposition_avoid')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">g)പോലീസ് സഹായം / സംരക്ഷണം
                                            <br> <span class="small">g) Police Assistance / Protection </span> </label>
                                            <textarea type="text" value="{{ old('opposition_police') }}" class="form-control" name="opposition_police" placeholder="പോലീസ് സഹായം / സംരക്ഷണം">{{ old('opposition_police') }}</textarea>
                                        @error('opposition_police')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">h)മറ്റുള്ളവ, വിശദീകരിക്കുക :
                                            <br> <span class="small">h)Others, please explain : </span> </label>
                                            <textarea type="text" value="{{ old('opposition_others') }}" class="form-control" name="opposition_others" placeholder="മറ്റുള്ളവ, വിശദീകരിക്കുക">{{ old('opposition_others') }}</textarea>
                                        @error('opposition_others')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>

                                <div class="row"> <div class="col-md-6"><span class="font-22"><b> ഇതുമായി ബന്ധപ്പെട്ട്
                                    മറ്റെവിടെയെങ്കിലും (കോടതി
                                    /പോലീസ്/മറ്റുള്ളവ ) പരാതി
                                    നല്‍കിയിട്ടുണ്ടോ</b></span> <br><span class="small"><b> In connection with this, have you submitted a complaint elsewhere (Court/Police/Other)?</b>  </span> </div>
                                    <div class="col-md-6">
                                         <label class="form-label w-25 float-left">
                                            <input class="form-control  w-auto float-left" type="radio" name="opposition_complaint" value="Yes" {{ old('opposition_complaint') === 'Yes' ? 'checked' : '' }}>&nbsp; Yes/ഉണ്ട്</label>
                                            <label class="form-label  w-25 float-left">
                                            <input class="form-control  w-auto float-left" type="radio" name="opposition_complaint" value="No" {{ old('opposition_complaint') === 'No' ? 'checked' : '' }}> &nbsp; No/ഇല്ല</label>
                                    </div>
                                </div><br>


                                <div id="additionalDiv" style="display:none;">

                                    <div class="row">
                                        <div class="col-md-12">
                                                <label class="form-label"> ഉണ്ടെങ്കില്‍ വിശദീകരിക്കുക <br><span class="small"> If yes please explain </span></label>
                                                <textarea type="text" value="{{ old('complaint_details') }}" class="form-control" name="complaint_details" placeholder="ഉണ്ടെങ്കില്‍ വിശദീകരിക്കുക" >{{ old('complaint_details') }}</textarea>

                                        </div>

                                    </div><br>

                                </div><br>


                                <div class="row">
                                    <h4><label class="form-label"><b>സത്യവാങ്മൂലം</b><br><span class="small">
                                        <b>Declaration
                                        </b></span> </label></h4>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            ഹർജിക്കാരൻ്റെ പേര്
                                            <br> <span class="small required">Name of Applicant </span> </label>
                                        <input type="text" value="{{ old('applicant_name') }}" class="form-control" name="applicant_name" id="applicant_name" placeholder="ഹർജിക്കാരൻ്റെ പേര്" required />
                                        @error('applicant_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">S/o, D/o, W/o
                                            <br> <span class="small required">S/o, D/o, W/o </span> </label>
                                        <input type="text" value="{{ old('relative_name') }}" class="form-control" name="relative_name" id="relative_name" placeholder="S/o, D/o, W/o" required />
                                        @error('relative_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            സ്ഥലം
                                            <br> <span class="small required">Place </span> </label>
                                        <input type="text" value="{{ old('applicant_place') }}" class="form-control" name="applicant_place" id="applicant_place" placeholder="സ്ഥലം" required />
                                        @error('applicant_place')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            ഒപ്പ്
                                            <br> <span class="small required">Signature </span> </label>

                                            <input type="file" class="form-control" name="applicant_sign" id="applicant_sign" accept="image/jpeg,image/png,image/jpg" required />
                                            @error('applicant_sign')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">തീയതി
                                            <br> <span class="small required">Date </span> </label>
                                        <input type="Date" value="{{ old('date') }}" class="form-control" name="date" id="date" placeholder="തീയതി" required />
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            അപ്പീൽ വാദി
                                            <br> <span class="small required">Appellant </span> </label>
                                        <input type="text" value="{{ old('appellant') }}" class="form-control" name="appellant" id="appellant" placeholder="അപ്പീൽ വാദി" required/>
                                        @error('appellant')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb4">
                                            <textarea class="form-control" rows="10" id="declaration" readonly></textarea>

                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="upload-btn-wrapper">
                                            <span class="upload-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#000000">
                                                    <path d="M20 4H12L10 2H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 1.99 2H20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8h16v10zm-8-5h4v1h-4v4H12v-4H8v-1h4v-4z" />
                                                </svg>
                                            </span>
                                            {{-- <label for="file-upload" class="btn-upload">Choose File</label> --}}
                                            <input type="file" class="btn-upload" name="file-upload" id="file-upload">
                                            @error('file-upload')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- end '''''''''''''''''''' --}}
                                <div class="col-12 button-container">
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </div>
                        </form>

                    </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{-- <script>
var districtid = $('#districtid').val();
    if(districtid){
        alert("yes");
    }
</script> --}}
{{-- <script>
    $(document).ready(function() {
        // Change event for district dropdown
        $('#districtid').change(function() {
            var district_id = $(this).val();
            // AJAX call to fetch police stations based on district_id
            $.ajax({
                url: "{{ route('get-police-station') }}?district_id=" + district_id, // Include district_id in the URL
                type: 'GET', // Use GET method to pass parameters in the URL
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    console.log(response);
                    if (response) {
                        $("#police_station").empty(); // Clear previous options

                        // Populate police station dropdown
                        $.each(response, function(i, item) {
                            $("#police_station").append('<option value="' + item._id + '">' + item.name + '</option>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log errors for debugging
                }
            });
        });

        // Simulate the change event if district options are populated via API on pincode entry
        $('#pincode').on('input', function() {
            // Assume district options are populated dynamically when pincode is entered
            // Trigger change event manually to fetch police stations for the selected district
            $('#districtid').trigger('change');
        });
    });
</script> --}}



<script>
$(document).ready(function() {
    let count = 1;

    $(".insert").click(function(e) {
        e.preventDefault();


        // Increment the count for each new row.
        count++;

        // Build the HTML using jQuery.
        var html = '<div class="row addRow">' +
            '<div class="col-md-2">' +
            '<input type="text" class="form-control case_registration--add--inputbox" placeholder="എതിർകക്ഷികളുടെ പേര്" name="opposition_name[]" required />' +
            '<span class="text-danger error-message" id="nameError' + count + '"></span>' +
            '</div>' +

            '<div class="col-md-1">' +
            '<input type="text" class="form-control case_registration--add--inputbox" placeholder="വയസ്സ്" name="opposition_age[]" />' +
            '<span class="text-danger error-message" id="ageError' + count + '"></span>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<input type="text" class="form-control case_registration--add--inputbox" placeholder="ബന്ധം" name="opposition_relationship[]" />' +
            '<span class="text-danger error-message" id="relationshipError' + count + '"></span>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<input type="text" class="form-control case_registration--add--inputbox" placeholder="മൊബൈല്‍ നമ്പര്‍" name="opposition_mobile[]" required />' +
            '<span class="text-danger error-message" id="mobileError' + count + '"></span>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<input type="text" class="form-control case_registration--add--inputbox" placeholder="വിലാസം" name="opposition_address[]" />' +
            '<span class="text-danger error-message" id="addressError' + count + '"></span>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<input type="text" class="form-control case_registration--add--inputbox" placeholder="എതിര്‍കക്ഷിയുടെ ജോലി/പ്രതിമാസവരുമാനം(ഏകദേശം)" name="opposition_salary[]" />' +
            '<span class="text-danger error-message" id="salaryError' + count + '"></span>' +
            '</div>' +

            '<div class="col-md-1">' +
            '<a class="delete">-</a>' +
            '</div>' +
            '</div>';

        // Append the newly built HTML to the "#items" div
        $("#items").append(html);
    });

    $("body").on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).closest(".addRow").remove();
    });
});


</script>
<script>

        //duplication code ends here.



        $(document).ready(function() {
     	$('input[name="opposition_complaint"]').change(function() {
            if ($(this).val() === 'Yes') {
                $('#additionalDiv').show();
            } else {
                $('#additionalDiv').hide();
            }
        });
	});

    function validateImage() {
    var input = document.getElementById('applicant_sign');
    var errorMessage = document.getElementById('errorMessage');

    if (input.files.length > 0) {
        var fileSize = input.files[0].size; // in bytes
        var maxSize = 2 * 1024 * 1024; // 2MB
        var validExtensions = ['jpg', 'png', 'jpeg'];

        var fileExtension = input.files[0].name.split('.').pop().toLowerCase();

        if (fileSize > maxSize) {
            errorMessage.innerText = 'Error: Image size exceeds 2MB limit';
            input.value = ''; // Clear the file input
            $("#submit").prop("disabled", true);
        } else if (!validExtensions.includes(fileExtension)) {
            errorMessage.innerText = 'Error: Image must be in JPG, PNG, or JPEG format';
            input.value = ''; // Clear the file input
            $("#submit").prop("disabled", true);
        } else {
            errorMessage.innerText = '';
            $("#submit").prop("disabled", false);
        }
    }
}

</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const applicantNameInput = document.getElementById('applicant_name');
        const relativeNameInput = document.getElementById('relative_name');
        const placeNameInput = document.getElementById('applicant_place');
        const signatureInput = document.getElementById('applicant_sign');
        const dateInput = document.getElementById('date');
        const appellantInput = document.getElementById('appellant');
        const declarationTextarea = document.getElementById('declaration');

        function updateDeclaration() {
            const applicantName = applicantNameInput.value;
            const relativeName = relativeNameInput.value;
            const place = placeNameInput.value;
            const signature = signatureInput.value;
            const date = dateInput.value;
            const appellant = appellantInput.value;
            declarationTextarea.value = `ഞാൻ ${applicantName}, S/o, D/o, W/o ${relativeName}, വയസ്സുള്ള എനിക്ക് മേൽ ചോദ്യങ്ങള്‍ എന്റെ വ്യക്തിപരമായ അറിവിലും വിശ്വാസത്തിലും ശരിയാണെന്നും ഒന്നും മറച്ചുവെച്ചിട്ടില്ലെന്നും ഞാൻ പ്രതിവിധി തേടുന്ന ഉത്തരവിന്റെ വിഷയം ഈ ട്രിബ്യൂണൽ അധികാരപരിധിയിൽ ഉള്ളതാണെന്നും ഇതിനാൽ അറിയിക്കുന്നു . ഈ അപേക്ഷ നൽകിയ കാര്യം ഏതെങ്കിലും കോടതിയുടെയോ മറ്റേതെങ്കിലും അധികാരത്തിന്റെയോ മുമ്പാകെ നിലനിൽക്കുന്നതല്ല എന്നും അല്ലെങ്കിൽ നിരസിക്കപ്പെട്ടിട്ടില്ല എന്നും ഞാൻ ഇതിനാൽ അറിയിക്കുന്നു .
സ്ഥലം : ${place}                                                                      ഒപ്പ് : ${signature}
തീയതി : ${date}                                                                       അപ്പീൽ വാദി : ${appellant}
I, ${applicantName}, S/o, D/o, W/o ${relativeName},age questions on me Nothing is true in personal knowledge and belief.The subject matter of the order against which I seek relief has not been concealed and that this Tribunal is subject to jurisdiction informs
Place : ${place}                                                                     Signaturte : ${signature}
Date : ${date}                                                                       Appellant : ${appellant}`;
        }

        applicantNameInput.addEventListener('input', updateDeclaration);
        relativeNameInput.addEventListener('input', updateDeclaration);
        placeNameInput.addEventListener('input', updateDeclaration);
        signatureInput.addEventListener('input', updateDeclaration);
        dateInput.addEventListener('input', updateDeclaration);
        appellantInput.addEventListener('input', updateDeclaration);

        // Initial update in case there are old values
        updateDeclaration();
    });
</script>

<script>
async function fetchDistrict() {
    const pincode = document.getElementById('pincode').value.trim();  // trim to remove any leading/trailing spaces

    if (pincode.length === 6 && /^\d{6}$/.test(pincode)) {  // validate pincode format
        try {
            const response = await fetch(`https://api.postalpincode.in/pincode/${pincode}`);
            const data = await response.json();

            const districtDropdown = document.getElementById('districtid');
            districtDropdown.innerHTML = '';  // clear existing options

            if (data[0].Status === "Success" && data[0].PostOffice.length > 0) {
                // Create a Set to store unique district names
                const uniqueDistricts = new Set();

                // Iterate through each post office
                data[0].PostOffice.forEach(postOffice => {
                    // Add district name to the Set (which automatically handles duplicates)
                    uniqueDistricts.add(postOffice.District);
                });

                // Convert Set back to an array and sort alphabetically (optional)
                const sortedDistricts = Array.from(uniqueDistricts).sort();

                // Create options for each unique district name
                sortedDistricts.forEach(districtName => {
                    const option = document.createElement('option');
                    option.value = districtName;
                    option.textContent = districtName;
                    districtDropdown.appendChild(option);
                    // selectedDistrict = option.value;
                    fetchPoliceStations(option.value);
                    fetchPanchayats(option.value);

                });

                // Function to handle AJAX request on district selection
                function fetchPoliceStations(selectedDistrict) {
                    // alert(selectedDistrict);
                    // alert($('#districtid').value());
                    $.ajax({
                        url: "{{ route('get-police-station') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            district_name: selectedDistrict
                        },
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                $("#police_station").empty(); // Clear previous options

                                // Populate police station dropdown
                                $.each(response, function(i, item) {
                                    $("#police_station").append('<option value="' + item.id + '">' + item.name + '</option>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }

                function fetchPanchayats(selectedDistrict) {
                    // alert(selectedDistrict);
                    // alert($('#districtid').value());
                    $.ajax({
                        url: "{{ route('get-panchayat') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            district_name: selectedDistrict
                        },
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                $("#panchayat").empty(); // Clear previous options

                                // Populate police station dropdown
                                $.each(response, function(i, item) {
                                    $("#panchayat").append('<option value="' + item.id + '">' + item.name + '</option>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }

                // // Trigger AJAX request when district is selected
                // districtDropdown.addEventListener('change', function() {
                //     const selectedDistrict = this.value;
                //     console.log(selectedDistrict);
                //     fetchPoliceStations(selectedDistrict);
                // });
            } else {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'District not found';
                districtDropdown.appendChild(option);
            }
        } catch (error) {
            console.error('Error fetching data:', error);
            // Handle error, e.g., display a message to the user
        }
    }
}


</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const formPartSelector = document.getElementById('formPartSelector');
        const applicantPart = document.getElementById('applicantPart');
        const organizationPart = document.getElementById('organizationPart');

        formPartSelector.addEventListener('change', function() {
            if (formPartSelector.value === 'applicant') {
                applicantPart.style.display = 'block';
                organizationPart.style.display = 'none';
            } else if (formPartSelector.value === 'organization') {
                applicantPart.style.display = 'none';
                organizationPart.style.display = 'block';
            }
        });
    });
</script> --}}

{{-- <script>
async function fetchDistrict() {
    const pincode = document.getElementById('pincode').value.trim();  // trim to remove any leading/trailing spaces

    if (pincode.length === 6 && /^\d{6}$/.test(pincode)) {  // validate pincode format
        try {
            const response = await fetch(`https://api.postalpincode.in/pincode/${pincode}`);
            const data = await response.json();

            const districtDropdown = document.getElementById('districtid');
            districtDropdown.innerHTML = '';  // clear existing options

            if (data[0].Status === "Success" && data[0].PostOffice.length > 0) {
                // Create a Set to store unique district names
                const uniqueDistricts = new Set();

                // Iterate through each post office
                data[0].PostOffice.forEach(postOffice => {
                    // Add district name to the Set (which automatically handles duplicates)
                    uniqueDistricts.add(postOffice.District);
                });

                // Convert Set back to an array and sort alphabetically (optional)
                const sortedDistricts = Array.from(uniqueDistricts).sort();

                // Create options for each unique district name
                sortedDistricts.forEach(districtName => {
                    const option = document.createElement('option');
                    option.value = districtName;
                    option.textContent = districtName;
                    districtDropdown.appendChild(option);

                });
            } else {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'District not found';
                districtDropdown.appendChild(option);
            }
        } catch (error) {
            console.error('Error fetching data:', error);
            // Handle error, e.g., display a message to the user
        }
    }
}


</script> --}}

@endsection

