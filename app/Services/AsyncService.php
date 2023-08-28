<?php

namespace App\Services;

use App\Dtos\AsyncDtos\Contracts\AsyncDtoContract;
use App\Repositories\Contracts\PermissionRepositoryContract;
use App\Services\Contracts\AsyncServiceContract;
use Illuminate\Support\Collection;

class AsyncService implements AsyncServiceContract
{
    public function __construct(
       private PermissionRepositoryContract $permissionRepository,
    ) {
    }

    public function permissions(AsyncDtoContract $dto): Collection
    {
        return $this->permissionRepository->search($dto->getTerm())->get();
    }
}
