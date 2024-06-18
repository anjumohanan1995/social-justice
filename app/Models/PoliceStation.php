<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoliceStation extends Eloquent
{
    use HasFactory,SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'policestations';

    protected $fillable = ['district_id','name'];


    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', '_id');
    }

}
