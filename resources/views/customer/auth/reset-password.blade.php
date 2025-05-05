<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
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
            margin-top: 10px;
            border-radius: 5px;
        }

        .login-btn:hover {
            background-color: #003a5c;
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
            <h1>Reset Password</h1>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="New Password" required>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Confirm New Password" required>
                </div>

                <button type="submit" class="login-btn">Reset Password</button>
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Navi Cargo. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
