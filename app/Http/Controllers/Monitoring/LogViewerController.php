<?php

namespace App\Http\Controllers\Monitoring;

use App\Http\Controllers\Controller;
use App\Monitoring\Models\RequestLog;
use App\Monitoring\Models\QueryLog;

class LogViewerController extends Controller
{
    public function index()
    {
        // Fetch request logs (pagination applied)
        $requestLogs = RequestLog::latest()->paginate(20);

        // Fetch query logs (pagination applied)
        $queryLogs = QueryLog::latest()->paginate(20);

        return view('monitor.index', compact('requestLogs', 'queryLogs'));
    }
}

