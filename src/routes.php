<?php

Route::group(['namespace' => 'Phy\Core\Controllers'], function() {

    Route::post('/login', 'LoginController@doLogin');

    Route::group(['middleware' => 'valid.token'], function (){
        Route::post('/check', function() {
            return [true];
        });
        
        Route::post('/logout', 'LoginController@doLogout');
    });
});