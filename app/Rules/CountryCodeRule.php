<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use League\ISO3166\ISO3166;

class CountryCodeRule implements Rule
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
        try {
            (new ISO3166())->alpha3((string)$value);

            return true;
        } catch (\Exception $exception){

            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Country Code is invalid.';
    }
}
