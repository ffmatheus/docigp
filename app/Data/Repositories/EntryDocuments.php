<?php

namespace App\Data\Repositories;

use App\Data\Models\EntryDocument as EntryDocument;

class EntryDocuments extends Repository
{
    /**
     * @var string
     */
    protected $model = EntryDocument::class;

    public function allFor($congressmanId, $congressmanBudgetId, $entryId)
    {
        return $this->applyFilter(
            $this->newQuery()
                ->join('entries', 'entries.id', 'entry_documents.entry_id')
                ->join(
                    'congressman_budgets',
                    'congressman_budgets.id',
                    'entries.congressman_budget_id'
                )
                ->join(
                    'congressman_legislatures',
                    'congressman_legislatures.id',
                    'congressman_budgets.congressman_legislature_id'
                )
                ->where(
                    'congressman_legislatures.congressman_id',
                    $congressmanId
                )
                ->where('congressman_budgets.id', $congressmanBudgetId)
                ->where('entry_documents.entry_id', $entryId)
        );
    }
}
