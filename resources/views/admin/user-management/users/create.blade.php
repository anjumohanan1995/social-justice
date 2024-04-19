@extends('layouts.adminapp')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Add User</h4>
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
                        <li class="breadcrumb-item">User Management</li>
                        <li class="breadcrumb-item active"> Add User</li>
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
                        <form class="row g-3 needs-validation custom-input" action="{{ route('users.store') }}" method="POST">
                                    @csrf
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">First name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip02">Last name</label>
                                <input type="text"  name="last_name" class="form-control" placeholder="Enter your last name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipUsername">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" />
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                               
                                </div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipUsername">Password</label>
                                <div class="input-group has-validation">
                                   <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}"/>
                                                @error('password')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                               
                                </div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipUsername">Role</label>
                                <div class="input-group has-validation">
                                   <select id="role" name="role" class="form-control"  >
                                        <option value="" selected>Select Role</option>
                                            @foreach($role as $roles)
                                                <option value="{{$roles->name}}" @if (old('role') == $roles['name']) selected @endif>{{$roles->name}}</option>
                                            @endforeach
                                    </select>

                                    @error('role')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                               
                                </div>
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