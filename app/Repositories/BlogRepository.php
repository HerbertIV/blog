<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Repositories\Contracts\BlogRepositoryContract;

class BlogRepository extends BaseRepository implements BlogRepositoryContract
{
    public function model(): string
    {
        return Blog::class;
    }
}
