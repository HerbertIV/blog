<?php

namespace App\Http\Requests\Blog;

use App\Enums\GuardEnums;
use App\Enums\PermissionEnums;
use Illuminate\Foundation\Http\FormRequest;

class NewsDeleteRequest extends FormRequest
{
    public function authorize()
    {
        $hasAccess =
            auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('blog' . PermissionEnums::HYPHEN . PermissionEnums::DELETE_ACTION) &&
            auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('blog' . PermissionEnums::HYPHEN . PermissionEnums::READ_ACTION);
        if (!$hasAccess) {
            abort(403);
        }
        return true;
    }
}
