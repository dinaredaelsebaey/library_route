<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiBookController;


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

Route::get('/books',[ApiBookController::class,'index']);
Route::get('/books/show/{id}', [ApiBookController::class, 'show']);
Route::post('/books/store', [ApiBookController::class, 'store']);
Route::post('/books/update/{id}', [ApiBookController::class, 'update']);
Route::get('/books/delete/{id}', [ApiBookController::class, 'delete']);