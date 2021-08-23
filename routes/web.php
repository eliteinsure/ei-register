<?php

use App\Http\Controllers\AdviserController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteManualController;
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

    Route::resource('claims', ClaimController::class)->only([
        'index',
    ]);

    Route::resource('software', SiteController::class)->only([
        'index',
    ])->names([
        'index' => 'sites.index',
    ]);

    Route::resource('software.manuals', SiteManualController::class)->only([
        'show',
    ])->parameters([
        'software' => 'site',
    ])->names([
        'show' => 'sites.manuals.show',
    ]);

    Route::resource('advisers', AdviserController::class)->only([
        'index',
    ]);

    Route::group(['as' => 'reports.', 'prefix' => 'reports'], function () {
        Route::group(['as' => 'complaints.', 'prefix' => 'complaints'], function () {
            Route::get('/', [ComplaintController::class, 'report'])->name('index');
            Route::get('/{complaint}', [ComplaintController::class, 'pdf'])->name('pdf');
        });

        Route::group(['as' => 'sites.', 'prefix' => 'software'], function () {
            Route::get('/', [SiteController::class, 'report'])->name('index');
        });
    });

    Route::resource('users', UserController::class)->only([
        'index',
    ])->middleware('role:admin');
});
