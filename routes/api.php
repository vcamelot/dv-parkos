<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ReservationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'destinations'], function () {
    Route::get('/', [DestinationController::class, 'index']);
    Route::get('{id}/reservations', [DestinationController::class, 'reservations']);
    Route::get('{id}', [DestinationController::class, 'show']);
});
Route::group(['prefix' => 'reservations'], function () {
    Route::get('/', [ReservationController::class, 'index']);
    Route::get('{id}', [ReservationController::class, 'show']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::patch('{id}/pay', [ReservationController::class, 'pay']);
    Route::patch('{id}', [ReservationController::class, 'update']);
    Route::delete('{id}', [ReservationController::class, 'destroy']);
});
