<?php

namespace App\Http\Controllers\Auth\Blog;

use App\Dtos\Blog\RegisterDto;
use App\Dtos\ResetPasswordAdminDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginBlogRequest;
use App\Http\Requests\Auth\RegisterBlogRequest;
use App\Http\Requests\Auth\ResetPasswordInitRequest;
use App\Http\Requests\Auth\ResetUserPasswordRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private UserServiceContract $userService
    ) {
    }

    /**
     * Display the login view.
     */
    public function renderLogin(): View
    {
        return view('blog.auth.login', ['title' => 'Login']);
    }

    /**
     * Display the login view.
     */
    public function renderRegister(): View
    {
        return view('blog.auth.register', ['title' => 'Register']);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginBlogRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::BLOG);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function register(RegisterBlogRequest $request): RedirectResponse
    {
        $registerDto = new RegisterDto($request->all());
        return $this->userService->register($registerDto) ?
            redirect()->route('blog-login')
            : redirect()->back();
    }

    /**
     * Handle an incoming authentication request.
     */
    public function renderInitResetPassword(): View
    {
        return view('blog.auth.resetPasswordInit', ['title' => 'Reset Password']);
    }


    /**
     * Handle an incoming authentication request.
     */
    public function resetPasswordInit(ResetPasswordInitRequest $request): RedirectResponse
    {
        return $this->userService->resetPasswordStartProcess($request->email) ?
            redirect()->route('blog-login')
            : redirect()->back();
    }

    /**
     * Handle an incoming authentication request.
     */
    public function renderResetPassword(string $token): View
    {
        return view('blog.auth.resetPassword', [
            'title' => 'Reset Password',
            'token' => $token
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function resetPassword(ResetUserPasswordRequest $request, string $token): RedirectResponse
    {
        $resetPasswordAdminDto = new ResetPasswordAdminDto($request->all());
        $resetPasswordAdminDto->setToken($token);
        return $this->userService->resetPassword($resetPasswordAdminDto) ?
            redirect()->route('blog-login')
            : redirect()->back();
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('blog-login');
    }
}
