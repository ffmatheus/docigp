<?php
Route::group(['prefix' => '/congressman_legislatures'], function () {
    Route::post(
        '/remove',
        'CongressmanLegislatures@removeFromLegislature'
    )->name('congressman_legislatures.removeFromLegislature');

    Route::post(
        '/include',
        'CongressmanLegislatures@includeInLegislature'
    )->name('congressman_legislatures.includeInLegislature');
});
