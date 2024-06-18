@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Case Edit</h4>
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
                        <li class="breadcrumb-item active"> Case Edit </li>
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
                        <form class="row g-3 needs-validation custom-input" action="{{ route('cases.update', ['case' => $cases->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">അപേക്ഷക/ അപേക്ഷകരുടെ
                                            പേര്<br><span class="small"> Name of Applicant </span> </label>
                                        <input type="text" value="{{ @$cases->name }}" class="form-control"
                                            placeholder="അപേക്ഷക/ അപേക്ഷകരുടെ പേര്" name="name" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">വയസ്സ് <br><span class="small"> Age</span> </label>
                                        <input type="number" value="{{ @$cases->age }}" class="form-control"
                                            name="age" placeholder="വയസ്സ്"  />
                                        @error('age')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">തൊഴില്‍ <br><span class="small"> Job</span> </label>
                                        <input type="number" value="{{ @$cases->job }}" class="form-control"
                                            name="job" placeholder="തൊഴില്‍"  />
                                        @error('job')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">നിലവില്‍ താമസിക്കുന്ന പഞ്ചായത്ത് /മുനിസിപ്പാലിറ്റി /കോര്‍പ്പറെഷന്റെ പേര് <br><span class="small">Name of Currently residing Panchayat/Municipality/Corporation </span></label>
                                        <input type="text" value="{{ @$cases->panchayath }}" class="form-control"
                                            name="panchayath" id="panchayath" placeholder="നിലവില്‍ താമസിക്കുന്ന പഞ്ചായത്ത് /മുനിസിപ്പാലിറ്റി /കോര്‍പ്പറെഷന്റെ പേര്"  />
                                        @error('panchayath')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">സ്ഥിരമായ വിലാസം <br><span class="small required"> Address</span> </label>
                                        <textarea type="text" value="{{ @$cases->address }}" class="form-control" name="address" placeholder="സ്ഥിരമായ വിലാസം" required >{{ @$cases->address }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">വാര്‍ഡ്‌ നമ്പര്‍ <br><span class="small">Ward no </span></label>
                                        <input type="text" value="{{ @$cases->ward_no }}" class="form-control"
                                            name="ward_no" id="ward_no" placeholder="വാര്‍ഡ്‌ നമ്പര്‍"  />
                                        @error('ward_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">പിൻകോഡ് <br><span class="small required">Pincode</span></label>
                                        <input type="text" value="{{ @$cases->pincode }}" class="form-control"
                                            name="pincode" id="pincode" placeholder="പിൻകോഡ്" required />
                                        @error('pincode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                {{-- end --}}
                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>രക്ഷിതാവ് / മുതിർന്ന പൗരൻ വിവരങ്ങള്‍ നല്‍കുന്നതിനു ബുദ്ധിമുട്ട് നേരിടുന്ന വ്യക്തിയാണെങ്കില്‍, ഉത്തരവാതിത്വപ്പെട്ട അംഗീകൃത വ്യക്തി/സംഘടന എന്നിവരുടെ വിവരങ്ങള്‍ </b><br><span class="small">
                                            <b>If the individual faces difficulty in providing parental or senior citizen information, they should provide details of the responsible authorized person or organization.</b></span> </label></h4>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">i)പേര് <br><span class="small">Name </span></label>
                                        <input type="text" value="{{ @$cases->organization_name }}" class="form-control"
                                            name="organization_name" id="organization_name" placeholder="പേര്"   />
                                        @error('organization_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">ii)വിലാസം <br><span class="small"> Address</span> </label>
                                        <textarea type="text" value="{{ @$cases->organization_address }}" class="form-control" name="organization_address" placeholder="വിലാസം"  >{{ @$cases->organization_address }}</textarea>
                                        @error('organization_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">iii)ഫോണ്‍ നമ്പര്‍ <br><span class="small">Phone number</span></label>
                                        <input type="tel" value="{{ @$cases->organization_phone_number }}" class="form-control"
                                            name="organization_phone_number" id="organization_phone_number" placeholder="ഫോണ്‍ നമ്പര്‍"   />
                                        @error('organization_phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">IV)ഇമെയില്‍ ഐഡി,ഉണ്ടെങ്കില്‍<br><span class="small">Enter your email</span></label>
                                        <input type="email" value="{{ @$cases->organization_email }}" class="form-control"
                                            name="organization_email" id="organization_email" placeholder="ഇമെയില്‍ ഐഡി,ഉണ്ടെങ്കില്‍" />
                                        @error('organization_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>അപേക്ഷകനെ ബന്ധപ്പെടാനുള്ള വിശദാംശങ്ങൾ </b><br><span class="small">
                                            <b>Applicant's contact details </b></span> </label></h4>
                                    </div>
                                </div><br>
                                <div class="row">

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">മൊബൈല്‍ നമ്പര് <br><span class="small">Phone number</span></label>
                                        <input type="tel" value="{{ @$cases->applicant_phone_number }}" class="form-control"
                                            name="applicant_phone_number" id="applicant_phone_number" placeholder="മൊബൈല്‍ നമ്പര് "  />
                                        @error('applicant_phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">രണ്ടാമത്തെ മൊബൈല്‍ നമ്പര്‍ <br><span class="small">Alternative Phone number</span></label>
                                        <input type="tel" value="{{ @$cases->alter_phone_number }}" class="form-control"
                                            name="alter_phone_number" id="alter_phone_number" placeholder="രണ്ടാമത്തെ മൊബൈല്‍ നമ്പര്‍" />
                                        @error('alter_phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">ഇമെയില്‍ ഐഡി<br><span class="small">Enter your email</span></label>
                                        <input type="email" value="{{ @$cases->applicant_email }}" class="form-control"
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
                                            value="{{ @$cases->aadhaar_no }}" placeholder="ആധാര്‍ നമ്പര്‍" />
                                        @error('aadhaar_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">ഹർജിക്കാരന്റെ പേരിൽ വസ്തുവകകൾ ഉണ്ടോ ? ഉണ്ടെങ്കിൽ വിവരിക്കുക
                                            <br> <span class="small">Are there any properties in the petitioner's name? If yes describe </span> </label>
                                            <textarea type="text" value="{{ @$cases->petitioner_properties }}" class="form-control" name="petitioner_properties" placeholder="ഹർജിക്കാരന്റെ പേരിൽ വസ്തുവകകൾ ഉണ്ടോ ? ഉണ്ടെങ്കിൽ വിവരിക്കുക">{{ @$cases->petitioner_properties }}</textarea>
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
                                        <input type="number" value="{{ @$cases->account_number }}" class="form-control"
                                            name="account_number" id="account_number" placeholder="അക്കൗണ്ട് നമ്പര്‍"  />
                                        @error('account_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">b.) ബാങ്ക് / ബ്രാഞ്ച് പേര് <br><span class="small">Bank/Branch Name</span></label>
                                        <input type="text" value="{{ @$cases->bank }}" class="form-control"
                                            name="bank" id="bank" placeholder="ബാങ്ക് / ബ്രാഞ്ച് പേര്"  />
                                        @error('bank')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">c.) IFSC code<br><span class="small">IFSC code</span></label>
                                        <input type="text" value="{{ @$cases->ifsc_code }}" class="form-control"
                                            name="ifsc_code" id="ifsc_code" placeholder="IFSC code"   />
                                        @error('ifsc_code')
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
                                            <label class="form-label" for="validationTooltipUsername">District<br><span class="small required">
                                                ജില്ല</span></label>
                                            <div class="input-group has-validation">
                                                <select name="district_id" id="districtid"  class="form-control" required>
                                                    <option value="" >
                                                        ജില്ല</option>
                                                        @foreach($districts as $district)
                                                        <option value="{{ $district->_id }}" {{ $district->_id == $cases->district_id ? 'selected' : '' }} >{{ $district->name }}</option>
                                                        @endforeach
                                                        @error('district_id')
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                </select>

                                            </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                            <label class="form-label" for="validationTooltipUsername">Police Station<br><span class="small required">
                                                പോലീസ് സ്റ്റേഷൻ</span></label>
                                            <div class="input-group has-validation">
                                                <select name="police_station" id="police_station"  class="form-control" required>
                                                    {{-- <option value="" >പോലീസ് സ്റ്റേഷൻ</option> --}}
                                                    @foreach($districts as $district)
                                                    @foreach($district->policeStations as $station)
                                                    <option value="{{ $station->_id }}" {{ $station->_id == $cases->police_station_id ? 'selected' : '' }}>
                                                        {{ $station->name }}
                                                    </option>
                                                @endforeach
                                                @endforeach
                                                        @error('police_station')
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                </select>

                                            </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-12">
                                        <h4><label class="form-label"><b>അപേക്ഷകന് വരുമാനമാർഗം
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
                                        <input type="text" value="{{ @$cases->pension }}" class="form-control"
                                            name="pension" id="pension" placeholder="പെൻഷനിൽ നിന്ന്" />
                                        @error('pension')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">b)സേവിങ്സ് <br><span class="small">Savings</span></label>
                                        <input type="text" value="{{ @$cases->savings }}" class="form-control"
                                            name="savings" id="savings" placeholder="സേവിങ്സ് " />
                                        @error('savings')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">c)മറ്റുള്ളവ<br><span class="small">Others</span></label>
                                        <input type="text" value="{{ @$cases->other_income }}" class="form-control"
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
                                            <input type="text" value="{{ htmlspecialchars(@$cases->opposition_name[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="എതിർകക്ഷികളുടെ പേര്" name="opposition_name[]" required />
                                            @error('opposition_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-1">
                                            <input type="text" value="{{ htmlspecialchars(@$cases->opposition_age[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="വയസ്സ്" name="opposition_age[]" />
                                            @error('opposition_age')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(@$cases->opposition_relationship[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="ബന്ധം " name="opposition_relationship[]" />
                                            @error('opposition_relationship')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(@$cases->opposition_mobile[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="മൊബൈല്‍ നമ്പര്‍ " name="opposition_mobile[]" required />
                                            @error('opposition_mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(@$cases->opposition_address[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="വിലാസം " name="opposition_address[]" required />
                                            @error('opposition_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <input type="text" value="{{ htmlspecialchars(@$cases->opposition_salary[0] ?? '') }}" class="form-control case_registration--add--inputbox" placeholder="എതിര്‍കക്ഷിയുടെ ജോലി/പ്രതിമാസവരുമാനം(ഏകദേശം) " name="opposition_salary[]" />
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

                                    @if (!empty(@$cases->opposition_name))
                                        @foreach (@$cases->opposition_name as $index => $item)
                                            <div class="row addRow">
                                                <div class="col-md-2">
                                                    <input type="text" value="{{ @$cases->opposition_name[$index] }}" class="form-control case_registration--add--inputbox" placeholder="എതിർകക്ഷികളുടെ പേര്" name="opposition_name[]" required />
                                                    @error('opposition_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-1">
                                                    <input type="text" value="{{ @$cases->opposition_age[$index] }}" class="form-control case_registration--add--inputbox" placeholder="വയസ്സ്" name="opposition_age[]" />
                                                    @error('opposition_age')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" value="{{ @$cases->opposition_relationship[$index] }}" class="form-control case_registration--add--inputbox" placeholder="ബന്ധം" name="opposition_relationship[]" />
                                                    @error('opposition_relationship')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" value="{{ @$cases->opposition_mobile[$index] }}" class="form-control case_registration--add--inputbox" placeholder="മൊബൈല്‍ നമ്പര്‍" name="opposition_mobile[]" required />
                                                    @error('opposition_mobile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" value="{{ @$cases->opposition_address[$index] }}" class="form-control case_registration--add--inputbox" placeholder="വിലാസം" name="opposition_address[]" required />
                                                    @error('opposition_address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" value="{{ @$cases->opposition_salary[$index] }}" class="form-control case_registration--add--inputbox" placeholder="എതിര്‍കക്ഷിയുടെ ജോലി/പ്രതിമാസവരുമാനം(ഏകദേശം)" name="opposition_salary[]" />
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
                                            <textarea type="text" value="{{ @$cases->case_details }}" class="form-control" name="case_details" placeholder="എതിര്‍കക്ഷിയില്‍ നിന്നും ഉണ്ടായ അക്രമം : / അപേക്ഷയ്ക്ക് ആധാരമായ കാരണങ്ങള്‍" required>{{ @$cases->case_details }}</textarea>
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
                                            <textarea type="text" value="{{ @$cases->opposition_alimony }}" class="form-control" name="opposition_alimony" placeholder="പ്രതിമാസം ജീവനാംശം ലഭിക്കൽ">{{ @$cases->opposition_alimony }}</textarea>
                                        @error('opposition_alimony')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">b)സ്വത്ത് തിരികെ ലഭിക്കൽ
                                            <br> <span class="small">
                                                b) Recovery of property </span> </label>
                                            <textarea type="text" value="{{ @$cases->opposition_property }}" class="form-control" name="opposition_property" placeholder="സ്വത്ത് തിരികെ ലഭിക്കൽ">{{ @$cases->opposition_property }}</textarea>
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
                                            <textarea type="text" value="{{ @$cases->opposition_reason }}" class="form-control" name="opposition_reason" placeholder="സംരക്ഷണം ഉറപ്പു വരുത്തൽ(ഭക്ഷണം, വസ്ത്രം,താമസം )">{{ @$cases->opposition_reason }}</textarea>
                                        @error('opposition_reason')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">d)മരുന്ന് / ചികിത്സ / വൈദ്യശുശ്രൂഷ ഉറപ്പാക്കുന്നതിന്
                                            <br> <span class="small">
                                                d) To secure medicine / treatment / medical care </span> </label>
                                            <textarea type="text" value="{{ @$cases->opposition_medical }}" class="form-control" name="opposition_medical" placeholder="മരുന്ന് / ചികിത്സ / വൈദ്യശുശ്രൂഷ ഉറപ്പാക്കുന്നതിന്">{{ @$cases->opposition_medical }}</textarea>
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
                                            <textarea type="text" value="{{ @$cases->opposition_oppertunity }}" class="form-control" name="opposition_oppertunity" placeholder="മക്കളെ കാണുന്നതിനുള്ള അവസരം ഒരുക്കൽ">{{ @$cases->opposition_oppertunity }}</textarea>
                                        @error('opposition_oppertunity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">f) എതിർകക്ഷിയെ വീട്ടിൽ നിന്നും
                                            ഒഴിവാക്കൽ
                                            <br> <span class="small">f) Avoid opposite parties from home </span> </label>
                                            <textarea type="text" value="{{ @$cases->opposition_avoid }}" class="form-control" name="opposition_avoid" placeholder="എതിർകക്ഷിയെ വീട്ടിൽ നിന്നും ഒഴിവാക്കൽ">{{ @$cases->opposition_avoid }}</textarea>
                                        @error('opposition_avoid')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">g)പോലീസ് സഹായം / സംരക്ഷണം
                                            <br> <span class="small">g) Police Assistance / Protection </span> </label>
                                            <textarea type="text" value="{{ @$cases->opposition_police }}" class="form-control" name="opposition_police" placeholder="പോലീസ് സഹായം / സംരക്ഷണം">{{ @$cases->opposition_police }}</textarea>
                                        @error('opposition_police')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">h)മറ്റുള്ളവ, വിശദീകരിക്കുക :
                                            <br> <span class="small">h)Others, please explain : </span> </label>
                                            <textarea type="text" value="{{ @$cases->opposition_others }}" class="form-control" name="opposition_others" placeholder="മറ്റുള്ളവ, വിശദീകരിക്കുക">{{ @$cases->opposition_others }}</textarea>
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
                                            <input class="form-control  w-auto float-left" type="radio" name="opposition_complaint" value="Yes" {{ @$cases->opposition_complaint === 'Yes' ? 'checked' : '' }}>&nbsp; Yes/ഉണ്ട്</label>
                                            <label class="form-label  w-25 float-left">
                                            <input class="form-control  w-auto float-left" type="radio" name="opposition_complaint" value="No" {{ @$cases->opposition_complaint === 'No' ? 'checked' : '' }}> &nbsp; No/ഇല്ല</label>
                                    </div>
                                </div><br>


                                <div id="additionalDiv" style="display:none;">

                                    <div class="row">
                                        <div class="col-md-12">
                                                <label class="form-label"> ഉണ്ടെങ്കില്‍ വിശദീകരിക്കുക <br><span class="small"> If yes please explain </span></label>
                                                <textarea type="text" value="{{ @$cases->complaint_details }}" class="form-control" name="complaint_details" placeholder="ഉണ്ടെങ്കില്‍ വിശദീകരിക്കുക" >{{ @$cases->complaint_details }}</textarea>

                                        </div>

                                    </div><br>

                                </div><br>


                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            അപേക്ഷകൻ്റെ പേര്
                                            <br> <span class="small required">Name of Applicant </span> </label>
                                        <input type="text" value="{{ @$cases->applicant_name }}" class="form-control" name="applicant_name" id="applicant_name" placeholder="അപേക്ഷകൻ്റെ പേര്" required />
                                        @error('applicant_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">S/o, D/o, W/o
                                            <br> <span class="small required">S/o, D/o, W/o </span> </label>
                                        <input type="text" value="{{ @$cases->relative_name }}" class="form-control" name="relative_name" id="relative_name" placeholder="S/o, D/o, W/o" required />
                                        @error('relative_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            സ്ഥലം
                                            <br> <span class="small required">Place </span> </label>
                                        <input type="text" value="{{ @$cases->applicant_place }}" class="form-control" name="applicant_place" id="applicant_place" placeholder="സ്ഥലം" required />
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
                                            <input type="file" class="form-control"  name="applicant_sign"  id="applicant_sign"  accept="image/*" />
                                            <span id="file-name">{{ @$cases->applicant_sign }}</span>
                                        @error('applicant_sign')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">തീയതി
                                            <br> <span class="small required">Date </span> </label>
                                        <input type="Date" value="{{ @$cases->date }}" class="form-control" name="date" id="date" placeholder="തീയതി" required />
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">
                                            അപ്പീൽ വാദി
                                            <br> <span class="small required">Appellant </span> </label>
                                        <input type="text" value="{{ @$cases->appellant }}" class="form-control" name="appellant" id="appellant" placeholder="അപ്പീൽ വാദി" required/>
                                        @error('appellant')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <h4><label class="form-label"><b>സത്യവാങ്മൂലം</b><br><span class="small">
                                            <b>Declaration
                                            </b></span> </label></h4>
                                            <textarea class="form-control" rows="4" id="declaration" readonly></textarea>

                                    </div>
                                </div>


                                {{-- end '''''''''''''''''''' --}}
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </div>
                        </form>

                    </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $("#districtid").change(function(){
        var district_id = $(this).val();

            $.ajax({
            url  : "{{ route('get-police-station') }}",
            type :'POST',
            data: {
            "_token": "{{ csrf_token() }}",
            "district_id": district_id
            },

            success: function(response){
            console.log(response);
            if(response){
            $("#police_station").empty();
            $(function(){
            $.each(response, function (i, item) {
                $("#police_station").append("<option value='"+item._id+"'>" + item.name + "</option>");
            });
            });
            }

            }
            });
        });



    </script>
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

                if (fileSize > maxSize) {
                    errorMessage.innerText = 'Error: Image size exceeds 2MB limit';
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

{{-- <script>
    function updateFileName() {
        var input = document.getElementById('applicant_sign');
        var fileName = input.files[0] ? input.files[0].name : '';
        document.getElementById('file-name').textContent = fileName;
    }
</script> --}}


@endsection

