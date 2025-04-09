<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use App\Monitoring\Models\QueryLog;
use Illuminate\Support\Facades\Schema;

class MonitoringServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // You can bind services or singletons here if needed later
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Only log if the table exists
        if (!Schema::hasTable('query_logs')) {
            return;
        }

        DB::listen(function ($query) {
            // Prevent logging queries to the logger itself
            if (str_contains($query->sql, 'query_logs')) {
                return;
            }

            // Extra safety: wrap in try-catch to prevent migration issues
            try {
                \App\Monitoring\Models\QueryLog::create([
                    'sql' => $query->sql,
                    'bindings' => json_encode($query->bindings),
                    'time' => $query->time,
                ]);
            } catch (\Throwable $e) {
                // Optionally log or ignore
            }
        });
    }
}
