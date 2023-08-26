@php
$user = auth()->user();
@endphp

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        @if (\Illuminate\Support\Facades\Auth::check())
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-turbolinks="false" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
        @endif
        <h1 class="font-weight-bold text-2xl text-white">{{ config('app.name', 'Laravel') }}</h1>
    </form>
    @if (\Illuminate\Support\Facades\Auth::check())
        <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-turbolinks="false" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    @if (!is_null($user))
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ $user->name }}</div></a>
                @else
                    <div class="d-sm-none d-lg-inline-block">Hi, Welcome</div></a>
                @endif
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="/user/profile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    @if (request()->get('is_admin'))
                        <a href="/setting" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Setting
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('admin-logout') }}">
                        @csrf

                        <a href="{{ route('admin-logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    @endif
</nav>