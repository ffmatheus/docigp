<?php

namespace App\Http\Requests;

use App\Rules\WithinBudgetDate;
use Carbon\Carbon;

class EntryStore extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Gate::allows('entries:store');
    }

    private function getQueryValue(string $string)
    {
        return request()->segment(
            collect(request()->segments())->search($string) + 2
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => [
                'required',
                new WithinBudgetDate($this->getQueryValue('budgets')),
            ],
            'value_abs' => 'required',
            'object' => 'required',
            'to' => 'required',
            'cost_center_id' => 'required',
            'provider_cpf_cnpj' => 'required',
            'entry_type_id' => 'required',
        ];
    }

    /**
     * @param array $all
     * @return array
     */
    public function sanitize(array $all)
    {
        if (isset($all['date'])) {
            $all['date'] = Carbon::createFromFormat('d/m/Y', $all['date']);
        }

        if (isset($all['date'])) {
            $all['value'] = -$all['value_abs'];
        }

        return $all;
    }
}
