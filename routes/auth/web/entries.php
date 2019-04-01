<?php
Route::group(['prefix' => '/entries'], function () {
    Route::get('/', 'Entries@index')->name('entries.index');
});
