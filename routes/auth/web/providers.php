<?php

Route::group(['prefix' => '/providers'], function () {
    Route::get('/create', 'Providers@create')->name('providers.create');

    Route::post('/', 'Providers@store')->name('providers.store');

    Route::get('/{id}', 'Providers@show')->name('providers.show');

    Route::get('/', 'Providers@index')->name('providers.index');
});
