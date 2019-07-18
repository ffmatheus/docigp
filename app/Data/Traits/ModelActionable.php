<?php

namespace App\Data\Traits;

use App\Data\Models\EntryDocument;

trait ModelActionable
{
    public function verify()
    {
        $this->update([
            'verified_at' => now(),
            'verified_by_id' => auth()->user()->id,
        ]);
    }

    public function unverify()
    {
        $this->update([
            'verified_at' => null,
            'verified_by_id' => auth()->user()->id,
        ]);

        $this->unanalyse();
    }

    public function analyse()
    {
        $this->update([
            'analysed_at' => now(),
            'analysed_by_id' => auth()->user()->id,
        ]);
    }

    public function unanalyse()
    {
        $this->update([
            'analysed_at' => null,
            'analysed_by_id' => auth()->user()->id,
        ]);

        if (!$this instanceof EntryDocument) {
            $this->unpublish();
        }
    }

    public function publish()
    {
        $this->update([
            'published_at' => now(),
            'published_by_id' => auth()->user()->id,
        ]);
    }

    public function unpublish()
    {
        $this->update([
            'published_at' => null,
            'published_by_id' => auth()->user()->id,
        ]);
    }

    public function close()
    {
        $this->update([
            'closed_at' => now(),
            'closed_by_id' => auth()->user()->id,
        ]);
    }

    public function reopen()
    {
        $this->update([
            'closed_at' => null,
            'closed_by_id' => auth()->user()->id,
        ]);
    }
}
