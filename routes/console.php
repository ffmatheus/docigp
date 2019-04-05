<?php

use App\Data\Repositories\Budgets;
use App\Services\DataSync\Service as DataSyncService;

Artisan::command('docigp:sync:congressmen', function () {
    $this->info('Synchronizing congressmen...');
    app(DataSyncService::class)->congressmen();
})->describe('Sync congressmen data');

Artisan::command('docigp:sync:parties', function () {
    $this->info('Synchronizing parties...');
    app(DataSyncService::class)->parties();
})->describe('Sync congressmen data');

Artisan::command('docigp:budget:generate {baseDate?}', function (
    $baseDate = null
) {
    $this->info('Generating budgets...');
    app(Budgets::class)->generate($baseDate);
})->describe('Sync congressmen data');
