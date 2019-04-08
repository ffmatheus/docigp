<?php

Route::group(['prefix' => '/budgets'], function () {
    Route::post('/{id}', 'Budgets@update')->name('budgets.update');

    Route::post('/', 'Budgets@store')->name('budgets.store');
});
