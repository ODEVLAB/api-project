<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;

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

ROute::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function() {
    Route::get('students', [ApiController::class, 'getAllStudents']);
    Route::get('students/{id}', [ApiController::class, 'getStudent']);
    Route::post('students', [ApiController::class, 'createStudent']);
    Route::post('student/{id}', [ApiController::class, 'updateStudent']);
    Route::delete('students/{id}',[ApiController::class, 'deleteStudent']);
    Route::get('students/search/{name}',[ApiController::class, 'search']);

});



//Login User
Route::post("login", [UserController::class, 'index']);
