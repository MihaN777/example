<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

// Админка
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function () {
	Route::get('/', [AdminController::class, 'home'])->name('admin.home');
	Route::get('/requests', [AdminRequestController::class, 'requests'])->name('admin.requests');
	Route::get('/requests/{request}/edit', [AdminRequestController::class, 'requestEdit'])->name('admin.request.edit');
	Route::patch('/requests/{request}', [AdminRequestController::class, 'requestUpdate'])->name('admin.request.update');
});

Auth::routes([
	'login'    => true,
	'logout'   => true,
	'register' => true,
	'reset'    => false, // for resetting passwords
	'verify' => false, // for additional password confirmations
	'confirm'  => false, // for email verification
]);
