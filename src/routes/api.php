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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Provider')->group(function () {
    Route::apiResource('provider', 'ProviderController')->only(['index']);
});

Route::namespace('Image')->prefix('image')->group(function () {
    Route::apiResource('upload', 'UploadController')->only(['store']);
});

Route::namespace('Video')->prefix('video')->group(function () {
    Route::apiResource('upload', 'VideoUploadController')->only(['store']);
});


Route::namespace('Media')->group(function () {
    Route::apiResource('media', 'MediaController')->only(['index']);
});
