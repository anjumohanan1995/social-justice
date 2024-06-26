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

    // protected $guarded = []
    protected $guarded = ['_id', 'created_at', 'updated_at', 'deleted_at'];
    // protected $fillable = [
    //     'opposition_name',
    //     'district_id','police_station_id','opposition_address','pincode','opp_phone','case_details','case_id','status','user_id',
    //     'Rdo_status',
    //     'Rdo_status_date',
    //     'Rdo_status_id',
    //     'Rdo_status_reason'

    // ];

    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function policestation() {
        return $this->belongsTo(policestation::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function appealCaseDetails() {
        return $this->hasMany(AppealCaseDetails::class, 'case_details_id');
    }

}
