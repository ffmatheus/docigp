<?php

Route::group(['prefix' => '/costCenters'], function () {
    Route::get('/create', 'CostCenters@create')->name('costCenters.create');

    Route::post('/', 'CostCenters@store')->name('costCenters.store');

    Route::get('/{id}', 'CostCenters@show')->name('costCenters.show');

    Route::post('/{id}', 'CostCenters@update')->name('costCenters.update');

    Route::get('/', 'CostCenters@index')->name('costCenters.index');
});
