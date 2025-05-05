<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    }

    header {
        padding: 10px 0;
        border-bottom: 1px solid #e0e0e0;
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #ffffff;
        z-index: 1000;
    }

    .container {
        width: 90%;
        max-width: 1185px;
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
        padding: 100px 30px 80px;  
    }

    .register-container {
        width: 100%;
        max-width: 600px;
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .register-intro {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .register-intro h1 {
        font-size: 28px;
        margin-bottom: 10px;
        color: #000; 
        font-weight: 500;
    }

    .register-intro p {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .form-group {
        width: 100%;
        max-width: 400px;
        margin-bottom: 20px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #666;
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
        top: 39px;
        color: #999;
    }

    .checkbox-group {
        width: 100%;
        max-width: 400px;
        margin: 20px 0;
        display: flex;
        align-items: flex-start;
    }

    .checkbox-group input {
        margin-top: 5px;
        margin-right: 10px;
    }

    .checkbox-group label {
        font-size: 14px;
        color: #333;
    }

    .checkbox-group a {
        color: #0078d4;
        text-decoration: none;
    }

    .checkbox-group a:hover {
        text-decoration: underline;
    }

    .register-btn {
        background-color: #00243d;
        color: white;
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        border-radius: 5px;
    }

    .register-btn:hover {
        background-color: #003a5c;
    }

    .login-link {
        margin: 10px 0;
        font-size: 14px;
    }

    .login-link a {
        color: #0078d4;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    .info-section {
        margin-top: 10px;
        border: 1px solid #e0e0e0;
        padding: 20px;
        width: 100%;
        max-width: 600px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .info-section:hover {
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.15); 
    }

    .info-section h2 {
        font-size: 20px;
        margin-bottom: 15px;
        font-weight: normal;
    }

    .info-section p {
        margin-bottom: 20px;
        font-size: 14px;
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
        margin-left: 15px;
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
        <div class="register-container">
            <div class="register-intro">
                <h1>Welcome to Navi Cargo Registration</h1>
                <p>Navi Cargo is your trusted local shipping partner, specializing in efficient and reliable port-to-port delivery services.</p>
                <p>Create an account to manage your shipments, track deliveries, and experience seamless logistics tailored to your needs.</p>
            </div>       

            <form action="{{ route('sign_up.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <i class="fas fa-user"></i>
                    <input type="text" id="fname" name="fname" value="{{ old('fname') }}">
                    @error('fname') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <i class="fas fa-user"></i>
                    <input type="text" id="lname" name="lname" value="{{ old('lname') }}">
                    @error('lname') <span class="error-message">{{ $message }}</span> @enderror
                </div>
            
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <i class="fas fa-phone-alt"></i>
                    <input type="number" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone') <span class="error-message">{{ $message }}</span> @enderror
                </div>
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                    @error('email') <span class="error-message">{{ $message }}</span> @enderror
                </div>
            
                <div class="form-group">
                    <label for="password">Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password">
                    @error('password') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation') <span class="error-message">{{ $message }}</span> @enderror
                </div>
            
                <button type="submit" class="register-btn">Register</button>
            </form>            
            
            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Log in</a>
            </div>
            
            <div class="info-section">
                <h2>Why register with Navi Cargo?</h2>
                <p>Signing up gives you access to a simple and efficient way to manage all your local shipping needs from one convenient platform.</p>
                <p>With a Navi Cargo account, you can book shipments with ease, stay updated on each stage of the delivery process, and receive dedicated support whenever questions or issues arise.</p>
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