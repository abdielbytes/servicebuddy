<?php

namespace App\Http\Controllers\ServiceDay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ServiceDay;
use Carbon\Carbon;

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

        // Get the latest active service day
        $service = ServiceDay::where('user_id', $user->id)
            ->whereNull('end')
            ->latest('start')
            ->firstOrFail();


        $service->end = Carbon::parse($request->input('end'));

        $service->hours = round(Carbon::parse($service->start)->diffInMinutes($service->end) / 60, 2);

        $service->save();



        return redirect()->back()->with('success', 'Service day ended successfully!');
    }
}
