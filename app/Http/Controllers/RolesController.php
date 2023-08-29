<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleDeleteRequest;
use App\Http\Requests\Role\RoleEditRequest;
use App\Http\Requests\Role\RoleShowRequest;
use App\Services\Contracts\RoleServiceContract;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct(
        private RoleServiceContract $roleService
    ) {
    }

    public function index(RoleShowRequest $request): View
    {
        return view('admin.pages.role.index');
    }

    public function create(RoleCreateRequest $request): View
    {
        return view('admin.pages.role.create');
    }

    public function show(RoleShowRequest $request, Role $role): View
    {
        return view('admin.pages.role.show', ['role' => $role]);
    }

    public function edit(RoleEditRequest $request, Role $role): View
    {
        return view('admin.pages.role.edit', ['role' => $role]);
    }

    public function destroy(RoleDeleteRequest $request, Role $role)
    {
        $this->roleService->delete($role->getKey());
    }
}
