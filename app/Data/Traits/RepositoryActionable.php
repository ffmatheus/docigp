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

    public function comply($modelId)
    {
        $this->findById($modelId)->comply();
    }

    public function uncomply($modelId)
    {
        $this->findById($modelId)->uncomply();
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
