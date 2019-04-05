<?php

namespace App\Data\Traits;

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

        $this->unapprove();
    }

    public function approve()
    {
        info($this);
        $this->update([
            'approved_at' => now(),
            'approved_by_id' => auth()->user()->id,
        ]);
    }

    public function unapprove()
    {
        $this->update([
            'approved_at' => null,
            'approved_by_id' => auth()->user()->id,
        ]);

        $this->unpublish();
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
}
