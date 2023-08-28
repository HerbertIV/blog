<?php

namespace App\Services;

use App\Dtos\RoleDto;
use App\Helpers\StrategyHelper;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Services\Contracts\BlogServiceContract;
use App\Strategies\Relations\MainRelationStrategy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class BlogService implements BlogServiceContract
{
    public function __construct(
       private RoleRepositoryContract $roleRepository
    ) {
    }

    public function create(RoleDto $roleDto): Role
    {

    }

    public function first(int $id): Role
    {
        return $this->roleRepository->where(['id' => $id])->first();
    }

    public function get(array $ids): Collection
    {
        return $this->roleRepository->whereIn('id', $ids)->get();
    }

    public function deleteMany(array $ids): bool
    {

    }

    public function delete(int $id): bool
    {

    }

    public function update(RoleDto $roleDto, int $id): bool
    {
        return DB::transaction(function () use ($roleDto, $id) {
            $this->roleRepository->where(['id' => $id])->update($roleDto->toArray());
            foreach ($roleDto->getRelations() as $relationKey => $relation) {
                StrategyHelper::makeStrategy(
                    'App\Strategies\Relations\\',
                    $relationKey,
                    MainRelationStrategy::class,
                    'setRelation',
                    [
                        'role_id' => $id,
                        'permissions' => $relation
                    ]
                );
            }
            return true;
        });
    }

    public function setPermissionsToRole(int $roleId, array $permissions): void
    {
        $role = $this->first($roleId);
        if ($role) {
            DB::transaction(function () use ($permissions, $role) {
                $role->syncPermissions($permissions);
            });
        }
    }
}
