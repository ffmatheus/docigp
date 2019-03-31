<?php
Route::group(
    ['prefix' => '/', 'namespace' => 'Web\Pub', 'middleware' => 'guest'],
    function () {
        require __DIR__ . '/web/home.php';
    }
);
