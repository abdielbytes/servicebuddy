<?php

namespace App\Monitoring\Models;

use Illuminate\Database\Eloquent\Model;

class QueryLog extends Model
{
    protected $fillable = [
        'sql',
        'bindings',
        'time',
    ];
}
