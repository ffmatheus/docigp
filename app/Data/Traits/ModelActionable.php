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

        $this->uncomply();
    }

    public function comply()
    {
        info($this);
        $this->update([
            'complied_at' => now(),
            'complied_by_id' => auth()->user()->id,
        ]);
    }

    public function uncomply()
    {
        $this->update([
            'complied_at' => null,
            'complied_by_id' => auth()->user()->id,
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
