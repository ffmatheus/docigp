<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlerjEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        preg_match('/(.*?)@(.*)/', $value, $output_array);
        if (!isset($output_array[2])) {
            return false;
        } else {
            return trim($output_array[2] == 'alerj.rj.gov.br');
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O email deve ser um email da ALERJ. Exemplo: exemplo@alerj.rj.gov.br';
    }
}
