<?php

use App\Data\Repositories\Budgets;
use App\Data\Repositories\Users;
use App\Services\DataSync\Service as DataSyncService;
use Illuminate\Support\Facades\Hash;

Artisan::command('docigp:sync:congressmen', function () {
    $this->info('Synchronizing congressmen...');

    app(DataSyncService::class)->congressmen();
})->describe('Sync congressmen data');

Artisan::command('docigp:sync:parties', function () {
    $this->info('Synchronizing parties...');

    app(DataSyncService::class)->parties();
})->describe('Sync congressmen data');

Artisan::command('docigp:sync:departaments', function () {
    $this->info('Creating departaments...');

    app(DataSyncService::class)->departaments();
})->describe('Create departaments');

Artisan::command('docigp:sync:roles', function () {
    $this->info('Creating roles and abilities...');
    app(DataSyncService::class)->roles();
})->describe('Create roles');

Artisan::command('docigp:budget:generate {baseDate?}', function (
    $baseDate = null
) {
    $this->info('Generating budgets...');

    app(Budgets::class)->generate($baseDate);
})->describe('Sync congressmen data');

Artisan::command('docigp:role:assign {role} {email}', function ($role, $email) {
    if (!($user = app(Users::class)->findByEmail($email))) {
        return $this->info('E-mail não encontrado.');
    }

    $user->assign($role);

    $this->info("{$user->name} is now '{$role}'");
})->describe('Add role to user');

Artisan::command('docigp:role:retract {role} {email}', function (
    $role,
    $email
) {
    if (!($user = app(Users::class)->findByEmail($email))) {
        return $this->info('E-mail não encontrado.');
    }

    $user->retract($role);

    $this->info("{$user->name} is not '{$role}' anymore");
})->describe('Remove role from user');

Artisan::command('docigp:user:create {email} {name} {password}', function (
    $email,
    $name,
    $password
) {
    $user = app(Users::class)->firstOrCreate(
        ['email' => $email],
        [
            'name' => $name,
            'email' => $email,
            'username' => $email,
            'password' => Hash::make($password),
        ]
    );

    $this->info("User {$user->email} created");
})->describe('Create user');
