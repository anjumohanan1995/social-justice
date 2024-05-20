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
        'application_number','name', 'email', 'password','phone','role','pincode','address','district_id',
    ];

     protected $hidden = [
        'password', 'remember_token',
    ];

     protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }

}
