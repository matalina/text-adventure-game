<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCommand implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {

    }

    public function message()
    {
        return 'The :attribute does not start with a valid command.';
    }
}
