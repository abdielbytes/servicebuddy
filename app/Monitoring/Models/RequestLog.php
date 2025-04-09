<?php

namespace App\Monitoring\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $fillable = [
        'method',
        'url',
        'headers',
        'body',
        'status',
    ];
}
