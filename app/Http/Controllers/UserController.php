<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\UserEditRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(UserShowRequest $request): View
    {
        return view('admin.pages.user.index');
    }

    public function show(UserShowRequest $request, User $user): View
    {
        return view('admin.pages.user.show', ['user' => $user]);
    }

    public function edit(UserEditRequest $request, User $user): View
    {
        return view('admin.pages.user.edit', ['user' => $user]);
    }
}
