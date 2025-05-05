@extends('teller.layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
    .form-container {
        background: #fff;
        border: 1px solid #ddd;
        padding: 30px;
        width: 100%; 
        border-radius: 10px;
        text-align: center;
        margin: 13% auto;
    }

    .styled-heading {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        text-align: left;
        font-weight: 500;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group label {
        color: #333;
        font-size: 14px;
        margin-bottom: 5px;
        display: block;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        color: #555;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        border-color: #5b9bd5;
        outline: none;
        box-shadow: 0px 0px 5px rgba(91, 155, 213, 0.3);
    }

    .form-section {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .blue-button {
        width: 20%;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .blue-button {
        background: linear-gradient(135deg, #007BFF 0%, #0056b3 100%);
        color: white;
    }

    .blue-button:hover {
        background: linear-gradient(135deg, #0056b3 0%, #004494 100%);
    }

    @media (max-width: 768px) {
        .form-container {
            max-width: 100%;
            padding: 20px;
            margin-left: 0;
            margin-right: 0;
            margin: 90% auto;
        }
        .styled-heading {
            font-size: 20px;
            text-align: center;
        }
        .form-group input {
            font-size: 14px;
        }
        .blue-button{
            font-size: 14px;
            padding: 10px;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .form-container {
            max-width: 95%;
            padding: 15px;
            margin-left: 0;
            margin-right: 0;
        }
        .styled-heading {
            font-size: 18px;
            text-align: center;
        }
        .form-group input {
            font-size: 14px;
            padding: 10px;
        }
        .blue-button {
            font-size: 14px;
            padding: 10px;
            width: 100%;
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

@section('content')
    <div class="form-container">
        <h4 class="styled-heading">Manage Your Password</h4>
        <form action="{{ route('teller.changePassword') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" placeholder="Enter Current Password" required>
                @error('current_password') 
                    <span class="error-message">{{ $message }}</span> 
                @enderror
            
                @if(session('error'))
                    <span class="error-message">{{ session('error') }}</span>
                @endif
            </div>
    
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" placeholder="Enter New Password" required>
                @error('new_password') <span class="error-message">{{ $message }}</span> @enderror
            </div>
    
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
                @error('confirm_password') <span class="error-message">{{ $message }}</span> @enderror
            </div>
    
            <div class="form-section">
                <button type="submit" class="blue-button">Change Password</button>
            </div>
        </form>
    </div>
    @endsection
    
</body>
</html>