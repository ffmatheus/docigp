<?php

Route::group(['prefix' => '/users'], function () {
    Route::get('/', 'Users@index')->name('users.index');

    Route::get('/show/{id}', 'Users@show')->name('users.show');

    Route::get('/create', 'Users@create')->name('users.create');

    Route::post('/{id}', 'Users@update')->name('users.update');

    Route::post('/', 'Users@store')->name('users.store');
});
