<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\RoleDto;
use App\Http\Requests\RoleRequest;
use App\Services\Contracts\RoleServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct(
        private RoleServiceContract $roleService
    ) {
    }

    public function index(): View
    {
        return view('admin.pages.role.index');
    }

    public function create(): View
    {
        return view('admin.pages.role.create');
    }

    public function show(Role $role): View
    {
        return view('admin.pages.role.show', ['role' => $role]);
    }

    public function edit(Role $role): View
    {
        return view('admin.pages.role.edit', ['role' => $role]);
    }

    public function destroy(Role $role)
    {
        $this->roleService->delete($role->getKey());
    }

    //Currently using livewire
    public function store(RoleRequest $request): JsonResponse
    {
        $roleDto = new RoleDto($request->validated());
        $this->roleService->create($roleDto);
        return response()->json([
            'success' => true
        ], JsonResponse::HTTP_CREATED);
    }

    //Currently using livewire
    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        $roleDto = new RoleDto($request->validated());
        $this->roleService->update($roleDto, $role->getKey());
        return response()->json([
            'success' => true
        ]);
    }
}
