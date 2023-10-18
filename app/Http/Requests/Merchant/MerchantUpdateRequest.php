<?php

namespace App\Http\Requests\Merchant;

use App\Rules\HexColorRegexRule;
use App\Rules\MerchantDomainRule;
use App\Rules\MobileRegexRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MerchantUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'tell' => ['required', 'string', 'max:255'],
            'domain' => ['required', 'string', new MerchantDomainRule], // todo: implement ignore for current merchant
            'ip' => ['nullable', 'ip'],
            'webhook' => ['nullable', 'url'],
            'callback' => ['nullable', 'url'],
            'description' => ['nullable', 'string', 'max:255'],
            'support_email' => ['nullable', 'email'],
            'support_phone' => ['nullable', new MobileRegexRule()],
            'support_url' => ['nullable', 'url'],
            'color'=> ['required', new HexColorRegexRule],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png', 'max:100'],

            'purses' => ['required', 'array'],
            'purses.*' => ['required', 'array'],
            'purses.*.purse_id' => [
                'required',
                'bail',
                'uuid',
                Rule::exists('purse_users', 'purse_id')->where('user_id', $this->user()->id),
            ],
            'purses.*.percentage' => ['required', 'numeric', 'max:100'],
            'purses.*.fee' => ['required', 'decimal:0,2'],

            'categories' => ['required', 'array'],
            'categories.*' => ['required','bail', 'uuid', Rule::exists('categories', 'id')],

            'tags' => ['required', 'array'],
            'tags.*' => ['required','bail', 'uuid', Rule::exists('tags', 'id')],
        ];
    }
}
