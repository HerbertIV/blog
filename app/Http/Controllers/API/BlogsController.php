<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Services\Contracts\BlogServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogsController extends Controller
{
    public function __construct(
        private BlogServiceContract $blogService
    ) {
    }

    public function index(Request $request): JsonResource
    {
        return BlogResource::collection($this->blogService->paginate());
    }

    public function show(Request $request, Blog $blog): JsonResource
    {
        return BlogResource::make($blog);
    }
}
