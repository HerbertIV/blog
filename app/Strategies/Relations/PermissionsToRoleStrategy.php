<?php

namespace App\Strategies\Relations;

use App\Services\Contracts\RoleServiceContract;
use App\Strategies\Contracts\RelationStrategyContract;

class PermissionsToRoleStrategy implements RelationStrategyContract
{
    private int $roleId;
    private array $permissions;
    private RoleServiceContract $roleService;

    public function __construct(array $relationsData)
    {
        $this->roleId = $relationsData['role_id'];
        $this->permissions = $relationsData['permissions'];
        $this->roleService = app(RoleServiceContract::class);
    }

    public function setRelation(): void
    {
        $this->roleService->setPermissionsToRole($this->roleId, $this->permissions);
    }
}
