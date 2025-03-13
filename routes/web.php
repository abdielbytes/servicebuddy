<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ServiceDay\StartServiceDay;
use App\Http\Controllers\ServiceDay\EndServiceDay;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('start-service-day', StartServiceDay::class)->middleware(['auth', 'verified'])->name('start-service-day');
Route::post('end-service-day', EndServiceDay::class)->middleware(['auth', 'verified'])->name('end-service-day');
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
