<?php

namespace App\Services;

use App\Dtos\RoleDto;
use App\Helpers\StrategyHelper;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Services\Contracts\RoleServiceContract;
use App\Strategies\Relations\MainRelationStrategy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleService implements RoleServiceContract
{
    public function __construct(
       private RoleRepositoryContract $roleRepository
    ) {
    }

    public function create(RoleDto $roleDto): Role
    {
        return DB::transaction(function () use ($roleDto) {
            $role = $this->roleRepository->query()->create($roleDto->toArray());
            foreach ($roleDto->getRelations() as $relationKey => $relation) {
                StrategyHelper::makeStrategy(
                    'App\Strategies\Relations\\',
                    $relationKey,
                    MainRelationStrategy::class,
                    'setRelation',
                    [
                        'role_id' => $role->getKey(),
                        'permissions' => $relation
                    ]
                );
            }
            return $role;
        });
    }

    public function first(int $id): Role
    {
        return $this->roleRepository->where(['id' => $id])->first();
    }

    public function get(array $ids): Collection
    {
        return $this->roleRepository->whereIn('id', $ids)->get();
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $role = $this->first($id);
            if (auth()->user()->roles->contains($role)) {
                throw new \Exception('Delete is not possible.');
            }
            return $role->delete();
        });
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
