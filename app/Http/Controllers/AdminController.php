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
        //$this->middleware('auth');
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
        ]);
        District::create([
            'name'=> 'Kollam',
        ]);

        District::create([
            'name'=> 'Pathanamthitta',
        ]);
        District::create([
            'name'=> 'Alappuzha',
        ]);

        District::create([
            'name'=> 'Kottayam',
        ]);
        District::create([
            'name'=> 'Idukki',
        ]);
        District::create([
            'name'=> 'Ernakulam',
        ]);
        District::create([
            'name'=> 'Thrissur',
        ]);
        District::create([
            'name'=> 'Palakkad',
        ]);
        District::create([
            'name'=> 'Malappuram',
        ]);
        District::create([
            'name'=> 'Kozhikkodu',
        ]);
        District::create([
            'name'=> 'Wayanad',
        ]);
        District::create([
            'name'=> 'Kannur',
        ]);
        District::create([
            'name'=> 'Kasargodu',
        ]);
    }
}
