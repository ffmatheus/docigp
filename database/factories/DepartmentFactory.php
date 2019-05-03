<?php

use App\Data\Models\Department;

$factory->define(Department::class, function () {
    return [
        'name' => faker()->name,
        'initials' => faker()->name,
    ];
});
