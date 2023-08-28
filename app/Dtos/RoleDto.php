<?php

namespace App\Dtos;

class RoleDto extends BaseDto
{
    protected string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
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
