<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class CaseDetails extends Eloquent
{
    use HasFactory , SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'case_details';

    protected $guarded = [];
    protected $fillable = [
        'opposition_name',
        'district_id','opposition_address','pincode','opp_phone','case_details','case_id','status','user_id'
    
    ];
}