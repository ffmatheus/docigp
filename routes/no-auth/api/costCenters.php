<?php

Route::group(['prefix' => '/cost-centers'], function () {
    Route::get('/', 'CostCenters@all')->name('cost-centers.all');
});
