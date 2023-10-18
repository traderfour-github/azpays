<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use League\ISO3166\ISO3166;

class CurrencyCodeRule implements Rule
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
        $currencies = collect((new ISO3166())->all())->pluck('currency')->flatten();

        return in_array($value, $currencies->toArray());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid currency code.';
    }
}
