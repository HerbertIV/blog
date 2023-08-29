<form id="contactForm" action="{{ route('blog-reset-password-init.store') }}" method="POST">
    @csrf
    <div class="form-floating">
        <input class="form-control" name="email" id="email" type="text" placeholder="Enter your email..." >
        <label for="email">Email</label>
        <div class="invalid-feedback" data-sb-feedback="email:required">A email is required.</div>
    </div>
    <div class="d-flex justify-content-end mt-2">
        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Start reset</button>
    </div>
</form>
