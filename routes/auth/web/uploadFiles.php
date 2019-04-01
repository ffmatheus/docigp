<?php
Route::group(['prefix' => '/uploadFiles'], function () {
    Route::get('/', 'UploadFiles@index')->name('uploadFiles.index');

    Route::get('/create', 'UploadFiles@create')->name('uploadFiles.create');

    Route::post('/', 'UploadFiles@store')->name('uploadFiles.store');
});
