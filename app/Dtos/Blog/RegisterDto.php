<?php

namespace App\Dtos\Blog;

use App\Dtos\BaseDto;
use App\Repositories\Contracts\RoleRepositoryContract;
use Illuminate\Support\Facades\Hash;

class RegisterDto extends BaseDto
{
    protected string $email;
    protected string $password;

    public function toArray(): array
    {
        return [
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return Hash::make($this->password);
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
    protected function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return void
     */
    public function setRoles(): void
    {
        $roleRepository = app(RoleRepositoryContract::class);
        $role = $roleRepository->where(['name' => 'user'])->first();
        $this->pushToRelations('RolesToUser', [
            $role->getKey()
        ]);
    }
}
