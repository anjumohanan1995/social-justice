<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // dd("sajhg");
        if(Auth::user()->role =='User'){
            return view('user.dashboard');
        }

        return view('admin.index');
    }

    public function district()
    {
        District::create([
            'name'=> 'Thiruvananthapuram',
            'district_id' =>  1,
           

        ]);
        District::create([
            'name'=> 'Kollam',
            'district_id' =>  2,
           

        ]);

        District::create([
            'name'=> 'Pathanamthitta',
            'district_id' =>  3,
           

        ]);
        District::create([
            'name'=> 'Alappuzha',
            'district_id' =>  4,
           

        ]);

        District::create([
            'name'=> 'Kottayam',
            'district_id' =>  5,
           
        ]);
        District::create([
            'name'=> 'Idukki',
            'district_id' =>  6,
            

        ]);
        District::create([
            'name'=> 'Ernakulam',
            'district_id' =>  7,
           

        ]);
        District::create([
            'name'=> 'Thrissur',
            'district_id' =>  8,
          
        ]);
        District::create([
            'name'=> 'Palakkad',
            'district_id' =>  9,
           

        ]);
        District::create([
            'name'=> 'Malappuram',
            'district_id' =>  10,
          
        ]);
        District::create([
            'name'=> 'Kozhikkodu',
            'district_id' =>  11,
           
        ]);
        District::create([
            'name'=> 'Wayanad',
            'district_id' =>  12,
          
        ]);
        District::create([
            'name'=> 'Kannur',
            'district_id' =>  13,
        
        ]);
        District::create([
            'name'=> 'Kasargodu',
            'district_id' =>  14,
            

        ]);
    }
}
