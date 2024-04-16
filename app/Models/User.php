<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait;
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'users';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'application_number','name', 'email', 'password','mobile','role','aadhar_number','dob','gender','father_name','mother_name','caste','id_proof','id_proof_details','district','teo_name', 'bank_name','account_no','passbook','ifsc_code','po_tdo_office'
    ];

     protected $hidden = [
        'password', 'remember_token',
    ];

     protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
