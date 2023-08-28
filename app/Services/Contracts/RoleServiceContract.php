<?php

namespace App\Services\Contracts;

use App\Dtos\RoleDto;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

interface RoleServiceContract
{
    public function create(RoleDto $roleDto): bool;
    public function first(int $id): Role;
    public function get(array $ids): Collection;
    public function deleteMany(array $ids): bool;
    public function delete(int $id): bool;
    public function update(RoleDto $roleDto, int $id): bool;
    public function setPermissionsToRole(int $roleId, array $permissions): void;
}
