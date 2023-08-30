<?php

namespace App\Providers;

use App\Services\AdminService;
use App\Services\AsyncService;
use App\Services\BlogService;
use App\Services\Contracts\AdminServiceContract;
use App\Services\Contracts\AsyncServiceContract;
use App\Services\Contracts\BlogServiceContract;
use App\Services\Contracts\PermissionServiceContract;
use App\Services\Contracts\RoleServiceContract;
use App\Services\Contracts\TemplateEventServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\TemplateEventService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public $singletons = [
        AsyncServiceContract::class         => AsyncService::class,
        UserServiceContract::class          => UserService::class,
        TemplateEventServiceContract::class => TemplateEventService::class,
        RoleServiceContract::class          => RoleService::class,
        PermissionServiceContract::class    => PermissionService::class,
        AdminServiceContract::class         => AdminService::class,
        BlogServiceContract::class          => BlogService::class,
    ];
}
