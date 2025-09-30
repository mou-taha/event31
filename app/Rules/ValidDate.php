<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidDate implements ValidationRule
{
    public function passes($attribute, $value)
    {
        // Check if the date is valid
        return $value ? (bool) strtotime($value) : true;
    }

    public function message()
    {
        return 'The :attribute is not a valid date.';
    }
}
