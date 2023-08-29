<?php

namespace App\Http\Requests\User;

use App\Enums\GuardEnums;
use App\Enums\PermissionEnums;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    public function authorize()
    {
        $hasAccess =
            auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('user' . PermissionEnums::HYPHEN . PermissionEnums::UPDATE_ACTION) &&
            auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('user' . PermissionEnums::HYPHEN . PermissionEnums::READ_ACTION);
        if (!$hasAccess) {
            abort(403);
        }
        return true;
    }
}
