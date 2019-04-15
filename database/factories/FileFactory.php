<?php

use App\Data\Models\File;
use Illuminate\Support\Str;

$factory->define(File::class, function () {
    return [
        'hash' => sha1(Str::random(30)),
        'drive' => 'local',
        'path' => '/documents',
        'public_url' => '/url',
        'mime_type' => 'application/pdf',
    ];
});
