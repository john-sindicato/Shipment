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
        justify-content: space-between;
    }

    .logo div:first-child {
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

    .admin-badge {
        background-color: #00243d;
        color: white;
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: bold;
        display: inline-flex;
        align-items: center;
        margin-left: 15px;
    }

    .admin-badge i {
        margin-right: 5px;
    }

    @media (max-width: 768px) {
        .logo { 
            align-items: flex-start;
        }

        .logo img {
            height: 30px;
        }

        .logo strong {
            font-size: 30px;
            margin-top: 5px;
        }

        .admin-badge {
            margin-left: 0;
            margin-top: 10px;
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .logo strong {
            font-size: 27px;
        }

        .logo img {
            height: 30px;
        }

        .admin-badge {
            font-size: 12px;
            padding: 4px 10px;
        }
    }

    main {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 30px 30px;
    }

    .login-container {
        width: 100%;
        max-width: 600px;
        display: flex;
        flex-direction: column;
        align-items: left; 
        position: relative;
    }

    .admin-indicator {
        position: absolute;
        top: -15px;
        right: 0;
        background-color: #00243d;
        color: white;
        padding: 5px 15px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: bold;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .admin-indicator i {
        margin-right: 8px;
    }

    h1 {
        font-size: 46px;
        font-weight: normal;
        margin-bottom: 20px;
        color: #333;
        display: flex;
        align-items: center;
    }

    h1 .admin-text {
        font-size: 24px;
        color: #00243d;
        margin-left: 15px;
        font-weight: bold;
        border-left: 3px solid #00243d;
        padding-left: 15px;
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
        margin: 20px 0;
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
        margin-top: 20px;
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

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    .admin-notice {
        background-color: #f8f9fa;
        border-left: 4px solid #00243d;
        padding: 10px 15px;
        margin-bottom: 20px;
        font-size: 14px;
        color: #495057;
        border-radius: 0 4px 4px 0;
    }

    .admin-notice i {
        color: #00243d;
        margin-right: 8px;
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
                    <strong onclick="window.location.href='{{ route('admin.login') }}'">Navi Cargo</strong>
                </div>
                <div class="admin-badge">
                    <i class="fas fa-user-shield"></i> Administrator
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="login-container">
            
            <h1>Login <span class="admin-text">Admin Panel</span></h1>
            
            <form method="POST" action="{{ route('admin_login') }}">
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
                    <input type="password" id="password" name="password" placeholder="Enter your password" >
                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                </div>
                
                <button type="submit" class="login-btn">Log in</button>
            </form> 
            
            <div class="register-section">
                <h2>Welcome, Administrator</h2>
                <p>You are accessing the Navi Cargo Admin Portal. Please log in with your authorized credentials to manage shipments, users, and system operations.</p>
            </div>            
        </div>
    </main>
    
    <footer class="site-footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} Navi Cargo. All rights reserved.</p>
        </div>
    </footer>

    <style>
        .site-footer {
            background-color: #fff;
            border-top: 1px solid #ddd;
            color: #000;
            padding: 30px 0;
            text-align: center;
            margin-top: 0px;
        }

        .site-footer .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .site-footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</body>
</html>