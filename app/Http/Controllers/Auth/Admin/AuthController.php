<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Dtos\ResetPasswordAdminDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Contracts\AdminServiceContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private AdminServiceContract $adminService
    ) {
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function resetPasswordRender(string $token)
    {
        return view('admin.auth.resetPassword', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $resetPasswordRequest, string $token)
    {
        $resetPasswordAdminDto = new ResetPasswordAdminDto([...$resetPasswordRequest->all(), ...['token' => $token]]);
        if ($this->adminService->resetPassword($resetPasswordAdminDto)) {
            Session::flash('success', 'Reset password is successful');
        } else {
            Session::flash('error', 'Reset password is error');
        }

        return redirect()->route('admin-login');
    }
}
