@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Appeal Form</h4>
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
                        <li class="breadcrumb-item active"> Appeal Form </li>
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
                         <form class="row g-3 needs-validation custom-input" action="{{ route('appeal.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
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
                                        <label class="form-label">സ്ഥിരമായ വിലാസം<br><span class="small"> Address</span></label>
                                        <p>{{ @$cases->address }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">വാര്‍ഡ്‌ നമ്പര്‍<br><span class="small">Ward no</span></label>
                                        <p>{{ @$cases->ward_no }}</p>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">പിൻകോഡ്<br><span class="small">Pincode</span></label>
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
                                    <div class="col-md-12 mb-12">
                                        <label class="form-label" style="color: green;"><b>ഉത്തരവ് പുറപ്പെടുവിപ്പിച്ച മെയിന്റനൻസ് ട്രൈബ്യുണലിന്റെ പേരും പ്രസ്തുത ഉത്തരവിന്റെ നമ്പറും തീയതിയും</b> <br><span class="small required">
                                           <b> Name of the maintenance tribunal, number and date of the said order</b></span> </label>
                                        <textarea type="text" value="{{ old('maintenance_tribunal') }}" class="form-control" name="maintenance_tribunal" placeholder="ഉത്തരവ് പുറപ്പെടുവിപ്പിച്ച മെയിന്റനൻസ് ട്രൈബ്യുണലിന്റെ പേരും പ്രസ്തുത ഉത്തരവിന്റെ നമ്പറും തീയതിയും" required>{{ old('maintenance_tribunal') }}</textarea>
                                        @error('maintenance_tribunal')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label class="form-label" style="color: green;"><b>ഉത്തരവിനെ ചോദ്യം ചെയ്യുന്നതിനുള്ള കാരണങ്ങൾ</b> <br><span class="small required">
                                           <b>Grounds for challenging the order</b></span> </label>
                                        <textarea type="text" value="{{ old('order_challenging_reason') }}" class="form-control" name="order_challenging_reason" placeholder="ഉത്തരവിനെ ചോദ്യം ചെയ്യുന്നതിനുള്ള കാരണങ്ങൾ" required>{{ old('order_challenging_reason') }}</textarea>
                                        @error('order_challenging_reason')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <label class="form-label" style="color: green;"><b>സ്റ്റേ ഉത്തരവ് ആവശ്യപ്പെടുന്നുവെങ്കിൽ അതിനുള്ള കാരണങ്ങൾ</b> <br><span class="small required">
                                           <b>Reasons for requesting a stay order</b></span> </label>
                                        <textarea type="text" value="{{ old('order_stay_reason') }}" class="form-control" name="order_stay_reason" placeholder="സ്റ്റേ ഉത്തരവ് ആവശ്യപ്പെടുന്നുവെങ്കിൽ അതിനുള്ള കാരണങ്ങൾ" required>{{ old('order_stay_reason') }}</textarea>
                                        @error('order_stay_reason')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

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
                                        <label class="form-label">District<br><span class="small">ജില്ല</span></label>
                                        <p>
                                            @foreach($districts as $district)
                                                @if($district->_id == $cases->district_id)
                                                    {{ $district->name }}
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label">Police Station<br><span class="small">പോലീസ് സ്റ്റേഷൻ</span></label>
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
                                            <label>എതിർകക്ഷികളുടെ പേര്<br><span class="small">Opposition Name</span></label>
                                        </div>
                                        <div class="col-md-1">
                                            <label>വയസ്സ്<br><span class="small">Age</span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>ബന്ധം<br><span class="small">Relationship</span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>മൊബൈല്‍ നമ്പര്‍<br><span class="small">Mobile Number</span></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>വിലാസം<br><span class="small">Address</span></label>
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
                                        <label class="form-label" style="color: green;"><b>ആഗ്രഹിക്കപ്പെടുന്ന പരിഹാരം</b> <br><span class="small required">
                                           <b>Desired solution</b></span> </label>
                                        <textarea type="text" value="{{ old('desired_solution') }}" class="form-control" name="desired_solution" placeholder="ആഗ്രഹിക്കപ്പെടുന്ന പരിഹാരം" required>{{ old('desired_solution') }}</textarea>
                                        @error('desired_solution')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                    </div><br><br><br>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" style="color: green;">
                                            അപ്പീൽ വാദി
                                            <br> <span class="small required">Appellant </span> </label>
                                        <input type="text" value="{{ old('appeal_appellant') }}" class="form-control" name="appeal_appellant" id="appeal_appellant" placeholder="അപ്പീൽ വാദി" required/>
                                        @error('appeal_appellant')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" style="color: green;">
                                            സ്ഥലം
                                            <br> <span class="small required">Place </span> </label>
                                        <input type="text" value="{{ old('appeal_applicant_place') }}" class="form-control" name="appeal_applicant_place" id="appeal_applicant_place" placeholder="സ്ഥലം" required />
                                        @error('appeal_applicant_place')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" style="color: green;">
                                            ഒപ്പ്
                                            <br> <span class="small required">Signature </span> </label>

                                            <input type="file" class="form-control" name="appeal_applicant_sign" id="appeal_applicant_sign" accept="image/jpeg,image/png,image/jpg" required />
                                            @error('appeal_applicant_sign')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" style="color: green;">തീയതി
                                            <br> <span class="small required">Date </span> </label>
                                        <input type="Date" value="{{ old('appeal_date') }}" class="form-control" name="appeal_date" id="appeal_date" placeholder="തീയതി" required />
                                        @error('appeal_date')
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
                                <input type="hidden" name="case_details_id" value="{{ $cases->id }}">

                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </div>
                        </form>
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
        document.addEventListener('DOMContentLoaded', (event) => {
            const appellantInput = document.getElementById('appeal_appellant');
            const placeNameInput = document.getElementById('appeal_applicant_place');
            const signatureInput = document.getElementById('appeal_applicant_sign');
            const dateInput = document.getElementById('appeal_date');
            const declarationTextarea = document.getElementById('declaration');

            function updateDeclaration() {
                const appellant = appellantInput.value;
                const place = placeNameInput.value;
                const signature = signatureInput.value;
                const date = dateInput.value;
                declarationTextarea.value = `മുകളിൽ പറഞ്ഞട്ടുള്ള വസ്തു വകകൾ ഉത്തമമായ എന്റെ അറിവിലും വിശ്വാസത്തലും പെട്ടിടത്തോളം സത്യവും സത്യവും ശരിയുമാണെന്നും അപ്പീൽ വാദിയായ ${appellant}, എന്ന ഞാൻ ഇതിനാൽ പ്രസ്താവിക്കുന്നു. മെയിന്റനൻസ് ട്രൈബ്യുണലിന്റെ ഉത്തരവിന്റെ ഒരു പകർപ്പ് തോടൊപ്പം ചേർത്തരിക്കുന്നു.
    സ്ഥലം : ${place}                                                                      ഒപ്പ് : ${signature}
    തീയതി : ${date}                                                                       അപ്പീൽ വാദി : ${appellant}`;
            }

            appellantInput.addEventListener('input', updateDeclaration);
            placeNameInput.addEventListener('input', updateDeclaration);
            signatureInput.addEventListener('input', updateDeclaration);
            dateInput.addEventListener('input', updateDeclaration);


            // Initial update in case there are old values
            updateDeclaration();
        });
    </script>

@endsection
