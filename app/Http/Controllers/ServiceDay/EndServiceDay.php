<?php

namespace App\Http\Controllers\ServiceDay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EndServiceDay extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'end' => 'required|date',
            ]);

        dd('end');
    }
}
