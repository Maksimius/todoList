<?php

use App\Http\Controllers\api\DoingsController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('doings',[DoingsController::class, 'index']);
Route::put('doings',[DoingsController::class, 'store']);
Route::post('doings/moveToUrgent/{id}',[DoingsController::class, 'moveToUrgent']);
Route::post('doings/moveToRegular/{id}',[DoingsController::class, 'moveToRegular']);
Route::post('doings/markDone/{id}',[DoingsController::class, 'markDone']);
Route::post('doings/unmarkDone/{id}',[DoingsController::class, 'unmarkDone']);
Route::delete('doings/{id}',[DoingsController::class, 'delete']);