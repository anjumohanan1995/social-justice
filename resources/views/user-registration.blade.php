@extends('layouts.home-app')

@section('content')
<div  class="bg_blue">
   <div class="card">
      <div class="card-body">
         <div class="mb-4 main-content-label"> Instructions</div>
         <p>Already a user? Please <a href="{{url('/login')}}">login</a></p>
      </div>
   </div>
   <section class="container-center">
      <header>Registration Form</header>

        <form name="userForm" id="userForm" method="post" action="{{route('userStore')}}" class="form">
									@csrf
         <div class="input-box">
            <label>Full Name</label>
            <input type="text" placeholder="Enter full name" name="name" required  value="{{ old('name') }}"/>
            @error('name')
               <div class="text-danger">{{ $message }}</div>
            @enderror
         </div>
         <div class="input-box">
            <label>Email</label>
            <input type="email" placeholder="Enter email address" name="email"  required   value="{{ old('email') }}"/>
            @error('email')
               <div class="text-danger">{{ $message }}</div>
            @enderror
         </div>
         <div class="column">
            <div class="input-box">
               <label>Phone Number</label>
               <input type="number" placeholder="Enter phone number" name="phone" required  value="{{ old('phone') }}" />
                @error('phone')
               <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="input-box">
               <label>Pincode</label>
               <input type="text" placeholder="Enter Pincode" name="pincode"  required  value="{{ old('pincode') }}" />
                @error('pincode')
               <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
         </div>
         <div class="input-box address">
            <label>Address</label>
            <input type="text" placeholder="Enter street address" name="address" required  value="{{ old('address') }}"/>
             @error('address')
               <div class="text-danger">{{ $message }}</div>
            @enderror
         </div>
         <div class="column">
            
            <div class="select-box">
               <select name="district_id">
                  <option >District</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->_id }}">{{ $district->name }}</option>
                    @endforeach
                  {{-- <option>Thiruvananthapuram</option>
                  <option>Kollam</option>
                  <option>Alappuzha</option>
                  <option>Pathanamthitta</option>
                  <option>Kottayam</option>
                  <option> Idukki</option>
                  <option>Ernakulam</option>
                  <option>Thrissur</option>
                  <option>Palakkad</option>
                  <option>Malappuram</option>
                  <option>Kozhikode</option>
                  <option>Alappuzha</option>
                  <option>Wayanad</option>
                  <option>Kannur</option>
                  <option>Kasaragod</option> --}}
                   @error('district_id')
               <div class="text-danger">{{ $message }}</div>
            @enderror
               </select>
            </div>
            <!-- <input type="text" placeholder="Enter your city" required /> -->
         </div>
         <div class="column">
            <div class="input-box">
               <label>Password</label>
               <input type="password" placeholder="Enter your password" required name="password"  value="{{ old('password') }}"/>
                @error('password')
               <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="input-box">
               <label>Confirm Password</label>
               <input type="password" placeholder="Confirm your password" required name="confirm_password"  value="{{ old('confirm_password') }}"/>
                @error('confirm_password')
               <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
         </div>
         <button type="submit">Register</button>
      </form>
   </section>
</div>     
@endsection