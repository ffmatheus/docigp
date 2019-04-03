<?php

Route::group(['prefix' => '/users'], function () {
    Route::post('/per-page/{size}', 'Users@perPage')->name('users.per-page');
});
