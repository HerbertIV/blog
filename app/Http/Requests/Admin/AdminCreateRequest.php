<?php

namespace App\Http\Requests\Admin;

use App\Enums\GuardEnums;
use App\Enums\PermissionEnums;
use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
{
    public function authorize()
    {
        $hasAccess =
            auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('admin' . PermissionEnums::HYPHEN . PermissionEnums::CREATE_ACTION) &&
            auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('admin' . PermissionEnums::HYPHEN . PermissionEnums::READ_ACTION);
        if (!$hasAccess) {
            abort(403);
        }
        return true;
    }
}
