<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow: hidden;
        }

        header {
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
        }
        
        .logo div {
            display: flex;
            align-items: center;
        }

        .logo strong {
            color: #000;
            font-size: 40px;
            margin-left: 8px;
            font-family: "Times New Roman", Times, serif;
            cursor: pointer;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
        }

        .forgot-container {
            width: 100%;
            max-width: 600px;
        }

        .forgot-card h2 {
            font-size: 46px;
            font-weight: normal;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            width: 100%;
            max-width: 400px;
            margin-bottom: 25px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: none;
            border-bottom: 1px solid #ccc;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            background-color: transparent;
        }

        .form-group input:hover {
            border-bottom: 1px solid #007BFF;
        }

        .form-group input:focus {
            border-bottom: 1px solid #007BFF;
            box-shadow: 0 2px 0 0 #04d2da; 
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 12px;
            color: #999;
        }

        .login-btn {
            background-color: #00243d;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .login-btn:hover {
            background-color: #003a5c;
        }

        .help-text {
            margin-top: 20px;
            font-size: 14px;
        }

        .help-text a {
            color: #007BFF;
            text-decoration: none;
        }

        .help-text a:hover {
            text-decoration: underline;
        }

        .alert {
            background-color: #dff0d8;
            color: #3c763d;
            border-radius: 4px;
            padding: 10px 15px;
            margin-bottom: 15px;
            border: 1px solid #d6e9c6;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            color: #000;
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #ddd;
            z-index: 1000; 
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .logo strong {
                font-size: 30px;
            }

            .forgot-card h2 {
                font-size: 36px;
            }

            .login-btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .logo strong {
                font-size: 24px;
            }

            .forgot-card h2 {
                font-size: 28px;
            }

            .login-btn {
                padding: 8px 16px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <style>
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .success_alert {
            position: fixed;
            top: -100px; 
            left: 50%;
            transform: translateX(-50%);
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border: 1px solid #c3e6cb;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: dropDown 0.5s ease-out forwards;
        }

        .error_alert {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border: 1px solid #f5c6cb;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: dropDown 0.5s ease-out forwards;
        }

        .error_alert.hide {
            animation: moveUp 0.5s ease-out forwards;
        }

        @keyframes dropDown {
            from {
                top: -100px;  
                opacity: 0;
            }
            to {
                top: 10px;  
                opacity: 1;
            }
        }

        .success_alert.hide {
            animation: moveUp 0.5s ease-out forwards;
        }

        @keyframes moveUp {
            from {
                top: 10px;
                opacity: 1;
            }
            to {
                top: -100px;
                opacity: 0;
            }
        }
    </style>
    @if(session('success'))
        <div id="success-alert" class="success_alert">
            <strong></strong> {{ session('success') }}
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let alertBox = document.querySelector(".success_alert");

                if (alertBox) {
                    setTimeout(() => {
                        alertBox.classList.add("hide");  
                    }, 3000);  
                }
            });
        </script>
    @endif

    @if(session('error'))
        <div id="error-alert" class="error_alert">
            <strong></strong> {{ session('error') }}
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let errorBox = document.querySelector(".error_alert");

                if (errorBox) {
                    setTimeout(() => {
                        errorBox.classList.add("hide");
                    }, 3000);
                }
            });
        </script>
    @endif
        
    <header>
        <div class="container">
            <div class="logo">
                <div>
                    <img src="{{ asset('img/logo.png') }}" alt="Navi Cargo Logo">
                    <strong onclick="window.location.href='{{ route('index') }}'">Navi Cargo</strong>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="forgot-container">
            <div class="forgot-card">
                <h2>Forgot Password</h2>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Enter your Email Address" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="login-btn">Send Verification Code</button>
                </form>

                <div class="help-text">
                    Remember your password? <a href="{{ route('login') }}">Log in</a>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Navi Cargo. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
