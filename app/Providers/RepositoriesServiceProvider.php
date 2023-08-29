<?php

namespace App\Providers;

use App\Repositories\AdminRepository;
use App\Repositories\BlogRepository;
use App\Repositories\Contracts\AdminRepositoryContract;
use App\Repositories\Contracts\BlogRepositoryContract;
use App\Repositories\Contracts\PermissionRepositoryContract;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Repositories\Contracts\TemplateRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public $singletons = [
        AdminRepositoryContract::class      => AdminRepository::class,
        UserRepositoryContract::class       => UserRepository::class,
        TemplateRepositoryContract::class   => TemplateRepository::class,
        PermissionRepositoryContract::class => PermissionRepository::class,
        RoleRepositoryContract::class       => RoleRepository::class,
        BlogRepositoryContract::class       => BlogRepository::class
    ];
}
