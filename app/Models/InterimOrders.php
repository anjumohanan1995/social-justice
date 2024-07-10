<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class InterimOrders extends Eloquent
{
    use HasFactory,SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'interim_orders';
    protected $fillable = [
        'order_type',
        'order_file',
        'case_no',
        'casedetails_id',
    ];
}
