<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\Contracts\AdminRepositoryContract;

class AdminRepository extends BaseRepository implements AdminRepositoryContract
{
    public function model(): string
    {
        return Admin::class;
    }
}
