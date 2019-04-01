<?php
Route::get('/', 'Home@index')->name('admin.index');

Route::post('/change-client/', 'Home@changeClient')->name('change.client');
