<?php

namespace App\Strategies\Relations;

use App\Services\Contracts\AdminServiceContract;
use App\Strategies\Contracts\RelationStrategyContract;

class RolesToAdminStrategy implements RelationStrategyContract
{
    private int $adminId;
    private array $roles;
    private AdminServiceContract $adminService;

    public function __construct(array $relationsData)
    {
        $this->adminId = $relationsData['admin_id'];
        $this->roles = $relationsData['roles'];
        $this->adminService = app(AdminServiceContract::class);
    }

    public function setRelation(): void
    {
        $this->adminService->setRolesToUser($this->adminId, $this->roles);
    }
}
