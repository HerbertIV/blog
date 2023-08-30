<form id="contactForm" action="{{ route('blog-register.store') }}" method="POST">
    @csrf
    <div class="form-floating">
        <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name..." >
        <label for="email">Name</label>
        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
    </div>
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
    <div class="form-floating">
        <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="Enter your password confirm..." >
        <label for="password_confirmation">Password confirm</label>
        <div class="invalid-feedback" data-sb-feedback="password_confirmation:required">A password is required.</div>
    </div>
    <div class="d-flex justify-content-end mt-2">
        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Register</button>
    </div>
</form>
