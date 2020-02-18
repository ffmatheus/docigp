<?php

namespace App\Events;

use App\Data\Models\EntryComment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Events\Traits\RateLimited;

class EntryCommentsChanged extends Broadcastable
{
    use Dispatchable, InteractsWithSockets, SerializesModels, RateLimited;

    public $entryCommentId;
    public $entryId;

    public function __construct($entryCommentId, $entryId = null)
    {
        $this->entryCommentId = $entryCommentId;

        $this->entryId =
            $entryId ??
            EntryComment::withoutGlobalScopes()->find($entryCommentId)
                ->entry_id;
    }

    public function broadcastChannelName()
    {
        return 'entries.' . $this->entryId;
    }
}
