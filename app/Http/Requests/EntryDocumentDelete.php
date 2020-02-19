<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use App\Http\Traits\WithRouteParams;
use App\Data\Models\Entry;

class EntryDocumentDelete extends Request
{
    use WithRouteParams;

    /**
     * @return bool
     */
    public function authorize()
    {
        $entry = Entry::find($this->all()['entryDocumentId']);

        return $entry &&
            Gate::allows('entry-documents:update:model', $entry) &&
            allows('entry-documents:delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
