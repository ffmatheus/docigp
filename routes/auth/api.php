<?php
Route::group(
    [
        'prefix' => '/api/v1',
        'namespace' => 'Api',
        'middleware' => ['auth', 'app.users'],
    ],
    function () {

    }
);
