<?php

Route::group(['prefix' => '/legislatures'], function () {
    Route::get('/create', 'Legislatures@create')->name('legislatures.create');

    Route::post('/', 'Legislatures@store')->name('legislatures.store');

    Route::get('/{id}', 'Legislatures@show')->name('legislatures.show');

    Route::post('/{id}', 'Legislatures@update')->name('legislatures.update');

    Route::get('/', 'Legislatures@index')->name('legislatures.index');
});
