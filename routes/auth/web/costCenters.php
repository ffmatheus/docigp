<?php

Route::group(['prefix' => '/cost-centers'], function () {
    Route::get('/create', 'CostCenters@create')->name('cost-centers.create');

    Route::post('/', 'CostCenters@store')->name('cost-centers.store');

    Route::get('/{id}', 'CostCenters@show')->name('cost-centers.show');

    Route::post('/{id}', 'CostCenters@update')->name('cost-centers.update');

    Route::get('/', 'CostCenters@index')->name('cost-centers.index');
});
