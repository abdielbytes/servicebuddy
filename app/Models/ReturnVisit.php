<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnVisit extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'discussed',
        'to_discuss',
        'location',
        'territory',
    ];
}
