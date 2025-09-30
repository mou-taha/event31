<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MoroccanPhoneNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Basic Moroccan phone number pattern: starts with 05, 06, or 07 and followed by 8 digits
        return preg_match('/^(05|06|07)[0-9]{8}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The phone number must be a valid Moroccan phone number.';
    }
}
