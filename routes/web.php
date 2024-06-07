<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\URLController;

Route::domain(env('APP_URL'))->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::domain('{domain}')->group(function() {
    Route::get('/{url?}', [URLController::class, 'LoadPage'])->name('route');
});