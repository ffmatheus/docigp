<?php

Route::group(['prefix' => '/entryTypes'], function () {
    Route::get('/create', 'EntryTypes@create')->name('entryTypes.create');

    Route::post('/', 'EntryTypes@store')->name('entryTypes.store');

    Route::get('/{id}', 'EntryTypes@show')->name('entryTypes.show');

    Route::post('/{id}', 'EntryTypes@update')->name('entryTypes.update');

    Route::get('/', 'EntryTypes@index')->name('entryTypes.index');
});
