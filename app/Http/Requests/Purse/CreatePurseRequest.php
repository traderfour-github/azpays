<?php

namespace App\Http\Requests\Purse;

use App\Rules\CurrencyRegexRule;
use App\Rules\HexColorRegexRule;
use Illuminate\Foundation\Http\FormRequest;

class CreatePurseRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:255'],
            'color'=> ['required', new HexColorRegexRule],
            'currency' => ['required',new CurrencyRegexRule],
        ];
    }
}
