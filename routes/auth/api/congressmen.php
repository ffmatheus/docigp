<?php

Route::group(['prefix' => '/congressmen'], function () {
    Route::get('/', 'Congressmen@all')->name('congressmen.all');

    Route::post('/{id}', 'Congressmen@update')->name('congressmen.update');

    Route::post('/', 'Congressmen@store')->name('congressmen.store');

    Route::get(
        '/availableCongressmen',
        'Congressmen@availableCongressmen'
    )->name('congressmen.availableCongressmen');
});
