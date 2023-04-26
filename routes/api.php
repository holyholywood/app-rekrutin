<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\v1\ApplicationController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\JobController;
use App\Http\Controllers\v1\MessageController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*a
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 ** V1 Api routes
 */

Route::prefix('v1')->group(function () {
    /**
     ** Authentication Routes
     */
    Route::controller(AuthController::class)->name('Auth')->prefix('auth')->group(function () {
        Route::post('/login', 'login')->name('Login');
        Route::post('/logout', 'logout')->name('Logout');
        Route::post('/register', 'register')->name('Register');
    });


    /**
     ** User Routes
     */

    Route::controller(UserController::class)->name('User')->prefix('users')->group(function () {
        Route::get('/', 'index')->name('Index');
        Route::get('/me', 'showUser')->name('showUser');
        Route::get('/{id}', 'show')->name('Show');
        // Route::post('/', 'store')->name('Store');
        // Route::patch('/{id}', 'update')->name('Update');
        // Route::delete('/{id}', 'destroy')->name('Destroy');
    });


    /**
     ** Job Routes
     */

    Route::controller(JobController::class)->name('Job')->prefix('jobs')->group(function () {
        Route::get('/', 'index')->name('Index');
        Route::get('/{id}', 'show')->name('Show');
        Route::post('/', 'store')->name('Store');
        Route::patch('/{id}', 'update')->name('Update');
        Route::delete('/{id}', 'destroy')->name('Destroy');
    });


    /**
     ** Application Routes
     */

    Route::controller(ApplicationController::class)->name('Application')->prefix('applications')->group(function () {
        Route::get('/', 'index')->name('Index');
        Route::get('/{id}', 'show')->name('Show');
        Route::get('/{id}/status', 'showStatus')->name('ShowStatus');
        Route::post('/', 'store')->name('Store');
        Route::post('/{id}/status', 'updateStatus')->name('Update');
        Route::delete('/{id}', 'destroy')->name('Destroy');
    });


    /**
     ** Message Routes
     */

    Route::controller(MessageController::class)->name('Message')->prefix('messages')->group(function () {
        Route::get('/{target_id}', 'index')->name('Index');
        // Route::get('/{target_id}', 'show')->name('Show');
        Route::post('/', 'store')->name('Store');
        Route::patch('/{id}', 'update')->name('Update');
        Route::delete('/{id}', 'destroy')->name('Destroy');
    });


    /**
     ** File Routes
     */

    Route::controller(FileController::class)->name('File')->prefix('file')->group(function () {
        Route::post('/upload', 'store')->name('Store');
    });
});
