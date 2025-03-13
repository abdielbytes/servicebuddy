<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceDay extends Model
{
    protected $fillable = [
        'user_id',
        'start',
        'end'
    ];
}
