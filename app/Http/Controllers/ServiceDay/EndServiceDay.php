<?php

namespace App\Http\Controllers\ServiceDay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ServiceDay;
use Inertia\Inertia;

class EndServiceDay extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'end' => 'required|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        $service = ServiceDay::where('user_id', $user->id)->firstOrFail();
        $service->end = $request->input('end');

        $service->save();


        return Inertia::render('Dashboard', [
            'success' => true,
            'message' => 'Service day ended successfully!',
            'start_time' => $request->end,
        ]);    }
}
