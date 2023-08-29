<form id="contactForm" action="{{ route('blog-login.store') }}" method="POST">
    @csrf
    <div class="form-floating">
        <input class="form-control" name="email" id="email" type="text" placeholder="Enter your email..." >
        <label for="email">Email</label>
        <div class="invalid-feedback" data-sb-feedback="email:required">A email is required.</div>
    </div>
    <div class="form-floating">
        <input class="form-control" name="password" id="password" type="password" placeholder="Enter your password...">
        <label for="password">Password</label>
        <div class="invalid-feedback" data-sb-feedback="password:required">A password is required.</div>
    </div>
    <div class="d-flex justify-content-end mt-2">
        <a href="{{ route('blog-reset-password-init') }}">Reset password</a>
        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Login</button>
    </div>
</form>
