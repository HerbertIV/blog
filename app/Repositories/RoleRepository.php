<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepositoryContract;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    public function model(): string
    {
        return Role::class;
    }
}
