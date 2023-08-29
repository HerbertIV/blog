<?php

namespace App\Services\Contracts;

use App\Dtos\RoleDto;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

interface RoleServiceContract
{
    public function create(RoleDto $roleDto): Role;
    public function first(int $id): Role;
    public function get(array $ids): Collection;
    public function delete(int $id): bool;
    public function update(RoleDto $roleDto, int $id): bool;
    public function setPermissionsToRole(int $roleId, array $permissions): void;
}
