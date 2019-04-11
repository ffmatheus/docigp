<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
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
        $all['date'] = Carbon::createFromFormat('d/m/Y', $all['date']);

        $all['value'] = -$all['value_abs'];

        return $all;
    }
}
