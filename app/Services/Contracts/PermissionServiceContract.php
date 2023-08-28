<?php

namespace App\Services\Contracts;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

interface PermissionServiceContract
{
    public function first(int $id): Role;
    public function get(array $ids): Collection;
}
