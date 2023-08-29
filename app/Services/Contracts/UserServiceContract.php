<?php

namespace App\Services\Contracts;

use App\Dtos\Blog\RegisterDto;
use App\Dtos\ResetPasswordAdminDto;
use App\Dtos\UserDto;
use App\Models\User;

interface UserServiceContract
{
    public function first(int $id): User;
    public function deleteMany(array $ids): bool;
    public function delete(int $id): bool;
    public function update(UserDto $userDto, int $id): bool;
    public function setRolesToUser(int $userId, array $roles): void;
    public function register(RegisterDto $registerDto): bool;
    public function resetPassword(ResetPasswordAdminDto $resetPasswordAdminDto): bool;
    public function resetPasswordStartProcess(string $email): bool;
}
