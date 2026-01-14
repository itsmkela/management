<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Mkela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .reset-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
            background-color: #f9f1e7;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .logo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: 0 auto 20px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        h2 {
            font-weight: bold;
            color: #000;
            margin-bottom: 25px;
            font-size: 1.5rem;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 0;
            background: transparent;
            padding-right: 30px;
            font-size: 16px;
        }
        .form-control:focus {
            box-shadow: none;
            border-bottom: 2px solid #0099cc;
        }
        .input-group {
            position: relative;
            width: 100%;
        }
        .toggle-icon {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
        }
        .btn-primary {
            background-color: #000;
            border: none;
            width: 100%;
            padding: 12px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0099cc;
        }
        .login-link {
            font-size: 14px;
            color: #000;
            margin-top: 15px;
        }
        .login-link a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
        }
        .login-link a:hover {
            color: #00aaff;
            text-decoration: underline;
        }
        .alert {
            font-size: 14px;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <img src="{{ asset('images/mkela.png') }}" alt="Mkela Logo" class="logo">

        <h2>RESET PASSWORD</h2>

        <p style="font-size:14px; color:#555; margin-bottom:20px;">
            Enter your new password below.
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Hidden Email & Token -->
            <input type="hidden" name="token" value="{{ $token ?? 'abc123' }}">
            <input type="hidden" name="email" value="{{ request()->email ?? 'juma@mkela.ac.tz' }}">

            <!-- Email (Read-only) -->
            <div class="mb-3 input-group">
                <input type="email" class="form-control" value="{{ request()->email ?? 'juma@mkela.ac.tz' }}" placeholder="Email" disabled>
                <span class="toggle-icon">📧</span>
            </div>

            <!-- New Password -->
            <div class="mb-3 input-group">
                <input type="password" id="passwordField" class="form-control @error('password') is-invalid @enderror"
                       name="password" placeholder="New Password" required>
                <span class="toggle-icon" id="togglePassword" onclick="togglePassword()">🔒</span>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3 input-group">
                <input type="password" id="confirmPasswordField" class="form-control"
                       name="password_confirmation" placeholder="Confirm Password" required>
                <span class="toggle-icon" id="toggleConfirm" onclick="toggleConfirm()">🔒</span>
            </div>

            <!-- Validation Errors -->
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <!-- Success Message -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <button type="submit" class="btn btn-primary mt-3">
                Reset Password
            </button>

            <p class="login-link mt-3">
                <a href="{{ route('login') }}">Back to Sign In</a>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const field = document.getElementById('passwordField');
            const icon = document.getElementById('togglePassword');
            toggleField(field, icon);
        }

        function toggleConfirm() {
            const field = document.getElementById('confirmPasswordField');
            const icon = document.getElementById('toggleConfirm');
            toggleField(field, icon);
        }

        function toggleField(field, icon) {
            if (field.type === 'password') {
                field.type = 'text';
                icon.textContent = '🔓';
            } else {
                field.type = 'password';
                icon.textContent = '🔒';
            }
        }
    </script>
</body>
</html>