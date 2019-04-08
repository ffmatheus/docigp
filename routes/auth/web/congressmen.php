<?php
Route::group(['prefix' => '/congressmen'], function () {
    Route::get('/', 'Congressmen@index')->name('congressmen.index');

    Route::get('/create', 'Congressmen@create')->name('congressmen.create');

    Route::post('/', 'Congressmen@store')->name('congressmen.store');

    Route::get('/{id}', 'Congressmen@show')->name('congressmen.show');
});
