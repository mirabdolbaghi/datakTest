<?php

use Illuminate\Http\Request;



Route::namespace('Auth')->group(function () {
    Route::post('/register', 'RegisterController@register');
    Route::post('login', 'LoginController@login')->name('login');
    Route::middleware(['jwt.auth'])->get('/logout', 'LoginController@logout');

    Route::middleware(['jwt.auth'])->post('/reset-password', 'UserController@resetPassword');
    Route::middleware(['jwt.auth'])->post('/update-profile', 'UserController@updateProfile');

});

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/profile', function (Request $request) {
        return [
            'status' => 'success',
            'data' => $request->user()->only(['name','email','mobile','image'])
        ];
    });
    Route::prefix('event')->group(function (){

        Route::get('/invitation','UserEventController@index');
        Route::post('/invitation/{userEvent}/accept','UserEventController@accept')->name('invitation.acccept');
        Route::post('/invitation/{userEvent}/decline','UserEventController@decline')->name('invitation.decline');

        Route::get('/','EventController@index');
        Route::post('/','EventController@store')->name('event.store');
        Route::get('/{event}','EventController@show');
    });
});




