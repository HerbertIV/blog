<?php

namespace App\Strategies\Relations;

use App\Services\Contracts\UserServiceContract;
use App\Strategies\Contracts\RelationStrategyContract;

class RolesToUserStrategy implements RelationStrategyContract
{
    private int $userId;
    private array $roles;
    private UserServiceContract $userService;

    public function __construct(array $relationsData)
    {
        $this->userId = $relationsData['user_id'];
        $this->roles = $relationsData['roles'];
        $this->userService = app(UserServiceContract::class);
    }

    public function setRelation(): void
    {
        $this->userService->setRolesToUser($this->userId, $this->roles);
    }
}
