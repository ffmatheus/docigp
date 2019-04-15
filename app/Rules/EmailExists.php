<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Services\Request\RemoteRequest;
use App\Services\Authentication\Service as AuthenticationService;

class EmailExists implements Rule
{
    protected $remoteRequest;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->remoteRequest = app(RemoteRequest::class);
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
        return app(AuthenticationService::class)->emailExists(request('email'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O email não é um email da ALERJ válido.';
    }
}
