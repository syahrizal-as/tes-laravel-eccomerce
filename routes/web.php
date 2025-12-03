<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MasterData\ImageController;
use App\Http\Controllers\MasterData\ProductController;
use App\Http\Controllers\Transaction\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.web.home');
})->middleware('guest');
Route::middleware('auth')->name('admin.')->prefix('dashboard')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('role', RoleController::class, ['except' => ['show']]);
    Route::resource('user', UserController::class, ['except' => ['show']]);
    Route::resource('permission', PermissionController::class, ['except' => ['show', 'create', 'edit', 'update', 'delete']]);

    Route::prefix('master-data')->group(function () {
        Route::resource('product', ProductController::class, ['except' => ['show']]);
        Route::resource('image', ImageController::class, ['except' => ['show']]);
    });

    Route::prefix('transaction')->group(function () {
        Route::resource('transaction', TransactionController::class, ['except' => ['show']]);
    });
});
