<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileRegexRule implements Rule
{

    public const REGEX = '/^(\+\d{1,3}[- ]?)?\d{10}$/';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        return (bool)preg_match(self::REGEX, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid mobile';
    }
}
