<?php

namespace App\Dtos;

class ResetPasswordAdminDto extends BaseDto
{
    protected string $token;
    protected string $password;

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    protected function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
