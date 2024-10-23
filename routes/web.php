<?php

use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Route;

Route::post('/test', [TesterController::class, 'runTest'])->name('test');
Route::get('/results/{fileName}', [TesterController::class, 'getResults'])->name('results');

Route::view('/submitted', 'submitted');

Route::get('/', function () {
    return view('home');
})->name('home');;

Route::fallback(function () {
    return view('home');
});
