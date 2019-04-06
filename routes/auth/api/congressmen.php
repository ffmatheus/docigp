<?php

Route::group(['prefix' => '/congressmen'], function () {
    Route::get('/', 'Congressmen@all')->name('congressmen.all');

    Route::post('/{id}', 'Congressmen@update')->name('congressmen.update');

    Route::post('/', 'Congressmen@store')->name('congressmen.store');

    Route::group(['prefix' => '/{congressmanId}/budgets'], function () {
        Route::get('/', 'CongressmanBudgets@all')->name(
            'congressmen.budgets.all'
        );

        Route::group(['prefix' => '/{congressmanBudgetId}'], function () {
            Route::post('/', 'CongressmanBudgets@update')->name(
                'congressmen.budgets.update'
            );

            Route::post('/comply', 'CongressmanBudgets@comply')->name(
                'congressmen.budgets.comply'
            );

            Route::post('/uncomply', 'CongressmanBudgets@uncomply')->name(
                'congressmen.budgets.uncomply'
            );

            Route::post('/publish', 'CongressmanBudgets@publish')->name(
                'congressmen.budgets.publish'
            );

            Route::post('/unpublish', 'CongressmanBudgets@unpublish')->name(
                'congressmen.budgets.unpublish'
            );

            Route::post('/deposit', 'CongressmanBudgets@deposit')->name(
                'congressmen.budgets.deposit'
            );
        });

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
                    Route::post('/delete', 'Entries@delete')->name(
                        'congressmen.budgets.entries.delete'
                    );

                    Route::post('/verify', 'Entries@verify')->name(
                        'congressmen.budgets.entries.verify'
                    );

                    Route::post('/unverify', 'Entries@unverify')->name(
                        'congressmen.budgets.entries.unverify'
                    );

                    Route::post('/comply', 'Entries@comply')->name(
                        'congressmen.budgets.entries.comply'
                    );

                    Route::post('/uncomply', 'Entries@uncomply')->name(
                        'congressmen.budgets.entries.uncomply'
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
                                    '/comply',
                                    'EntryDocuments@comply'
                                )->name('congressmen.budgets.entries.comply');

                                Route::post(
                                    '/uncomply',
                                    'EntryDocuments@uncomply'
                                )->name('congressmen.budgets.entries.uncomply');
                            }
                        );
                    });
                });
            }
        );
    });
});
