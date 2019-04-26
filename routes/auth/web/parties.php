<?php

Route::group(['prefix' => '/parties'], function () {
    Route::get('/create', 'Parties@create')->name('parties.create');

    Route::get('/', 'Parties@index')->name('parties.index');

    Route::get('/{id}', 'Parties@show')->name('parties.show');

    Route::post('/{id}', 'Parties@update')->name('parties.update');

    Route::post('/', 'Parties@store')->name('parties.store');
});
