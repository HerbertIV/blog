<?php

namespace App\Services;

use App\Repositories\Contracts\PermissionRepositoryContract;
use App\Services\Contracts\PermissionServiceContract;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class PermissionService implements PermissionServiceContract
{
    public function __construct(
       private PermissionRepositoryContract $permissionRepository
    ) {
    }

    public function first(int $id): Role
    {
        return $this->permissionRepository->where('id', $id)->first();
    }

    public function get(array $ids): Collection
    {
        return $this->permissionRepository->whereIn('id', $ids)->get();
    }
}
