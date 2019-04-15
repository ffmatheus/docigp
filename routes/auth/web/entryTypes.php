<?php

Route::group(['prefix' => '/entryTypes'], function () {
    Route::get('/create', 'EntryTypes@create')->name('entryTypes.create');

    Route::post('/', 'EntryTypes@store')->name('entryTypes.store');

    Route::get('/{id}', 'EntryTypes@show')->name('entryTypes.show');

    Route::get('/', 'EntryTypes@index')->name('entryTypes.index');
});
