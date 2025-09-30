<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login & Register - GIS Core</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5f8d;
            --secondary-color: #4a90c7;
            --accent-color: #00a86b;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            display: flex;
            min-height: 600px;
        }

        .auth-side {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-side.left {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .auth-side.left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .auth-side.left .content {
            position: relative;
            z-index: 1;
        }

        .auth-side.left h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .auth-side.left p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.7;
        }

        .auth-side.right {
            background: white;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #666;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 199, 0.25);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .alert {
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 1rem;
        }

        .btn-auth {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .btn-primary-custom:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(74, 144, 199, 0.4);
        }

        .btn-primary-custom:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #999;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }

        .divider span {
            padding: 0 10px;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 1rem;
        }

        .btn-social {
            flex: 1;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-social:hover {
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .toggle-form {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .toggle-form a {
            color: var(--secondary-color);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .toggle-form a:hover {
            text-decoration: underline;
        }

        .form-check-label {
            color: #666;
            font-size: 0.9rem;
        }

        .hidden {
            display: none;
        }

        .icon-placeholder {
            width: 20px;
            height: 20px;
            display: inline-block;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }

            .auth-side.left {
                padding: 40px 30px;
                min-height: 250px;
            }

            .auth-side.left h2 {
                font-size: 1.8rem;
            }

            .auth-side.right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Left Side - Branding -->
        <div class="auth-side left">
            <div class="content">
                <h2>Welcome to GIS Core</h2>
                <p>Access powerful geographic intelligence tools and transform your spatial data into actionable insights.</p>
            </div>
        </div>

        <!-- Right Side - Forms -->
        <div class="auth-side right">
            <!-- Login Form -->
            <div id="loginForm">
                <h1 class="form-title">Login</h1>
                <p class="form-subtitle">Welcome back! Please login to your account.</p>

                <div id="loginAlert"></div>

                <form id="loginFormElement">
                    @csrf
                    <div class="form-group">
                        <label for="loginEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your email" required>
                        <div class="invalid-feedback" id="loginEmailError"></div>
                    </div>

                    <div class="form-group">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required>
                        <div class="invalid-feedback" id="loginPasswordError"></div>
                    </div>

                    <div class="form-group d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" style="color: var(--secondary-color); text-decoration: none; font-size: 0.9rem;">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-auth btn-primary-custom" id="loginBtn">
                        Login
                    </button>
                </form>

                <div class="divider">
                    <span>OR</span>
                </div>

                <div class="social-login">
                    <button class="btn-social">
                        <span class="icon-placeholder">G</span> Google
                    </button>
                    <button class="btn-social">
                        <span class="icon-placeholder">M</span> Microsoft
                    </button>
                </div>

                <div class="toggle-form">
                    Don't have an account? <a onclick="toggleForms()">Register here</a>
                </div>
            </div>

            <!-- Register Form -->
            <div id="registerForm" class="hidden">
                <h1 class="form-title">Register</h1>
                <p class="form-subtitle">Create your account to get started.</p>

                <div id="registerAlert"></div>

                <form id="registerFormElement">
                    @csrf
                    <div class="form-group">
                        <label for="registerName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="registerName" name="name" placeholder="Enter your full name" required>
                        <div class="invalid-feedback" id="registerNameError"></div>
                    </div>

                    <div class="form-group">
                        <label for="registerEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Enter your email" required>
                        <div class="invalid-feedback" id="registerEmailError"></div>
                    </div>

                    <div class="form-group">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Create a password" required>
                        <div class="invalid-feedback" id="registerPasswordError"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password" required>
                        <div class="invalid-feedback" id="confirmPasswordError"></div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                I agree to the <a href="#" style="color: var(--secondary-color);">Terms & Conditions</a>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth btn-primary-custom" id="registerBtn">
                        Create Account
                    </button>
                </form>

                <div class="divider">
                    <span>OR</span>
                </div>

                <div class="social-login">
                    <button class="btn-social">
                        <span class="icon-placeholder">G</span> Google
                    </button>
                    <button class="btn-social">
                        <span class="icon-placeholder">M</span> Microsoft
                    </button>
                </div>

                <div class="toggle-form">
                    Already have an account? <a onclick="toggleForms()">Login here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle between login and register forms
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            
            loginForm.classList.toggle('hidden');
            registerForm.classList.toggle('hidden');

            // Clear alerts and errors
            clearErrors();
        }

        // Clear all error messages
        function clearErrors() {
            document.querySelectorAll('.form-control').forEach(input => {
                input.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(error => {
                error.textContent = '';
                error.style.display = 'none';
            });
            document.getElementById('loginAlert').innerHTML = '';
            document.getElementById('registerAlert').innerHTML = '';
        }

        // Show alert message
        function showAlert(elementId, message, type = 'danger') {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            document.getElementById(elementId).innerHTML = alertHtml;
        }

        // Handle login form submission
        document.getElementById('loginFormElement').addEventListener('submit', async function(e) {
            e.preventDefault();
            clearErrors();

            const btn = document.getElementById('loginBtn');
            const btnText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Logging in...';

            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const response = await fetch('{{ url("/doLogin") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    showAlert('loginAlert', data.message, 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    if (data.errors) {
                        // Show validation errors
                        Object.keys(data.errors).forEach(key => {
                            const input = document.getElementById(`login${key.charAt(0).toUpperCase() + key.slice(1)}`);
                            const error = document.getElementById(`login${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                            if (input && error) {
                                input.classList.add('is-invalid');
                                error.textContent = data.errors[key][0];
                                error.style.display = 'block';
                            }
                        });
                    } else {
                        showAlert('loginAlert', data.message);
                    }
                    btn.disabled = false;
                    btn.innerHTML = btnText;
                }
            } catch (error) {
                showAlert('loginAlert', 'An error occurred. Please try again.');
                btn.disabled = false;
                btn.innerHTML = btnText;
            }
        });

        // Handle register form submission
        document.getElementById('registerFormElement').addEventListener('submit', async function(e) {
            e.preventDefault();
            clearErrors();

            const btn = document.getElementById('registerBtn');
            const btnText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creating Account...';

            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const response = await fetch('{{ url("/doRegister") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    showAlert('registerAlert', data.message, 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    if (data.errors) {
                        // Show validation errors
                        Object.keys(data.errors).forEach(key => {
                            const fieldName = key === 'password_confirmation' ? 'confirmPassword' : `register${key.charAt(0).toUpperCase() + key.slice(1)}`;
                            const input = document.getElementById(fieldName);
                            const error = document.getElementById(`${fieldName}Error`);
                            if (input && error) {
                                input.classList.add('is-invalid');
                                error.textContent = data.errors[key][0];
                                error.style.display = 'block';
                            }
                        });
                    } else {
                        showAlert('registerAlert', data.message);
                    }
                    btn.disabled = false;
                    btn.innerHTML = btnText;
                }
            } catch (error) {
                showAlert('registerAlert', 'An error occurred. Please try again.');
                btn.disabled = false;
                btn.innerHTML = btnText;
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>