<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('homepage') }}">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                @if (auth()->guard(\App\Enums\GuardEnums::WEB)->check())
                    <li class="nav-item">
                        <form method="POST" action="{{ route('blog-logout') }}">
                            @csrf
                            <a href="{{ route('blog-logout') }}" class="nav-link px-lg-3 py-3 py-lg-4" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('blog-login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('blog-register') }}">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
