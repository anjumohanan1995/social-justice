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
                        <form class="row g-3 needs-validation custom-input" action="{{ route('cases.update',$cases->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Opposition Name</label>
                                <input type="text" value="{{ $cases->opposition_name }}" id="name" name="opposition_name" class="form-control" placeholder="Enter your name" value="{{ old('opposition_name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip02">Opposition Address</label>
                                <textarea class="form-control" placeholder="Opposition Address" name="opposition_address">{{ $cases->opposition_address  }}</textarea>
                                @error('opposition_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltipUsername">District</label>
                                <div class="input-group has-validation">
                                    <select name="district_id" id="districtid"  class="form-control" >
                                        <option value="" >District</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->_id }}" {{ $district->_id == $cases->district_id ? 'selected' : '' }} >{{ $district->name }}</option>
                                            @endforeach
                                            @error('district_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltipUsername">Police Station</label>
                                <div class="input-group has-validation">
                                    <select name="police_station" id="police_station"  class="form-control">
                                        <option value="" >Police Station</option>

                                            @error('police_station')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltipUsername">Pincode</label>
                                <div class="input-group has-validation">
                                   <input type="number" value="{{ $cases->pincode  }}" class="form-control" placeholder="Pincode" name="pincode" value="{{old('pincode')}}"/>
                                    @error('pincode')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipUsername">Opposition Phone</label>
                                <div class="input-group has-validation">
                                   <input type="text" value=" {{ $cases->opp_phone  }}" class="form-control" placeholder="Opposition Phone" name="opp_phone"/>
                                    @error('opp_phone')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                            </div>

                             <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipUsername">Case Details</label>
                                <div class="input-group has-validation">
                                  <textarea class="form-control" placeholder="Case Details" name="case_details" rows="5">{{ $cases->case_details  }}</textarea>
                                    @error('case_details')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                            </div>





                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$("#districtid").change(function(){
    var district_id = $(this).val();
        console.log(district_id);
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

    $(document).ready(function(){
        var district_id = $('#districtid').val();
       
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

@endsection

