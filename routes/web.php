<?php

use App\Http\Controllers\TodoApiController;
use App\Http\Controllers\TodoController;
use App\Http\Resources\TodoResource;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::resource('todos', TodoController::class)->except(['show']);

Route::get('/', function () {

    return redirect('todos');
});

/* Route::get("/user", function () {
    $u = App\Models\User::create([
        "name" => "toto",
        "email" => "caa@caa.ch",
        "password" => "test"
    ]);

    // create token 

    return $u;
}); */


// Route::get('/', [TodoController::class, 'index']);

/* Route::group([
    "prefix" => "/todos"
], function(){
    Route::get("/", [TodoController::class, 'index'])->name('index');

    Route::get('/{id}', [TodoController::class, 'show'])->name('show');

})->name('todos.'); */

/* Route::get("/todos", function(){
    return new TodoResource(Todo::all());
}); */
