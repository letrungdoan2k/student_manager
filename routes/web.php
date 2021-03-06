<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('language/{language}', [LangController::class, 'changeLanguage'])->name('language');

Route::prefix('admin')->middleware('isLogin')->group(function () {
    Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('faculties', 'FacultyController');
        Route::resource('students', 'StudentController');
        Route::get('/profile-{slug}', 'StudentController@show')->name('show.student');
        Route::put("/student/{id}/subject", "StudentController@updateSubject");
        Route::resource('subjects', 'SubjectController');
        Route::put('user/{id}/permission', 'UserController@permission');
        Route::get('aversge-score<5', 'SendMailController@index')->name('mail.index');
        Route::get('send-mail', 'SendMailController@store')->name('mail.store');
    });
});
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('login', 'LoginController@loginForm')->name('login');
    Route::post('login', 'LoginController@postLogin');

    Route::get('signup', 'RegisterController@signupForm')->name('signup');
    Route::post('signup', 'RegisterController@postSignup')->name('signup.store');

    Route::any('logout', function(){
        Auth::logout();
        return redirect(route('login'));
    })->name('logout');

    Route::get('login/social/{social}', 'SocialController@redirectToProvider')->name('social.login');
    Route::get('check-login/social/{social}', 'SocialController@handleProviderCallback');
});
