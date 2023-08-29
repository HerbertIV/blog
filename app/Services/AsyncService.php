<?php

namespace App\Services;

use App\Dtos\AsyncDtos\Contracts\AsyncDtoContract;
use App\Enums\GuardEnums;
use App\Repositories\Contracts\PermissionRepositoryContract;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Services\Contracts\AsyncServiceContract;
use Illuminate\Support\Collection;

class AsyncService implements AsyncServiceContract
{
    public function __construct(
       private PermissionRepositoryContract $permissionRepository,
       private RoleRepositoryContract $roleRepository,
    ) {
    }

    public function permissions(AsyncDtoContract $dto): Collection
    {
        return $this->permissionRepository->search($dto->getTerm())->get();
    }

    public function rolesAdmin(AsyncDtoContract $dto): Collection
    {
        return $this->roleRepository->search($dto->getTerm())->whereGuardName(GuardEnums::ADMIN)->get();
    }

    public function rolesBlog(AsyncDtoContract $dto): Collection
    {
        return $this->roleRepository->search($dto->getTerm())->whereGuardName(GuardEnums::WEB)->get();
    }
}
