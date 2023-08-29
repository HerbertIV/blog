<?php

namespace App\Services\Contracts;

use App\Dtos\NewsDto;
use App\Models\Blog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BlogServiceContract
{
    public function create(NewsDto $newsDto): Blog;
    public function first(int $id): Blog;
    public function get(array $ids): Collection;
    public function delete(int $id): bool;
    public function update(NewsDto $newsDto, int $id): bool;
    public function paginate(): LengthAwarePaginator;
}
