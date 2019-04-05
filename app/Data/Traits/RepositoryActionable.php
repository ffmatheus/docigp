<?php

namespace App\Data\Traits;

trait RepositoryActionable
{
    public function publish($modelId)
    {
        $this->findById($modelId)->publish();
    }

    public function unpublish($modelId)
    {
        $this->findById($modelId)->unpublish();
    }

    public function approve($modelId)
    {
        $this->findById($modelId)->approve();
    }

    public function unapprove($modelId)
    {
        $this->findById($modelId)->unapprove();
    }

    public function verify($entryId)
    {
        $this->findById($entryId)->verify();
    }

    public function unverify($entryId)
    {
        $this->findById($entryId)->unverify();
    }
}
