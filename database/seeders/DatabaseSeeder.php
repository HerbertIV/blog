<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryContract;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role as SpatieRole;

class DatabaseSeeder extends Seeder
{
    private Admin $userAdmin;
    private Admin $editor;


    public function __construct(
        private PermissionRepositoryContract $permissionRepository
    ) {
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->userAdmin = Admin::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret')
        ]);
        $this->editor = Admin::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('secret')
        ]);
        $this->call(PermissionSeeder::class);
        $this->setRoles();
    }

    private function setRoles(): void
    {
        $adminRole = Role::findOrCreate('admin');
        $editorRole = Role::findOrCreate('editor');
        Role::findOrCreate('user');
        $this->userAdmin->roles()->attach($adminRole->getKey());
        $this->editor->roles()->attach($editorRole->getKey());

        $permissions = $this->permissionRepository->query()->get();
        $adminRole->givePermissionTo($permissions->pluck('name'));

        $permissions = $this->permissionRepository->getWhereActions()->get();
        $adminRole->givePermissionTo($permissions->pluck('name'));
    }

}
