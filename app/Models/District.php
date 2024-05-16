<?php
namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Eloquent
{

    protected $connection = 'mongodb';

    protected $collection = 'districts';


    protected $fillable = [
        'name',
        'district'

    ];




}
