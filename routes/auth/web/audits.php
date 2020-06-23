<?php

Route::group(['prefix' => '/audits'], function () {
    Route::get('/', 'Audits@index')->name('audits.index');
});
