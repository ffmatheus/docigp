<?php

use App\Services\DataSync\Service as DataSyncService;

Artisan::command('vg:sync-congressmen', function () {
    app(DataSyncService::class)->congressmen();
})->describe('Sync congressmen data');
