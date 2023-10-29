<?php

use App\Http\Controllers\TodoApiController;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */



// 1. composer require laravel/sanctum  
// 2. php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"


Route::get('token', [TodoApiController::class, 'getToken']); // -> http://localhost/api/token
Route::get("/", [TodoApiController::class, 'index']); // -> http://localhost/api/
Route::get("completed", [TodoApiController::class, 'finished']); // -> http://localhost/api/completed


Route::middleware('auth:sanctum')->name("api.")->group(function () {

    Route::resource('todos', TodoApiController::class)->except(['show', 'create', 'edit']);
});
