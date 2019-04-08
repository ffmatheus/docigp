<?php

Route::group(['prefix' => '/congressmen'], function () {
    Route::get('/', 'Congressmen@all')->name('congressmen.all');

    Route::group(['prefix' => '/{congressmanId}/budgets'], function () {
        Route::get('/', 'CongressmanBudgets@all')->name(
            'congressmen.budgets.all'
        );

        Route::group(
            ['prefix' => '/{congressmanBudgetId}/entries'],
            function () {
                Route::get('/', 'Entries@all')->name(
                    'congressmen.budgets.entries.all'
                );

                Route::group(['prefix' => '/{entryId}'], function () {
                    Route::group(['prefix' => '/documents'], function () {
                        Route::get('/', 'EntryDocuments@all')->name(
                            'congressmen.budgets.entries.documents.all'
                        );
                    });
                });
            }
        );
    });
});
