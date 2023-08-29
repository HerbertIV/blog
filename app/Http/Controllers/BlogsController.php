<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Blog\NewsCreateRequest;
use App\Http\Requests\Blog\NewsDeleteRequest;
use App\Http\Requests\Blog\NewsEditRequest;
use App\Http\Requests\Blog\NewsShowRequest;
use App\Models\Blog;
use App\Services\Contracts\BlogServiceContract;
use Illuminate\View\View;

class BlogsController extends Controller
{
    public function __construct(
        private BlogServiceContract $blogService
    ) {
    }

    public function index(NewsShowRequest $request): View
    {
        return view('admin.pages.blog.index');
    }

    public function create(NewsCreateRequest $request): View
    {
        return view('admin.pages.blog.create');
    }

    public function show(NewsShowRequest $request, Blog $blog): View
    {
        return view('admin.pages.blog.show', ['blog' => $blog]);
    }

    public function edit(NewsEditRequest $request, Blog $blog): View
    {
        return view('admin.pages.blog.edit', ['blog' => $blog]);
    }

    public function destroy(NewsDeleteRequest $request, Blog $blog)
    {
        $this->blogService->delete($blog->getKey());
    }
}
