<?php
Route::group(['prefix' => '/users'], function () {
    Route::get('/', 'Users@index')->name('users.index');

    Route::get('/{id}', 'Users@show')->name('users.show');

    Route::post('/{id}', 'Users@update')->name('users.update');

    Route::post('/', 'Users@store')->name('users.store');
});
