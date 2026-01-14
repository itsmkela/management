<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
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
        .btn-primary:hover:not(.loading) {
            background-color: #0099cc;
        }
        .btn-primary.loading {
            background-color: #0099cc;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* FULL-SCREEN LOADER – HIDDEN BY DEFAULT */
        #fullLoader {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: #fff;
            z-index: 9999;
            display: none;   /* Hidden on load & back button */
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            font-family: 'Segoe UI', sans-serif;
        }

        .loader-book {
            width: 120px;
            height: 150px;
            position: relative;
        }
        .book-page {
            position: absolute;
            width: 100%; height: 100%;
            background: #003087;
            border-radius: 8px;
            transform-origin: left center;
            animation: flip 1.6s infinite;
        }
        .book-page:nth-child(2) { animation-delay: .2s; background: #0055d4; }
        .book-page:nth-child(3) { animation-delay: .4s; background: #007bff; }
        @keyframes flip {
            0%   { transform: rotateY(0deg); }
            50%  { transform: rotateY(-180deg); }
            100% { transform: rotateY(-360deg); }
        }

        .forgot-password, .register-link {
            font-size: 15px;
            color: #000;
            text-decoration: none;
        }
        .forgot-password:hover, .register-link a:hover {
            color: #00aaff;
            text-decoration: none;
        }

        .email-icon::before { content: "📧"; font-size: 18px; }
        .password-icon::before { content: "🔒"; font-size: 18px; }
        .unlock-icon::before { content: "🔓"; font-size: 18px; }
    </style>
</head>
<body>

    <!-- YOUR ORIGINAL LOGIN FORM -->
    <div class="login-container">
        <img src="{{ asset('images/mkela.png') }}" alt="Mkela Logo" class="logo">

        <h2>STUDENT LOGIN</h2>

        @if (session('status'))
            <div class="alert alert-success" style="margin-bottom: 20px; font-size: 14px;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('email') || $errors->has('password'))
            <div class="alert alert-danger" style="margin-bottom: 20px; font-size: 14px;">
                {{ $errors->first('email') }} {{ $errors->first('password') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
            @csrf
            <div class="mb-3 input-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <span class="toggle-icon email-icon"></span>
            </div>
            <div class="mb-3 input-group">
                <input type="password" id="passwordField" class="form-control" name="password" placeholder="Password" required>
                <span class="toggle-icon password-icon" id="togglePassword" onclick="togglePassword()"></span>
            </div>
            <a href="{{ route('password') }}" class="forgot-password">Forgot Password?</a>
            <button type="submit" class="btn btn-primary mt-3" id="submitBtn">
                <span class="btn-text">Sign In</span>
            </button>
            <p class="register-link mt-3">If you have no account, <a href="{{ route('register') }}" class="forgot-password">Register</a></p>
        </form>
    </div>

    <!-- FULL-SCREEN LOADER (NO TEXT) -->
    <div id="fullLoader">
        <div class="loader-book">
            <div class="book-page"></div>
            <div class="book-page"></div>
            <div class="book-page"></div>
        </div>
        <!-- TEXT REMOVED AS REQUESTED -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password
        function togglePassword() {
            const field = document.getElementById("passwordField");
            const icon = document.getElementById("togglePassword");
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove("password-icon");
                icon.classList.add("unlock-icon");
            } else {
                field.type = "password";
                icon.classList.remove("unlock-icon");
                icon.classList.add("password-icon");
            }
        }

        // SHOW LOADER ON SUBMIT
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const loader = document.getElementById('fullLoader');

            if (submitBtn.classList.contains('loading')) {
                e.preventDefault();
                return;
            }

            submitBtn.classList.add('loading');
            btnText.textContent = 'Processing...';
            loader.style.display = 'flex';  // NOW IT APPEARS
        });

        // FIX BACK BUTTON (bfcache)
        window.addEventListener('pageshow', function(e) {
            if (e.persisted) {
                document.getElementById('fullLoader').style.display = 'none';
            }
        });
    </script>
</body>
</html>