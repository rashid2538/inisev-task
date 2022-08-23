<?php

use App\Http\Controllers\ApiController;
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

Route::controller(ApiController::class)->group(function() {

    // Route to create new post in a website
    Route::post('/{website}/create-post/', 'createPost');

    // Route to subscribe a website
    Route::post('/{website}/subscribe/{user}/', 'subscribe');

    // Route to unsubscribe a website
    Route::post('/{website}/unsubscribe/{user}/', 'unsubscribe');
});
