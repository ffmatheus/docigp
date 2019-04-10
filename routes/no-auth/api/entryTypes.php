<?php

Route::group(['prefix' => '/entry-types'], function () {
    Route::get('/', 'EntryTypes@all')->name('entry-types.all');
});
