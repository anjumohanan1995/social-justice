<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class AppealCaseDetails extends Eloquent
{
    use HasFactory , SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'appeal_case_details';

    // protected $guarded = []
    protected $guarded = ['_id', 'created_at', 'updated_at', 'deleted_at'];

    public function caseDetails() {
        return $this->belongsTo(CaseDetails::class, 'case_details_id');
    }
}
