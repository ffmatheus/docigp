<?php

namespace App\Data\Traits;

use App\Data\Models\User;
use App\Data\Models\ChangeUnread;

trait MarkAsUnread
{
    public function markAsUnread()
    {
        User::normal()
            ->get()
            ->each(function ($user) {
                ChangeUnread::firstOrCreate([
                    'user_id' => $user->id,
                    'congressman_id' => $this->congressman->id,
                ]);
            });
    }
}
