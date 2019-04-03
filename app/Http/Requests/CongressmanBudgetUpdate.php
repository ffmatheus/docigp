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
        return true;

        //return Gate::allows('congressmen:modify');
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
