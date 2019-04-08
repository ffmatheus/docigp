<?php

Route::get('/', 'Home@index')->name('home');

Route::get('/', 'Home@index')->name('home.index');

Route::get('/transparencia', 'Home@transparency')->name('home.transparency');
