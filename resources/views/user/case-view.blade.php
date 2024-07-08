@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>View Case</h4>
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
                            <li class="breadcrumb-item active">View Case</li>
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
                            <div class="card-body">
                                <div id="btnHide" class="row justify-content-end m-3" style="position: absolute; top: 100px; right: 200px;">
                                    <a style="width: 20px; height: 20px;" onclick="printDiv()">
                                        <img src="{{ asset('admin/uploads/icons/printer.png') }}" alt="Print Icon" style="height: 200%;">
                                    </a>
                                </div>
                                <div id="print_content">
                            <h2 class="form-title">Case ID: {{ @$cases->case_id }}</h2>
                        <form class="row g-3 needs-validation custom-p" >
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">അപേക്ഷക/ അപേക്ഷകരുടെ പേര്<br><span class="small"> Name of Applicant </span></label>
                                        <p>{{ @$cases->name }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">വയസ്സ്<br><span class="small"> Age</span></label>
                                        <p>{{ @$cases->age }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">തൊഴില്‍<br><span class="small"> Job</span></label>
                                        <p>{{ @$cases->job }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">നിലവില്‍ താമസിക്കുന്ന പഞ്ചായത്ത് /മുനിസിപ്പാലിറ്റി /കോര്‍പ്പറെഷന്റെ പേര്<br><span class="small">Name of Currently residing Panchayat/Municipality/Corporation</span></label>
                                        <p>{{ @$cases->panchayath }}</p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">സ്ഥിരമായ വിലാസം<br><span class="small required"> Address</span></label>
                                        <p>{{ @$cases->address }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">വാര്‍ഡ്‌ നമ്പര്‍<br><span class="small">Ward no</span></label>
                                        <p>{{ @$cases->ward_no }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">പിൻകോഡ്<br><span class="small required">Pincode</span></label>
                                        <p>{{ @$cases->pincode }}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <label class="form-label">
                                                <b>രക്ഷിതാവ് / മുതിർന്ന പൗരൻ വിവരങ്ങള്‍ നല്‍കുന്നതിനു ബുദ്ധിമുട്ട് നേരിടുന്ന വ്യക്തിയാണെങ്കില്‍, ഉത്തരവാതിത്വപ്പെട്ട അംഗീകൃത വ്യക്തി/സംഘടന എന്നിവരുടെ വിവരങ്ങള്‍</b><br>
                                                <span class="small">
                                                    <b>If the individual faces difficulty in providing parental or senior citizen information, they should provide details of the responsible authorized person or organization.</b>
                                                </span>
                                            </label>
                                        </h4>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">i)പേര്<br><span class="small">Name</span></label>
                                        <p>{{ @$cases->organization_name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">ii)വിലാസം<br><span class="small">Address</span></label>
                                        <p>{{ @$cases->organization_address }}</p>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">iii)ഫോണ്‍ നമ്പര്‍<br><span class="small">Phone number</span></label>
                                        <p>{{ @$cases->organization_phone_number }}</p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">IV)ഇമെയില്‍ ഐഡി,ഉണ്ടെങ്കില്‍<br><span class="small">Enter your email</span></label>
                                        <p>{{ @$cases->organization_email }}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>അപേക്ഷകനെ ബന്ധപ്പെടാനുള്ള വിശദാംശങ്ങൾ</b><br><span class="small">
                                            <b>Applicant's contact details</b></span> </label></h4>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">മൊബൈല്‍ നമ്പര്<br><span class="small">Phone number</span></label>
                                        <p>{{ @$cases->applicant_phone_number }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">രണ്ടാമത്തെ മൊബൈല്‍ നമ്പര്‍<br><span class="small">Alternative Phone number</span></label>
                                        <p>{{ @$cases->alter_phone_number }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">ഇമെയില്‍ ഐഡി<br><span class="small">Enter your email</span></label>
                                        <p>{{ @$cases->applicant_email }}</p>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">ആധാര്‍ നമ്പര്‍<br><span class="small">Aadhaar number</span></label>
                                        <p>{{ @$cases->aadhaar_no }}</p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">ഹർജിക്കാരന്റെ പേരിൽ വസ്തുവകകൾ ഉണ്ടോ ? ഉണ്ടെങ്കിൽ വിവരിക്കുക<br><span class="small">Are there any properties in the petitioner's name? If yes describe</span></label>
                                        <p>{{ @$cases->petitioner_properties }}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <label class="form-label">
                                                <b>അപേക്ഷക കക്ഷിയുടെ ബാങ്ക് അക്കൗണ്ട് വിവരങ്ങള്‍ (ജീവനാംശം ആവശ്യമുണ്ടെങ്കില്‍, ബാങ്ക് പാസ് ബൂക്ക് കോപ്പി സഹിതം)</b><br>
                                                <span class="small"><b>Bank account details of applicant party (maintenance with bank pass book copy if )</b></span>
                                            </label>
                                        </h4>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">a.) അക്കൗണ്ട് നമ്പര്‍<br><span class="small">Bank Account number</span></label>
                                        <p>{{ @$cases->account_number }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">b.) ബാങ്ക് / ബ്രാഞ്ച് പേര്<br><span class="small">Bank/Branch Name</span></label>
                                        <p>{{ @$cases->bank }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">c.) IFSC code<br><span class="small">IFSC code</span></label>
                                        <p>{{ @$cases->ifsc_code }}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <label class="form-label">
                                                <b>താമസസ്ഥലത്തിന്റെ പരിധിയിലുള്ള പോലീസ് സ്റ്റേഷൻ</b><br>
                                                <span class="small"><b>Police Station Within the limits of residence</b></span>
                                            </label>
                                        </h4>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">District<br><span class="small required">ജില്ല</span></label>
                                        <p>
                                            @foreach($districts as $district)
                                                @if($district->_id == $cases->district_id)
                                                    {{ $district->name }}
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">Police Station<br><span class="small required">പോലീസ് സ്റ്റേഷൻ</span></label>
                                        <p>
                                            @foreach($districts as $district)
                                                @foreach($district->policeStations as $station)
                                                    @if($station->_id == $cases->police_station_id)
                                                        {{ $station->name }}
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>അപേക്ഷകന് വരുമാനമാർഗം ഉണ്ടെങ്കിൽ വിശദീകരിക്കുക</b><br><span class="small"><b>Source of income for the applicant If yes please explain</b></span></label></h4>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">a)പെൻഷനിൽ നിന്ന്<br><span class="small">From Pension</span></label>
                                        <p>{{ @$cases->pension }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">b)സേവിങ്സ്<br><span class="small">Savings</span></label>
                                        <p>{{ @$cases->savings }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">c)മറ്റുള്ളവ<br><span class="small">Others</span></label>
                                        <p>{{ @$cases->other_income }}</p>
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
                                            <label>എതിർകക്ഷികളുടെ പേര്<br><span class="small required">Opposition Name</span></label>
                                        </div>
                                        <div class="col-md-1">
                                            <label>വയസ്സ്<br><span class="small">Age</span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>ബന്ധം<br><span class="small">Relationship</span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>മൊബൈല്‍ നമ്പര്‍<br><span class="small required">Mobile Number</span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>വിലാസം<br><span class="small required">Address</span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>എതിര്‍കക്ഷിയുടെ ജോലി/പ്രതിമാസവരുമാനം(ഏകദേശം)<br><span class="small">Opposition Job/Salary</span></label>
                                        </div>
                                    </div>

                                    @foreach($cases->opposition_name as $index => $item)
                                        <div class="row addRow">
                                            <div class="col-md-2">
                                                <p>{{ $item }}</p>
                                            </div>
                                            <div class="col-md-1">
                                                <p>{{ $cases->opposition_age[$index] ?? '' }}</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>{{ $cases->opposition_relationship[$index] ?? '' }}</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>{{ $cases->opposition_mobile[$index] ?? '' }}</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>{{ $cases->opposition_address[$index] ?? '' }}</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>{{ $cases->opposition_salary[$index] ?? '' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <br>



                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label class="form-label">എതിര്‍കക്ഷിയില്‍ നിന്നും ഉണ്ടായ
                                            അക്രമം : / അപേക്ഷയ്ക്ക്
                                            ആധാരമായ കാരണങ്ങള്‍
                                            <br> <span class="small required">Violence from the opposite party :/
                                                Grounds for application </span> </label>
                                        <p>{{ @$cases->case_details }}</p>
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
                                        <p>{{ @$cases->opposition_alimony }}</p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">b)സ്വത്ത് തിരികെ ലഭിക്കൽ
                                            <br> <span class="small">
                                                b) Recovery of property </span> </label>
                                        <p>{{ @$cases->opposition_property }}</p>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">c)സംരക്ഷണം ഉറപ്പു വരുത്തൽ
                                            (ഭക്ഷണം, വസ്ത്രം,താമസം )
                                            <br> <span class="small">c) Ensuring protection
                                                (Food, clothing, accommodation) </span> </label>
                                        <p>{{ @$cases->opposition_reason }}</p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">d)മരുന്ന് / ചികിത്സ / വൈദ്യശുശ്രൂഷ ഉറപ്പാക്കുന്നതിന്
                                            <br> <span class="small">
                                                d) To secure medicine / treatment / medical care </span> </label>
                                        <p>{{ @$cases->opposition_medical }}</p>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">e) മക്കളെ കാണുന്നതിനുള്ള
                                            അവസരം ഒരുക്കൽ
                                            <br> <span class="small">e) Oppertunity to see childrens </span> </label>
                                        <p>{{ @$cases->opposition_oppertunity }}</p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">f) എതിർകക്ഷിയെ വീട്ടിൽ നിന്നും
                                            ഒഴിവാക്കൽ
                                            <br> <span class="small">f) Avoid opposite parties from home </span> </label>
                                        <p>{{ @$cases->opposition_avoid }}</p>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">g)പോലീസ് സഹായം / സംരക്ഷണം
                                            <br> <span class="small">g) Police Assistance / Protection </span> </label>
                                        <p>{{ @$cases->opposition_police }}</p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">h)മറ്റുള്ളവ, വിശദീകരിക്കുക :
                                            <br> <span class="small">h)Others, please explain : </span> </label>
                                        <p>{{ @$cases->opposition_others }}</p>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="font-22"><b> ഇതുമായി ബന്ധപ്പെട്ട്
                                            മറ്റെവിടെയെങ്കിലും (കോടതി
                                            /പോലീസ്/മറ്റുള്ളവ ) പരാതി
                                            നല്‍കിയിട്ടുണ്ടോ</b></span> <br>
                                        <span class="small"><b> In connection with this, have you submitted a complaint elsewhere (Court/Police/Other)?</b></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label w-25 float-left">
                                            <span w-auto float-left">{{ @$cases->opposition_complaint === 'Yes' ? 'Yes/ഉണ്ട്' : 'No/ഇല്ല' }}</span>
                                        </label>
                                    </div>
                                </div><br>

                                @if(@$cases->opposition_complaint === 'Yes')
                                <div id="additionalDiv">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label"> ഉണ്ടെങ്കില്‍ വിശദീകരിക്കുക <br>
                                                <span class="small"> If yes please explain </span>
                                            </label>
                                            <p>{{ @$cases->complaint_details }}</p>
                                        </div>
                                    </div><br>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            അപേക്ഷകൻ്റെ പേര്
                                            <br> <span class="small required">Name of Applicant </span>
                                        </label>
                                        <p>{{ @$cases->applicant_name }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">S/o, D/o, W/o
                                            <br> <span class="small required">S/o, D/o, W/o </span>
                                        </label>
                                        <p>{{ @$cases->relative_name }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            സ്ഥലം
                                            <br> <span class="small required">Place </span>
                                        </label>
                                        <p>{{ @$cases->applicant_place }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            ഒപ്പ്
                                            <br> <span class="small required">Signature </span>
                                        </label>
                                        @if(@$cases['applicant_sign'])
                                        {{-- <iframe src="{{ asset('sign/huband/' . @$childFinancialHelp['husband_sign']) }}" width="400" height="200"></iframe> --}}
                                        <img src="{{ asset('/sign/applicant_sign/' . @$cases['applicant_sign']) }}" width="120px" height="60px">
                                    @endif
                                        {{-- <p>{{ @$cases->applicant_sign }}</p> --}}
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">തീയതി
                                            <br> <span class="small required">Date </span>
                                        </label>
                                        <p>{{ @$cases->date }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            അപ്പീൽ വാദി
                                            <br> <span class="small required">Appellant </span>
                                        </label>
                                        <p>{{ @$cases->appellant }}</p>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12 d-flex justify-content-end">
                                    <a id="submitButton" href="{{ route('appeal', $cases->id) }}" class="btn btn-primary">File for Appeal</a>
                                </div> --}}

                            </div>
                        </form>
                        </div>
                        </div>
                    </div>



                </div>

                <div>
                </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
            function printDiv() {
        var printContents = document.getElementById('print_content').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
    </script>
@endsection
