<?php

namespace App\Support;

class Constants
{
    const ALERJ_PROVIDER_ID = 1;

    const COST_CENTER_CREDIT_ID = 1;
    const COST_CENTER_TRANSPORT_DEBIT_ID = 2;
    const COST_CENTER_TRANSPORT_CREDIT_ID = 3;

    const COST_CENTER_CONTROL_ID_ARRAY = [
        Constants::COST_CENTER_CREDIT_ID,
        Constants::COST_CENTER_TRANSPORT_CREDIT_ID,
        Constants::COST_CENTER_TRANSPORT_DEBIT_ID,
    ];

    const COST_CENTER_CREDIT_ID_ARRAY = [
        Constants::COST_CENTER_CREDIT_ID,
        Constants::COST_CENTER_TRANSPORT_CREDIT_ID,
    ];

    const ENTRY_TYPE_ALERJ_DEPOSIT_ID = 1;
    const ENTRY_TYPE_TRANSPORT_ID = 2;
    const ENTRY_TYPE_TRANSFER_ID = 3;
    const ENTRY_TYPE_CHECK_ID = 4;
    const ENTRY_TYPE_DEBIT_ID = 5;
    const ENTRY_TYPE_ACCOUNT_DEBIT_ID = 6;

    const ROLE_CONGRESSMAN = 'congressman';

    const SESSION_FORM_MODE = 'flash_form_mode';
    const FORM_MODE_CREATE = 'create';
    const FORM_MODE_SHOW = 'show';
}
