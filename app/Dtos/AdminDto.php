<?php

namespace App\Dtos;

class AdminDto extends BaseDto
{
    protected string $email;
    protected string $name;

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
        ];
    }

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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return void
     */
    protected function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return void
     */
    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return void
     */
    protected function setRoles(array $roles): void
    {
        $this->pushToRelations('RolesToAdmin', $roles);
    }
}
