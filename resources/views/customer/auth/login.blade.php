
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
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
        min-height: 100vh; 
    }

    header {
        padding: 10px 0;
        border-bottom: 1px solid #e0e0e0;
        background: #fff;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        z-index: 1000;
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
        padding: 30px 30px;
        min-height: 100vh;
        box-sizing: border-box;
        padding-top: 90px;  
        padding-bottom: 90px;  
    }

    .login-container {
        width: 100%;
        max-width: 600px;
        display: flex;
        flex-direction: column;
        align-items: left; 
    }

    h1 {
        font-size: 46px;
        font-weight: normal;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        width: 100%;
        max-width: 400px;
        margin-bottom: 30px;
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
        margin-top: 0px;
        border-radius: 5px;
    }

    .login-btn:hover {
        background-color: #003a5c;
    }

    .help-text {
        margin: 10px 0;
        font-size: 14px;
    }

    .help-text a {
        color: #0078d4;
        text-decoration: none;
    }

    .help-text a:hover {
        text-decoration: underline;
    }

    .register-section {
        margin-top: 10px;
        border: 1px solid #e0e0e0;
        padding: 20px;
        width: 100%;
        max-width: 600px;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .register-section:hover {
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.15); 
    }

    .register-section h2 {
        font-size: 20px;
        margin-bottom: 15px;
        font-weight: normal;
    }

    .register-section p {
        margin-bottom: 20px;
        font-size: 14px;
    }

    .register-btn {
        background-color: white;
        color: #333;
        border: 1px solid #ccc;
        padding: 8px 20px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 2px;
    }

    .register-btn:hover {
        background-color: #f5f5f5;
    }
    .register-actions {
        display: flex;
        gap: 12px;
        margin-top: 10px;
    }
    .register-btn,
    .home-btn {
        background-color: white;
        color: #333;
        border: 1px solid #ccc;
        padding: 8px 20px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 2px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background 0.2s;
    }
    .register-btn:hover,
    .home-btn:hover {
        background-color: #f5f5f5;
    }
    .register-btn i,
    .home-btn i {
        margin-right: 6px;
        font-size: 1em;
        line-height: 1;
        vertical-align: middle;
        display: inline-block;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
 
    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100vw;
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
 
    @media (max-width: 700px) {
        main {
            padding: 20px 5vw;
            padding-top: 90px;
            padding-bottom: 90px;
        }
        .login-container, .register-section {
            max-width: 100vw;
        }
        h1 {
            font-size: 32px;
        }
    }
    @media (max-width: 480px) {
        main {
            padding: 10px 2vw;
            padding-top: 90px;
            padding-bottom: 90px;
        }
        .login-container, .register-section {
            max-width: 100vw;
        }
        h1 {
            font-size: 24px;
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
        <div class="login-container">
            <h1>Login</h1>
            
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter your Email Address" value="{{ old('email') }}">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                
                <button type="submit" class="login-btn">Log in</button>
            </form> 

            <div class="help-text">
                Need help with your <a href="{{ route('customer.auth.forgot-password') }}">password?</a>
            </div>
            
            <div class="register-section">
                <h2>Don't have an account?</h2>
                <p>Sign up here and start shipping with ease! We specialize in secure, reliable, and efficient deliveries between local ports, with a commitment to exceptional service every step of the way.</p>
                <div class="register-actions">
                    <a href="{{ route('sign_up') }}" class="register-btn">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                    <a href="{{ route('index') }}" class="home-btn">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
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
