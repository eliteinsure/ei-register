<?php

use App\Http\Controllers\AdviserController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::redirect('/', 'dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('complaints', ComplaintController::class)->only([
        'index',
    ]);

    Route::resource('advisers', AdviserController::class)->only([
        'index',
    ]);

    Route::resource('users', UserController::class)->only([
        'index',
    ])->middleware('role:admin');

    Route::group(['as' => 'pdf.', 'prefix' => 'pdf', 'url' => 'pdf'], function () {
        Route::get('complaint', [PdfController::class, 'complaint'])->name('complaint');
    });
});
