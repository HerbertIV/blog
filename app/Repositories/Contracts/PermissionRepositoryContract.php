<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface PermissionRepositoryContract
{
    public function getWhereActions(array $actions = []): Builder;
}
