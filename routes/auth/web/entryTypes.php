<?php

Route::group(['prefix' => '/entry-types'], function () {
    Route::get('/create', 'EntryTypes@create')->name('entry-types.create');

    Route::post('/', 'EntryTypes@store')->name('entry-types.store');

    Route::get('/{id}', 'EntryTypes@show')->name('entry-types.show');

    Route::post('/{id}', 'EntryTypes@update')->name('entry-types.update');

    Route::get('/', 'EntryTypes@index')->name('entry-types.index');
});
