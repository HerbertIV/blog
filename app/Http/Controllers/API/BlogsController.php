<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Services\Contracts\BlogServiceContract;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function __construct(
        private BlogServiceContract $blogService
    ) {
    }

    public function index(Request $request)
    {
        return BlogResource::collection($this->blogService->paginate());
    }
}
