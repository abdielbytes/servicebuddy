<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Monitoring\Models\RequestLog;

class LogHttpRequests
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        RequestLog::create([
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'headers' => json_encode($request->headers->all()),
            'body' => json_encode($request->all()),
            'status' => $response->getStatusCode(),
        ]);

        return $response;
    }
}
