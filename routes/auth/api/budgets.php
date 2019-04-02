<?php

Route::group(['prefix' => '/budgets'], function () {
    Route::get('/', 'Budgets@all')->name('budgets.all');

    Route::post('/{id}', 'Budgets@update')->name('budgets.update');

    Route::post('/', 'Budgets@store')->name('budgets.store');

    Route::get('/availableBudgets', 'Budgets@availableBudgets')->name(
        'budgets.availableBudgets'
    );
});
