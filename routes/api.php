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

Route::group(["namespace" => "App\Http\Controllers\Admin"], function () {
    Route::get("/subjects", "StudentController@listSubject");
    Route::get("/profile/{id}", "StudentController@profile");
    Route::put("/profile/{id}", "StudentController@profileUpdate");
    Route::get("/subjects/{id}", "SubjectController@studentSubject");
    Route::post("/profile/image/{id}", "StudentController@profileUpdateImage");
});
