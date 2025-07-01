@extends('admin.layouts.auth')

@section('title', 'Login')

@section('content')

<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h2 class="text-center text-primary">Login</h2>
                    </div>

                    <!-- Add this error display div -->
                    <div id="loginError" class="alert alert-danger" style="display: none;"></div>

                    <form method="POST" action="{{ route('admin.doLogin') }}" id="loginForm">
                        @csrf

                        <div class="input-group custom">
                            <input id="email" type="email" class="form-control form-control-lg"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                            <span class="invalid-feedback" id="emailError" role="alert"></span>
                        </div>

                        <div class="input-group custom">
                            <input id="password" type="password" class="form-control form-control-lg"
                                   name="password" required autocomplete="current-password" placeholder="Password">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                            <span class="invalid-feedback" id="passwordError" role="alert"></span>
                        </div>

                        <div class="row pb-30">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                            {{-- <div class="col-6">
                                <div class="forgot-password">
                                    <a href="{{ route('admin.forgotPassword') }}">Forgot Password?</a>
                                </div>
                            </div> --}}
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Sign In
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailField = document.getElementById('email');
        if (emailField && !emailField.value) {
            emailField.focus();
        }

        // Handle form submission
        const loginForm = document.getElementById('loginForm');
        const loginError = document.getElementById('loginError');

        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Reset error states
            loginError.style.display = 'none';
            document.getElementById('emailError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('email').classList.remove('is-invalid');
            document.getElementById('password').classList.remove('is-invalid');

            try {
                const formData = new FormData(loginForm);
                formData.set('remember', document.getElementById('remember').checked ? 'on' : '');
                const response = await fetch(loginForm.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    // Handle errors
                    if (data.errors) {
                        // Field-specific errors
                        if (data.errors.email) {
                            document.getElementById('email').classList.add('is-invalid');
                            document.getElementById('emailError').textContent = data.errors.email[0];
                        }
                        if (data.errors.password) {
                            document.getElementById('password').classList.add('is-invalid');
                            document.getElementById('passwordError').textContent = data.errors.password[0];
                        }
                    } else if (data.message) {
                        // General error message
                        loginError.textContent = data.message;
                        loginError.style.display = 'block';
                    }
                } else {
                    // Successful login - redirect or handle as needed
                    window.location.href = data.redirect || '/admin/dashboard';
                }
            } catch (error) {
                console.error('Error:', error);
                loginError.textContent = 'An unexpected error occurred. Please try again.';
                loginError.style.display = 'block';
            }
        });
    });
</script>
@endpush
