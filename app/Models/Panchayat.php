<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Panchayat extends Eloquent
{
    use HasFactory,SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'panchayat';
    protected $fillable = ['district_id','name'];

    public function district() {
        return $this->belongsTo(District::class);
    }
}
