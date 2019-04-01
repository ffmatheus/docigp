<?php
Route::group(['prefix' => '/users'], function () {
    Route::get('/', 'Users@index')->name('users.index');

    Route::post('/', 'Users@store')->name('users.store');

    Route::get('/{id}', 'Users@show')->name('users.show');
});
