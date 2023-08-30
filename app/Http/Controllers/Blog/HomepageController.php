<?php

namespace App\Http\Controllers\Blog;

use App\Enums\LimitEnums;
use App\Http\Controllers\Controller;
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
            'blogs' => $this->blogService->paginate(LimitEnums::PAGE_HOMEPAGE)
        ]);
    }
}
