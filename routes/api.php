<?php

use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::post('/test', [TesterController::class, 'runTest'])->name('test');
Route::get('/results/{fileName}', [TesterController::class, 'getResults'])->name('results');

Route::get('/logs', function (){
   Log::info(shell_exec('cat /var/www/html/storage/logs/laravel.log'));
   Log::info('------------------------------------------------------');
   Log::info(shell_exec('cat /var/www/html/storage/logs/worker.log'));
});

Route::get('/{slug}', function () {
    return response('run "curl -X POST -F \'file=@your_file.c\' ' . \route('test') . ' " to test your app');
});
