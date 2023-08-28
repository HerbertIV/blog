<?php

namespace App\Providers;

use App\Services\AppHeaderService;
use App\Services\AsyncService;
use App\Services\Contracts\AppHeaderServiceContract;
use App\Services\Contracts\AsyncServiceContract;
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
        AppHeaderServiceContract::class     => AppHeaderService::class,
        RoleServiceContract::class          => RoleService::class,
        PermissionServiceContract::class    => PermissionService::class,
    ];
}
