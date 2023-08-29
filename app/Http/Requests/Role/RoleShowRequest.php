<?php

namespace App\Http\Requests\Role;

use App\Enums\GuardEnums;
use App\Enums\PermissionEnums;
use Illuminate\Foundation\Http\FormRequest;

class RoleShowRequest extends FormRequest
{
    public function authorize()
    {
        $hasAccess =
            auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('role' . PermissionEnums::HYPHEN . PermissionEnums::READ_ACTION);
        if (!$hasAccess) {
            abort(403);
        }
        return true;
    }
}
