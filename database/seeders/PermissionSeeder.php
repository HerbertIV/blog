<?php

namespace Database\Seeders;

use App\Enums\GuardEnums;
use App\Enums\PermissionEnums;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissionGroups = PermissionEnums::CRUD_PERMISSION_GROUP;
        foreach ($permissionGroups as $key => $permissionGroup) {
            foreach ($permissionGroup as $permission) {
                Permission::firstOrCreate([
                    'name' => $key . PermissionEnums::HYPHEN . $permission,
                    'guard_name' => GuardEnums::ADMIN,
                ]);
            }
        }
    }

}
