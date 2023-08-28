<?php

namespace App\Services\Contracts;

use App\Dtos\AsyncDtos\Contracts\AsyncDtoContract;
use Illuminate\Support\Collection;

interface AsyncServiceContract
{
    public function permissions(AsyncDtoContract $dto): Collection;
}
