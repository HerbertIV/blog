<form id="contactForm" action="{{ route('blog-reset-password.store', ['token' => $token]) }}" method="POST">
    @csrf
    <div class="form-floating">
        <input class="form-control" name="password" id="password" type="password" placeholder="Enter your password...">
        <label for="password">Password</label>
        <div class="invalid-feedback" data-sb-feedback="password:required">A password is required.</div>
    </div>
    <div class="form-floating">
        <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="Enter your password confirm..." >
        <label for="password_confirmation">Password confirm</label>
        <div class="invalid-feedback" data-sb-feedback="password_confirmation:required">A password is required.</div>
    </div>
    <div class="d-flex justify-content-end mt-2">
        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Reset</button>
    </div>
</form>
