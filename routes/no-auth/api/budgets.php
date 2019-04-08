<?php

Route::group(['prefix' => '/budgets'], function () {
    Route::get('/', 'Budgets@all')->name('budgets.all');

    Route::get('/availableBudgets', 'Budgets@availableBudgets')->name(
        'budgets.availableBudgets'
    );
});
