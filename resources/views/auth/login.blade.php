<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Literise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: #F5E6FF;
            overflow-x: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Decorative blob shapes */
        .blob {
            position: fixed;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            filter: blur(1px);
            z-index: 0;
        }

        .blob-purple-1 {
            width: 380px;
            height: 650px;
            background: linear-gradient(180deg, #5c1d8f 0%, #4a2e7c 100%);
            top: 0;
            left: 0;
            border-radius: 0 50% 50% 0;
        }

        .blob-purple-2 {
            width: 200px;
            height: 400px;
            background: #4a2e7c;
            top: 100px;
            left: 150px;
            opacity: 0.6;
        }

        .blob-light-1 {
            width: 450px;
            height: 500px;
            background: #E9D5FF;
            top: -50px;
            right: 300px;
            border-radius: 50% 0 0 50%;
        }

        .blob-light-2 {
            width: 350px;
            height: 400px;
            background: #DDD6FE;
            bottom: 0;
            right: 0;
            border-radius: 50% 0 0 0;
        }

        .blob-light-3 {
            width: 400px;
            height: 350px;
            background: #F3E8FF;
            bottom: 150px;
            right: 200px;
            opacity: 0.8;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            min-height: auto;
            position: relative;
            z-index: 1;
            align-items: center;
            justify-content: center;
        }

        .left-section {
            flex: 0 0 45%;
            position: relative;
            height: 100%;
        }

        .right-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            height: 100%;
        }

        .login-box {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #4a2e7c;
            margin-bottom: 10px;
        }

        h1 {
            font-size: clamp(1.8rem, 5vw, 2.5rem);
            color: #4a2e7c;
            margin-bottom: 25px;
            font-weight: 700;
            letter-spacing: -1px;
            line-height: 1.1;
            text-align: center;
        }

        .account-check {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .account-check span {
            color: #4a2e7c;
            font-size: clamp(0.9rem, 2.5vw, 1.1rem);
            font-weight: 500;
        }

        .account-check .register-btn {
            background: #4a2e7c;
            color: white;
            border: none;
            padding: 12px 35px;
            border-radius: 30px;
            font-size: clamp(0.85rem, 2vw, 1rem);
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .account-check .register-btn:hover {
            background: #5c1d8f;
            transform: scale(1.05);
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a2e7c;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .input-group input {
            width: 100%;
            padding: 16px 0;
            background: transparent;
            border: none;
            border-bottom: 3px solid #4a2e7c;
            font-size: clamp(0.95rem, 2.5vw, 1.1rem);
            color: #4a2e7c;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-group input::placeholder {
            color: #8B5CF6;
            font-weight: 400;
            opacity: 0.7;
        }

        .input-group input:focus {
            border-bottom-color: #5c1d8f;
        }

        .password-wrapper {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
        }

        .eye-icon svg {
            width: 100%;
            height: 100%;
            stroke: #4a2e7c;
            fill: none;
            stroke-width: 2;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            accent-color: #4a2e7c;
        }

        .remember-me label {
            color: #4a2e7c;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background: #4a2e7c;
            color: white;
            border: none;
            border-radius: 60px;
            font-size: clamp(1rem, 2.5vw, 1.3rem);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #5c1d8f;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(74, 46, 124, 0.4);
        }

        .error-message {
            color: #e53e3e;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }

        .error-container {
            background: rgba(254, 215, 215, 0.9);
            border-left: 4px solid #e53e3e;
            color: #742a2a;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-container ul {
            margin-left: 20px;
            margin-top: 5px;
        }

        .error-container li {
            margin-bottom: 3px;
        }

        /* Decorative blobs in background */
        .decorative-bottom {
            position: fixed;
            width: 800px;
            height: 600px;
            background: #8B5CF6;
            border-radius: 50%;
            bottom: -300px;
            right: -200px;
            opacity: 0.5;
            z-index: -1;
        }

        /* Mobile-specific adjustments */
        @media (max-width: 1024px) {
            body {
                padding: 15px;
                align-items: center;
                justify-content: center;
            }

            .container {
                flex-direction: column;
                min-height: auto;
                max-width: 600px;
                margin: 0 auto;
            }

            .left-section {
                flex: 0 0 80px;
                min-height: 80px;
                width: 100%;
            }

            .right-section {
                padding: 20px;
                width: 100%;
                align-items: center;
                justify-content: center;
            }

            .login-box {
                padding: 30px 25px;
                margin: 0 auto;
                max-width: 480px;
            }

            .blob-purple-1 {
                width: 250px;
                height: 400px;
            }

            .blob-light-1 {
                width: 300px;
                height: 350px;
                top: 50px;
                right: 50px;
            }

            .blob-purple-2, .blob-light-2, .blob-light-3 {
                display: none;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }

            .container {
                width: 100%;
                max-width: 500px;
            }

            .left-section {
                flex: 0 0 60px;
                min-height: 60px;
            }

            .login-box {
                width: 100%;
                padding: 25px 20px;
                max-width: 100%;
            }

            .account-check {
                flex-direction: column;
                align-items: center;
                gap: 15px;
                margin-bottom: 25px;
            }

            .account-check .register-btn {
                width: 100%;
                max-width: 200px;
            }

            .input-group {
                margin-bottom: 20px;
            }

            .input-group input {
                padding: 14px 0;
            }

            .submit-btn {
                padding: 16px;
            }

            .decorative-bottom {
                width: 500px;
                height: 400px;
                bottom: -200px;
                right: -150px;
            }

            .blob-purple-1 {
                width: 200px;
                height: 300px;
            }

            .blob-light-1 {
                width: 250px;
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
                background: linear-gradient(135deg, #5c1d8f 0%, #4a2e7c 100%);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .container {
                width: 100%;
                max-width: 100%;
                min-height: auto;
                margin: 0;
            }

            .left-section {
                display: none;
            }

            .right-section {
                padding: 0;
                width: 100%;
                align-items: center;
                justify-content: center;
            }

            .login-box {
                padding: 25px 20px;
                width: 100%;
                max-width: 100%;
                background: rgba(255, 255, 255, 0.95);
                margin: 0;
            }

            h1 {
                margin-bottom: 20px;
                font-size: 1.8rem;
            }

            .account-check {
                margin-bottom: 20px;
            }

            .input-group {
                margin-bottom: 15px;
            }

            .input-group input {
                padding: 14px 0;
                font-size: 1rem;
            }

            .submit-btn {
                margin-top: 10px;
                padding: 16px;
                font-size: 1.1rem;
            }

            .decorative-bottom {
                display: none;
            }

            .blob-purple-1, .blob-light-1 {
                display: none;
            }

            .logo {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 360px) {
            body {
                padding: 10px;
            }

            .login-box {
                padding: 20px 15px;
            }

            h1 {
                font-size: 1.6rem;
            }

            .account-check span {
                font-size: 0.9rem;
            }

            .input-group label {
                font-size: 0.9rem;
            }

            .input-group input {
                font-size: 0.95rem;
            }
        }

        /* Animation for smooth transitions */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-box {
            animation: fadeIn 0.8s ease-out;
        }

        /* Focus styles for accessibility */
        button:focus, input:focus {
            outline: 2px solid #5c1d8f;
            outline-offset: 2px;
        }

        /* Loading state for form submission */
        .submit-btn.loading {
            pointer-events: none;
            opacity: 0.7;
            position: relative;
        }

        .submit-btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-right-color: transparent;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Fix for error container */
        #errorContainer {
            display: block !important;
        }

        .hidden-error {
            display: none !important;
        }
    </style>
</head>
<body>
    <!-- Background blobs -->
    <div class="blob blob-purple-1"></div>
    <div class="blob blob-purple-2"></div>
    <div class="blob blob-light-1"></div>
    <div class="blob blob-light-2"></div>
    <div class="blob blob-light-3"></div>

    <div class="container">
        <div class="left-section">
            <!-- This section is intentionally left empty for design purposes -->
        </div>

        <div class="right-section">
            <div class="login-box">
                <div class="logo">LITERISE</div>
                <h1>Masuk ke Akun Anda</h1>

                <!-- Menampilkan Error Validasi Laravel -->
                @if ($errors->any())
                    <div class="error-container" id="serverErrorContainer">
                        <p class="font-bold">Error</p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Error container for client-side validation -->
                <div class="error-container hidden-error" id="clientErrorContainer">
                    <p class="font-bold">Error</p>
                    <ul id="errorList"></ul>
                </div>

                <div class="account-check">
                    <span>Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="register-btn">
                        Daftar di sini
                    </a>
                </div>

                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan alamat email" required value="{{ old('email') }}">
                        <div class="error-message" id="emailError"></div>
                    </div>

                    <div class="input-group password-wrapper">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        <button type="button" class="eye-icon" onclick="togglePassword('password')" tabindex="0" aria-label="Toggle password visibility">
                            <svg viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                        <div class="error-message" id="passwordError"></div>
                    </div>

                    <div class="remember-me">
                        <input id="remember" name="remember" type="checkbox">
                        <label for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="submit-btn">Masuk</button>
                </form>
            </div>
        </div>
    </div>
    <div class="decorative-bottom"></div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeIcon = passwordInput.parentNode.querySelector('.eye-icon svg');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }

        // Form validation and submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // Reset error messages
            resetErrors();

            // Get form values
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            let isValid = true;
            const errors = [];

            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError('emailError', 'Format email tidak valid');
                isValid = false;
                errors.push('Format email tidak valid');
            }

            // Validate password
            if (password.length < 1) {
                showError('passwordError', 'Password harus diisi');
                isValid = false;
                errors.push('Password harus diisi');
            }

            if (!isValid) {
                // Show error container with all errors
                if (errors.length > 0) {
                    const errorList = document.getElementById('errorList');
                    errorList.innerHTML = '';
                    errors.forEach(error => {
                        const li = document.createElement('li');
                        li.textContent = error;
                        errorList.appendChild(li);
                    });
                    document.getElementById('clientErrorContainer').classList.remove('hidden-error');
                }
                e.preventDefault();
                return;
            }

            // If valid, show loading state
            const submitBtn = this.querySelector('.submit-btn');
            submitBtn.classList.add('loading');

            // Allow form to submit normally if validation passes
            // Remove loading class after a short delay to show the loading state
            setTimeout(() => {
                submitBtn.classList.remove('loading');
            }, 1000);
        });

        // Helper functions for error handling
        function showError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }

        function resetErrors() {
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(element => {
                element.style.display = 'none';
                element.textContent = '';
            });

            const clientErrorContainer = document.getElementById('clientErrorContainer');
            if (clientErrorContainer) {
                clientErrorContainer.classList.add('hidden-error');
            }
        }

        // Add keyboard accessibility for password toggle
        document.querySelectorAll('.eye-icon').forEach(icon => {
            icon.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const fieldId = this.parentNode.querySelector('input').id;
                    togglePassword(fieldId);
                }
            });
        });

        // Auto-hide server errors after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const serverErrorContainer = document.getElementById('serverErrorContainer');
            if (serverErrorContainer) {
                setTimeout(() => {
                    serverErrorContainer.style.opacity = '0';
                    serverErrorContainer.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        serverErrorContainer.style.display = 'none';
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>
</html>
