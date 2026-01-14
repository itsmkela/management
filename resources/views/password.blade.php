<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Mkela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .forgot-container {
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
            cursor: default;
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
        .email-icon::before {
            content: "📧";
            font-size: 18px;
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
    <div class="forgot-container">
        <img src="{{ asset('images/mkela.png') }}" alt="Mkela Logo" class="logo">

        <h2>FORGOT PASSWORD</h2>

        <p style="font-size:14px; color:#555; margin-bottom:20px;">
            Enter your email address and we'll send you a link to reset your password.
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Field -->
            <div class="mb-3 input-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <span class="toggle-icon email-icon"></span>
            </div>

            <!-- Validation Errors -->
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
                Send Reset Link
            </button>

            <p class="login-link mt-3">
                <a href="{{ route('login') }}">Back to Sign In</a>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>