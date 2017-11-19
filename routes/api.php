<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/user/notifications', 'ApiController@notifications')->name('api.user.notifications');
    Route::get('/changes', 'ApiController@openChanges')->name('api.changes');
    Route::post('/changes/create', 'ApiController@createChange')->name('api.changes.create');
    Route::post('/changes/{id}/accept', 'ApiController@acceptChange')->name('api.changes.accept');
    Route::post('/changes/{id}/reject', 'ApiController@rejectChange')->name('api.changes.reject');
});
