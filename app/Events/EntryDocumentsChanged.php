<?php

namespace App\Events;

use App\Data\Models\EntryDocument;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Events\Traits\RateLimited;

class EntryDocumentsChanged extends Broadcastable
{
    use Dispatchable, InteractsWithSockets, SerializesModels, RateLimited;

    public $entryDocumentId;
    public $entryId;

    public function __construct($entryDocumentId, $entryId = null)
    {
        $this->entryDocumentId = $entryDocumentId;

        $this->entryId =
            $entryId ??
            EntryDocument::withoutGlobalScopes()->find($entryDocumentId)
                ->entry_id;
    }

    public function broadcastChannelName()
    {
        return 'entries.' . $this->entryId;
    }
}
