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
    Route::resource('provider', 'ProviderController');
});

Route::namespace('Image')->prefix('image')->group(function () {
    Route::resource('upload', 'UploadController')->only(['store']);
});

Route::namespace('Video')->prefix('video')->group(function () {
    Route::resource('upload', 'UploadController');
});


Route::namespace('Media')->group(function () {
    Route::resource('media', 'MediaController');
});
