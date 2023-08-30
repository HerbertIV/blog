<?php

namespace App\Services;

use App\Dtos\NewsDto;
use App\Models\Blog;
use App\Repositories\Contracts\BlogRepositoryContract;
use App\Services\Contracts\BlogServiceContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BlogService implements BlogServiceContract
{
    public function __construct(
       private BlogRepositoryContract $blogRepository
    ) {
    }

    public function create(NewsDto $newsDto): Blog
    {
        return DB::transaction(function () use ($newsDto) {
            return $this->blogRepository->query()->create($newsDto->toArray());
        });
    }

    public function first(int $id): Blog
    {
        return $this->blogRepository->where(['id' => $id])->first();
    }

    public function get(array $ids): Collection
    {
        return $this->blogRepository->whereIn('id', $ids)->get();
    }

    public function delete(int $id): bool
    {
        return DB::transaction(fn () => $this->blogRepository->where(['id' => $id])->delete());
    }

    public function update(NewsDto $newsDto, int $id): bool
    {
        return DB::transaction(function () use ($newsDto, $id) {
            return $this->blogRepository->where(['id' => $id])->update($newsDto->toArray());
        });
    }

    public function paginate(?int $perPage = null, ?int $page = null): LengthAwarePaginator
    {
        return $this->blogRepository->query()->paginate($perPage, ['*'], 'page', $page);
    }
}
