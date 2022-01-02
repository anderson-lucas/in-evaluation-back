<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactTypeController;
use App\Http\Controllers\PersonController;
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

Route::prefix('contact-type')->group(function () {
    Route::get('/', [ContactTypeController::class, 'index']);
});

Route::prefix('person')->group(function () {
    Route::get('/', [PersonController::class, 'index']);
    Route::get('/{id}', [PersonController::class, 'show']);
    Route::post('/create', [PersonController::class, 'create']);
    Route::put('/{id}', [PersonController::class, 'update']);
    Route::delete('/{id}', [PersonController::class, 'destroy']);
});

Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::get('/{id}', [ContactController::class, 'show']);
    Route::post('/create', [ContactController::class, 'create']);
    Route::put('/{id}', [ContactController::class, 'update']);
    Route::delete('/{id}', [ContactController::class, 'destroy']);
});
