<?php

Route::group(['prefix' => '/congressman-legislatures'], function () {
    Route::post(
        '/remove',
        'CongressmanLegislatures@removeFromLegislature'
    )->name('congressman-legislatures.remove-from-legislature');

    Route::post(
        '/include',
        'CongressmanLegislatures@includeInLegislature'
    )->name('congressman-legislatures.include-in-legislature');
});
