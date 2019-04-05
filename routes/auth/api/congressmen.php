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

                    Route::group(['prefix' => '/documents'], function () {
                        Route::get('/', 'EntryDocuments@all')->name(
                            'congressmen.budgets.entries.documents.all'
                        );

                        Route::group(
                            ['prefix' => '/{documentId}'],
                            function () {
                                Route::post(
                                    '/publish',
                                    'EntryDocuments@publish'
                                )->name('congressmen.budgets.entries.publish');

                                Route::post(
                                    '/unpublish',
                                    'EntryDocuments@unpublish'
                                )->name('congressmen.budgets.entries.unverify');

                                Route::post(
                                    '/approve',
                                    'EntryDocuments@approve'
                                )->name('congressmen.budgets.entries.approve');

                                Route::post(
                                    '/unapprove',
                                    'EntryDocuments@unapprove'
                                )->name(
                                    'congressmen.budgets.entries.unapprove'
                                );
                            }
                        );
                    });
                });
            }
        );
    });
});
