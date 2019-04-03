<?php

Route::group(['prefix' => '/congressmen'], function () {
    Route::get('/', 'Congressmen@all')->name('congressmen.all');

    Route::post('/{id}', 'Congressmen@update')->name('congressmen.update');

    Route::post('/', 'Congressmen@store')->name('congressmen.store');

    Route::group(['prefix' => '/{id}/budgets'], function () {
        Route::get('/', 'CongressmanBudgets@all')->name(
            'congressmen.budgets.all'
        );

        Route::post('/{id}', 'CongressmanBudgets@update')->name(
            'congressmen.budgets.update'
        );

        Route::post('/', 'CongressmanBudgets@store')->name(
            'congressmen.budgets.store'
        );
    });
});
