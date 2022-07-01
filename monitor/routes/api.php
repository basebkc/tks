<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\ChartsApiController;
use App\Http\Controllers\Api\V1\NasabahController;
use App\Http\Controllers\AuthController;


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

// Route::get('nasabah', [NasabahController::class, 'index'])->name('api.nasabah');

// Route::middleware(['auth:sanctum', 'verified'])->group(function () {

//     Route::get('nasabah', [NasabahController::class, 'index'])->name('api.nasabah');

// });

Route::group([

    'middleware'    => 'api',
    'prefix'        => 'auth'

], function($route){

    Route::post('/login',[AuthController::class, 'login'])->name('api.auth.login');
    Route::post('/register',[AuthController::class, 'register']);
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::post('/refresh',[AuthController::class, 'refresh']);
    Route::get('/me',[AuthController::class, 'userProfile']);
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('api.nasabah');

});

Route::get('/getnotif', [ChartsApiController::class, 'gettrans'])->name('api.nasabah');


Route::get('gettransaksi', [ChartsApiController::class, 'gettransaksi'])->name('api.gettransaksi');
// Route::post('/register',[AuthController::class, 'register']);
// Route::post('gettrans', [ChartsApiController::class, 'gettrans'])->name('api.gettrans');
// Route::get('chart', [ChartsApiController::class, 'index'])->name('api.chart');

