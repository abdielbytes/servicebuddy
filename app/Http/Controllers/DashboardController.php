<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ServiceDay;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::today();

        $service_day = ServiceDay::where('user_id', $user->id)
            ->whereDate('start', $today)
            ->whereNull('end')
            ->latest('start')
            ->first();

        if ($service_day) {

//            dd($service_day);
            return Inertia::render('Dashboard', [
                'status' => true,
                'message' => 'Last Service Day was not ended.',
                'start' => $service_day->start,
            ]);
        }

        return Inertia::render('Dashboard', ['status' => false]);
    }
}
