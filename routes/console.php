<?php

use App\Data\Repositories\Budgets;
use App\Data\Repositories\Users;
use App\Services\DataSync\Service as DataSyncService;

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
    $this->info('Creating roles...');
    app(DataSyncService::class)->roles();

    $this->info('Creating abilities...');
    app(DataSyncService::class)->abilities();

    $this->info('Assigning abilities to roles...');
    app(DataSyncService::class)->rolesAbilities();
})->describe('Create roles');

Artisan::command('docigp:budget:generate {baseDate?}', function (
    $baseDate = null
) {
    $this->info('Generating budgets...');

    app(Budgets::class)->generate($baseDate);
})->describe('Sync congressmen data');

Artisan::command('docigp:make-admin {email?}', function ($email = null) {
    if (!($user = app(Users::class)->findByEmail($email))) {
        return $this->info('E-mail não encontrado.');
    }

    $user->assign('administrator');

    $this->info("{$user->name} is now an administrator");

    dd($user->abilities);
})->describe('Make a user an administrator');
