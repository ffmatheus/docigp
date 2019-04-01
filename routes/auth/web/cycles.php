<?php
Route::group(['prefix' => '/cycles'], function () {
    Route::get('/', 'Cycles@index')->name('cycles.index');
});
