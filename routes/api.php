<?php

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

Route::get('/get-items', [App\Http\Controllers\Api\ApiController::class, 'getItems'])->name('api.get.items');
Route::get('/get-int', [App\Http\Controllers\Api\ApiController::class, 'getInt'])->name('api.get.int');
Route::get('/get-int-out', [App\Http\Controllers\Api\ApiController::class, 'getIntOut'])->name('api.get.int.out');
Route::get('/get-member', [App\Http\Controllers\Api\ApiController::class, 'getMember'])->name('api.get.member');