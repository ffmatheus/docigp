<?php

use App\Data\Models\User;
use App\Data\Repositories\Users as UsersRepository;
use Illuminate\Support\Str;

$factory->define(User::class, function () {
    do {
        $email = faker()->unique()->safeEmail;
    } while (app(UsersRepository::class)->findByEmail($email));

    preg_match('/(.*?)@(.*)/', faker()->unique()->safeEmail, $output_array);

    return [
        'name' => faker()->name,
        'username' => $output_array[1],
        'email' => $output_array[0],
        'email_verified_at' => now(),
        'password' =>
            '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
