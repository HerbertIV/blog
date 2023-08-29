<?php

namespace App\Http\Controllers;

use App\Dtos\AsyncDtos\PermissionDto;
use App\Dtos\AsyncDtos\RoleDto;
use App\Http\Requests\AsyncRequest;
use App\Http\Resources\AsyncResource;
use App\Services\Contracts\AsyncServiceContract;
use Illuminate\Http\Resources\Json\JsonResource;

class AsyncController extends Controller
{
    public function __construct(
        private AsyncServiceContract $asyncService
    ) {
    }

    public function permissions(AsyncRequest $asyncRequest): JsonResource
    {
        $permissionDto = new PermissionDto($asyncRequest->all());

        return AsyncResource::collection($this->asyncService->permissions($permissionDto));
    }

    public function rolesAdmin(AsyncRequest $asyncRequest): JsonResource
    {
        $roleDto = new RoleDto($asyncRequest->all());

        return AsyncResource::collection($this->asyncService->rolesAdmin($roleDto));
    }

    public function rolesBlog(AsyncRequest $asyncRequest): JsonResource
    {
        $roleDto = new RoleDto($asyncRequest->all());

        return AsyncResource::collection($this->asyncService->rolesBlog($roleDto));
    }
}
