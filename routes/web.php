<?php

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

Route::get('/', function () {
    if (Auth::check()) {
        if (empty(Auth::user()->has)) {
            return redirect()->to(route('app.signup'));
        } else {
            return redirect()->to(route('app.main'));
        }
    }
    return view('welcome');
});

Route::get('/login', 'GraphAuthController@login')->name('auth.login');
Route::get('/graph-login', 'GraphAuthController@login')->name('login');
Route::get('/graph-redirect', 'GraphAuthController@redirect');
Route::get('logout', function() {
   Auth::logout();
   return redirect()->to('/');
})->name('logout');

Route::group(['prefix' => 'app', 'middleware' => ['auth']], function() {
    Route::get('signup', 'SignupController@signup')->name('app.signup');
    Route::post('signup/complete', 'SignupController@complete')->name('app.signup.complete');
    Route::get('', 'MainController@main')->name('app.main');

    Route::get('/notifications', 'MainController@notifications')->name('app.notifications');
});


