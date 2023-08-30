<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryContract;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PermissionRepository extends BaseRepository implements PermissionRepositoryContract
{
    public function model(): string
    {
        return Permission::class;
    }

    public function getWhereActions(array $actions = []): Builder
    {
        return $this->query()->when(
            !empty($actions),
            fn (Builder $query) => $query->where(function (Builder $query) use ($actions) {
                foreach ($actions as $action) {
                    $query->orWhere('name', 'like', $action . '-%');
                }
            })
        );
    }

    public function search(string $term = ''): Builder
    {
        $query = $this->model->newQuery();
        $query->where('name', 'like', "%$term%");

        return $query;
    }
}
