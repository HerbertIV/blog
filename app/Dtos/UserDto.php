<?php

namespace App\Dtos;

class UserDto extends BaseDto
{
    /**
     * @return void
     */
    protected function setRoles(array $roles): void
    {
        $this->pushToRelations('RolesToUser', $roles);
    }
}
