<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface PermissionRepositoryContract extends BaseRepositoryContract
{
    public function getWhereActions(array $actions = []): Builder;
    public function search(string $term = ''): Builder;
}
