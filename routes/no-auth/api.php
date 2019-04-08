<?php
Route::group(['prefix' => '/api/v1', 'namespace' => 'Api'], function () {
    require __DIR__ . '/api/environment.php';
    require __DIR__ . '/api/congressmen.php';
    require __DIR__ . '/api/budgets.php';
    require __DIR__ . '/api/costCenters.php';
    require __DIR__ . '/api/cpfCnpj.php';
});
