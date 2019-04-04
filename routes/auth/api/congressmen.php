<?php

Route::group(['prefix' => '/congressmen'], function () {
    Route::get('/', 'Congressmen@all')->name('congressmen.all');

    Route::post('/{id}', 'Congressmen@update')->name('congressmen.update');

    Route::post('/', 'Congressmen@store')->name('congressmen.store');

    Route::group(['prefix' => '/{congressmanId}/budgets'], function () {
        Route::get('/', 'CongressmanBudgets@all')->name(
            'congressmen.budgets.all'
        );

        Route::post(
            '/{congressmanBudgetId}',
            'CongressmanBudgets@update'
        )->name('congressmen.budgets.update');

        Route::post('/', 'CongressmanBudgets@store')->name(
            'congressmen.budgets.store'
        );

        Route::group(
            ['prefix' => '/{congressmanBudgetId}/entries'],
            function () {
                Route::get('/', 'Entries@all')->name(
                    'congressmen.budgets.entries.all'
                );

                Route::group(['prefix' => '/{entryId}'], function () {
                    Route::post('/verify', 'Entries@verify')->name(
                        'congressmen.budgets.entries.verify'
                    );

                    Route::post('/unverify', 'Entries@unverify')->name(
                        'congressmen.budgets.entries.unverify'
                    );

                    Route::post('/approve', 'Entries@approve')->name(
                        'congressmen.budgets.entries.approve'
                    );

                    Route::post('/unapprove', 'Entries@unapprove')->name(
                        'congressmen.budgets.entries.unapprove'
                    );
                });
            }
        );
    });
});
