<?php

use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Route;

Route::post('/test', [TesterController::class, 'runTest'])->name('test');
Route::get('/results/{fileName}', [TesterController::class, 'getResults'])->name('results');

Route::fallback(function () {
    return response('run "curl -X POST -F \'file=@your_file.c\' ' . \route('test') . '?functions=v1,h " to test your app.
    After submitting the program, an URL will be returned for the results.
    The submitted program must end at "k" input, otherwise the result will not contain relevant data.
    You can test multiple separate functions by specifying query parameter ?functions in request URL.
    Supported functions are ' . implode(',', config('app.supported_functions')));
});
