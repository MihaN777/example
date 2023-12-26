<?php

use App\Http\Controllers\Api\V1\ApiRequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/requests', [ApiRequestController::class, 'requests'])->name('api.requests');
Route::post('/make-request', [ApiRequestController::class, 'makeRequest'])->name('api.make-request');
