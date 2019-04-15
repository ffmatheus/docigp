<?php

Route::group(['prefix' => '/upload-files'], function () {
    Route::get('/', 'UploadFiles@index')->name('upload-files.index');

    Route::get('/create', 'UploadFiles@create')->name('upload-files.create');

    Route::post('/', 'UploadFiles@store')->name('upload-files.store');
});
