<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

require __DIR__ . '/services/legislatures.php';
require __DIR__ . '/services/parties.php';
require __DIR__ . '/services/congressmen.php';
require __DIR__ . '/services/cycles.php';
require __DIR__ . '/services/entries.php';
