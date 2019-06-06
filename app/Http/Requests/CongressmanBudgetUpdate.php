<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;

class CongressmanBudgetUpdate extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return allows('congressman-budgets:update') ||
            allows('congressman-budgets:percentage');
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
