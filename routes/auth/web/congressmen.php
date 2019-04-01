<?php
Route::group(['prefix' => '/congressmen'], function () {
    Route::get('/', 'Congressmen@index')->name('congressmen.index');
});
