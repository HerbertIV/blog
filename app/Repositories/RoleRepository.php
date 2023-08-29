<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryContract;
use Illuminate\Contracts\Database\Eloquent\Builder;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    public function model(): string
    {
        return Role::class;
    }

    public function search(string $term = ''): Builder
    {
        $query = $this->model->newQuery();
        $query->where('name', 'like', "%$term%");

        return $query;
    }
}
