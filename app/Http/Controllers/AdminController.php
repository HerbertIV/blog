<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminCreateRequest;
use App\Http\Requests\Admin\AdminDeleteRequest;
use App\Http\Requests\Admin\AdminEditRequest;
use App\Http\Requests\Admin\AdminShowRequest;
use App\Models\Admin;
use App\Services\Contracts\AdminServiceContract;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        private AdminServiceContract $adminService
    ) {
    }

    public function index(AdminShowRequest $request): View
    {
        return view('admin.pages.admin.index');
    }

    public function create(AdminCreateRequest $request): View
    {
        return view('admin.pages.admin.create');
    }

    public function show(AdminShowRequest $request, Admin $admin): View
    {
        return view('admin.pages.admin.show', ['admin' => $admin]);
    }

    public function edit(AdminEditRequest $request, Admin $admin): View
    {
        return view('admin.pages.admin.edit', ['admin' => $admin]);
    }

    public function destroy(AdminDeleteRequest $request, Admin $admin)
    {
        $this->adminService->delete($admin->getKey());
    }
}
