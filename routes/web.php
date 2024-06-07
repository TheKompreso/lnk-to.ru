<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\URLController;

Route::domain(env('APP_URL'))->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/artist/{id}', [URLController::class, 'LoadArtist']);
    Route::get('/track/{id}', [URLController::class, 'LoadTrack']);
    Route::get('/link/{id}', [URLController::class, 'LoadLink']);
});

Route::domain('{domain}')->group(function() {
    Route::get('/{url?}', [URLController::class, 'LoadPage'])->name('route');
});
