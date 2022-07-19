<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\AccountsController;
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


Route::post('/register', [AccountsController::class, 'register']);
Route::post('/login', [AccountsController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    /**
     * Use all controller default actions
     */
    Route::resource('/projects', ProjectsController::class);
    Route::post('/logout', [AccountsController::class, 'logout']);
    
});




/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



 */