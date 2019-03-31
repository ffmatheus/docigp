<?php
Route::group(['prefix' => '/', 'namespace' => 'Web\Pub'], function () {
    require __DIR__ . '/web/home.php';
});
