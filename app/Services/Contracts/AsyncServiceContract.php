<?php

namespace App\Services\Contracts;

use App\Dtos\AsyncDtos\Contracts\AsyncDtoContract;
use Illuminate\Support\Collection;

interface AsyncServiceContract
{
    public function permissions(AsyncDtoContract $dto): Collection;
    public function rolesAdmin(AsyncDtoContract $dto): Collection;
    public function rolesBlog(AsyncDtoContract $dto): Collection;
}
