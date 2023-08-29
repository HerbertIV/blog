<?php

namespace App\Http\Requests\Role;

use App\Enums\GuardEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        //TODO validation permission can be in role
        return [
            'name' => ['string', 'unique:roles'],
            'guard' => ['string', Rule::in(GuardEnums::getValues())],
            'permissions' => ['array'],
            'permissions.*' => ['int'],
        ];
    }
}
