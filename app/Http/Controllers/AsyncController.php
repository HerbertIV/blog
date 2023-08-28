<?php

namespace App\Http\Controllers;

use App\Dtos\AsyncDtos\PermissionDto;
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
}
