<?php

namespace App\Http\Requests\Purse;

use App\Rules\MaxLimitPurseRule;
use Illuminate\Foundation\Http\FormRequest;

class AddUserPurseRequest extends FormRequest
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

        $request = $this->request->all();
        $rules["user_id"] = ["required","exists:users,id"];
        $rules["percentage"] = ["required","numeric","max:100"];
        $rules['purse_id'] = ["required",
            new MaxLimitPurseRule($request['user_id'],$request['purse_id'],$request['percentage']),
        ];
        return $rules;

    }
}
