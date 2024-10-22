<?php

use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Route;

Route::post('/test', [TesterController::class, 'runTest']);
