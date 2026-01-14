<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
            background-color: #f9f1e7;
        }
        .logo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: 0 auto 20px;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 0;
            background: transparent;
            padding-right: 30px;
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
        }
        .btn-primary {
            background-color: #000;
            border: none;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0099cc;
        }
        .login-link  {
            font-size: 15px;
            color: #000;
            text-decoration: none;
        }
        .login-link a:hover {
            color: #00aaff;
            text-decoration: none;
        }
        .name-icon::before   { content: "👤"; font-size: 18px; }
        .email-icon::before  { content: "📧"; font-size: 18px; }
        .password-icon::before { content: "🔒"; font-size: 18px; }
        .unlock-icon::before { content: "🔓"; font-size: 18px; }
    </style>
</head>
<body>
    <div class="register-container">
        <img src="{{ asset('images/mkela.png') }}" alt="Mkela Logo" class="logo">

        <h2>STUDENT REGISTRATION</h2>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <!-- Full Name -->
            <div class="mb-3 input-group">
                <input type="text" class="form-control" name="name" placeholder="Full name" value="{{ old('name') }}" required>
                <span class="toggle-icon name-icon"></span>
            </div>

            <!-- Email -->
            <div class="mb-3 input-group">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <span class="toggle-icon email-icon"></span>
            </div>

            <!-- Password -->
            <div class="mb-3 input-group">
                <input type="password" id="passwordField" class="form-control" name="password" placeholder="Password" required>
                <span class="toggle-icon password-icon" id="togglePassword" onclick="togglePassword()"></span>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3 input-group">
                <input type="password" id="confirmPasswordField" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                <span class="toggle-icon password-icon" id="toggleConfirm" onclick="toggleConfirm()"></span>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary mt-3">Register</button>

            <p class="login-link mt-3">
                If you already have an account, <a href="{{ route('login') }}" class="login-link mt-3">Sign in</a>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        function togglePassword() {
            const field = document.getElementById('passwordField');
            const icon  = document.getElementById('togglePassword');
            toggleField(field, icon);
        }

        // Toggle confirm-password visibility
        function toggleConfirm() {
            const field = document.getElementById('confirmPasswordField');
            const icon  = document.getElementById('toggleConfirm');
            toggleField(field, icon);
        }

        function toggleField(field, icon) {
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('password-icon');
                icon.classList.add('unlock-icon');
            } else {
                field.type = 'password';
                icon.classList.remove('unlock-icon');
                icon.classList.add('password-icon');
            }
        }
    </script>
</body>
</html>