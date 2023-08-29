<?php

namespace App\Services\Contracts;

use App\Dtos\AdminDto;
use App\Dtos\ResetPasswordAdminDto;
use App\Models\Admin;

interface AdminServiceContract
{
    public function create(AdminDto $adminDto): Admin;
    public function first(int $id): Admin;
    public function deleteMany(array $ids): bool;
    public function delete(int $id): bool;
    public function update(AdminDto $adminDto, int $id): bool;
    public function setRolesToUser(int $adminId, array $roles): void;
    public function resetPassword(ResetPasswordAdminDto $resetPasswordAdminDto): bool;
}
