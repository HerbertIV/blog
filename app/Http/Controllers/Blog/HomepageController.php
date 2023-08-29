<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Services\Contracts\BlogServiceContract;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function __construct(
        private BlogServiceContract $blogService
    ) {
    }

    public function render(Request $request)
    {
        return view('blog.pages.homepage', [
            'blogs' => BlogResource::collection($this->blogService->paginate())
        ]);
    }
}
