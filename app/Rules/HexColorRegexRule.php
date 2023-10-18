<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HexColorRegexRule implements Rule
{

    public const REGEX = '/^([a-fA-F0-9]{6}|[a-fA-F0-9]{3}|[a-fA-F0-9]{8}|[a-fA-F0-9]{4})$/';

    /**
     * @var bool
     */


    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (bool) preg_match(self::REGEX, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not valid';
    }
}
