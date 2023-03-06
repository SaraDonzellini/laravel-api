<?php

use App\Http\Controllers\api\ProjectController;
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

Route::get('/projects', [ProjectController::class, 'index'])->name('api.projects.index');
Route::middleware('auth:api')->get('/projects/{project}', [ProjectController::class, 'show'])->name('api.projects.show');
// Route::resource('/projects', ProjectController::class);