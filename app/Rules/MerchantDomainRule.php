<?php

namespace App\Rules;

use App\Models\Merchant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;

class MerchantDomainRule implements Rule
{

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
        if(!in_array($value,Config::get('azpays.merchant.share_domains'))){
             return ! Merchant::where('domain',$value)->exists();
        }
        return true;

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
