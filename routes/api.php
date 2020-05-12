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

Route::post('commands/parse', 'CommandController@parse')
    ->name('commands.parse');



Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. Check the url or the api documentation for correct usage.'], 404);
});
