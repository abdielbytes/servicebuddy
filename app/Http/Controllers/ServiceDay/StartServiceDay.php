<?php

namespace App\Http\Controllers\ServiceDay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ServiceDay;
use Illuminate\Support\Facades\Redirect;

class StartServiceDay extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ServiceDay::create([
            'user_id' => $user->id,
            'start' => $request->start,
        ]);

        return Redirect::back()->with('success', 'Service day started successfully!');
    }
}
