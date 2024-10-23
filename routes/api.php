<?php

use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Route;

Route::post('/test', [TesterController::class, 'runTest'])->name('test');
Route::get('/results/{fileName}', [TesterController::class, 'getResults'])->name('results');

Route::get('/test', function () {
    return response('run "curl -X POST -F \'file=@your_file.c\' ' . \route('test') . ' " to test your app');
});
