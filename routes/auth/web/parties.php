<?php
Route::group(['prefix' => '/parties'], function () {
    Route::get('/', 'Parties@index')->name('parties.index');
});
