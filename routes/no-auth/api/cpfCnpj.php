<?php

Route::group(['prefix' => '/cpf-cnpj'], function () {
    Route::post('/check', 'CpfCnpj@check')->name('cpf-cnpj.check');
});
