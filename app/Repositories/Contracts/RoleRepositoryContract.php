<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface RoleRepositoryContract extends BaseRepositoryContract
{
    public function search(string $term = ''): Builder;
}
