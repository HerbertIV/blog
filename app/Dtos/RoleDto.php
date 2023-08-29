<?php

namespace App\Dtos;

class RoleDto extends BaseDto
{
    protected string $name;
    protected string $guardName;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @return string
     */
    public function getGuardName(): string
    {
        return $this->guardName;
    }

    /**
     * @param string $name
     */
    protected function setName(string $name): void
    {
        $this->name = $name;
    }
    /**
     * @param string $guard
     */
    protected function setGuardName(string $guardName): void
    {
        $this->guardName = $guardName;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'guard_name' => $this->getGuardName(),
        ];
    }

    /**
     * @return void
     */
    protected function setPermissions(array $permissions): void
    {
        $this->pushToRelations('PermissionsToRole', $permissions);
    }
}
