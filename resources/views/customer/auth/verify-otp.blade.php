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
            padding: 30px 30px;
        }

        .verify-container {
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            align-items: left;
        }

        .verify-card h2 {
            font-size: 46px;
            font-weight: normal;
            margin-bottom: 20px;
            color: #333;
        }

        .verify-card p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }

        .form-group {
            width: 100%;
            max-width: 400px;
            margin-bottom: 30px;
            position: relative;
        }

        .otp-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 300px;  
        }

        .otp-container input {
            width: 40px;  
            height: 50px;  
            text-align: center;
            font-size: 24px; 
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            margin: 5px;
            box-sizing: border-box;
            transition: border 0.3s ease;
        }

        .otp-container input:focus {
            border: 1px solid #007BFF;
        }

        .otp-container input:focus,
        .otp-container input:hover {
            box-shadow: 0 2px 0 0 #04d2da;
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 12px;
            color: #999;
        }

        .verify-btn {
            background-color: #00243d;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }

        .verify-btn:hover {
            background-color: #003a5c;
        }

        .resend-link {
            margin-top: 30px;
            text-align: left;
            font-size: 14px;
        }

        .resend-link button {
            background-color: transparent;
            color: #007BFF;
            border: none;
            font-size: 1rem;
            cursor: pointer;
        }

        .resend-link button:hover {
            text-decoration: underline;
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

            .verify-card h2 {
                font-size: 36px;
            }

            .otp-container input {
                width: 35px;
                height: 45px;
                font-size: 20px;
            }

            .verify-btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .logo strong {
                font-size: 24px;
            }

            .verify-card h2 {
                font-size: 28px;
            }

            .otp-container input {
                width: 30px;
                height: 40px;
                font-size: 18px;
            }

            .verify-btn {
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
        <div class="verify-container">
            <div class="verify-card">
                <h2>Verify Your Email</h2>
                <p>We've sent a 6-digit verification code to your email address.</p>
                
                <form method="POST" action="{{ route('verification.verify') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="otp">Verification Code</label>
                        <div class="otp-container">
                            <input type="text" id="otp1" maxlength="1" name="otp1" required autofocus>
                            <input type="text" id="otp2" maxlength="1" name="otp2" required>
                            <input type="text" id="otp3" maxlength="1" name="otp3" required>
                            <input type="text" id="otp4" maxlength="1" name="otp4" required>
                            <input type="text" id="otp5" maxlength="1" name="otp5" required>
                            <input type="text" id="otp6" maxlength="1" name="otp6" required>
                        </div>
                        @error('otp') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <input type="hidden" name="otp" id="otp">
                    
                    <button type="submit" class="verify-btn">Verify Email</button>
                </form>
                
                <div class="resend-link">
                    Didn't receive a code? 
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="resend-btn">Resend Code</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Navi Cargo. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const otpInputs = document.querySelectorAll('.otp-container input');
        
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function () {
                    if (input.value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();   
                    }
                });
            });
        
            document.querySelector('form').addEventListener('submit', function (e) {
                const otpValues = Array.from(otpInputs).map(input => input.value).join('');
                document.querySelector('input[name="otp"]').value = otpValues; 
            });
        });
    </script>
</body>
</html>
