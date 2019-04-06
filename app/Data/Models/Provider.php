<?php

namespace App\Data\Models;

class Provider extends Model
{
    protected $fillable = [
        'cpf_cnpj',
        'type',
        'name',
        'created_by_id',
        'updated_by_id',
    ];
}
