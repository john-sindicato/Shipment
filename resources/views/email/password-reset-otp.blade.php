<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset - Navi Cargo</title>
    <style> 
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0px;
        }
        .email-container {
            max-width: 600px;  
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        } 
        .content {
            padding: 30px;
            line-height: 1.6;
            color: #333;
        }
        .otp-box {
            background-color: #f0f4ff;
            color: #004aad;
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            border-radius: 6px;
        } 
        .footer {
            font-size: 0.9em;
            color: #777;
            text-align: center;
            padding: 15px 30px 25px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="email-container"> 
        <div class="content">
            <p>Hello,</p>
            <p>We received a request to reset the password for your <strong>Navi Cargo</strong> account.</p>
            <p>Please use the OTP code below to proceed with resetting your password:</p>
            <div class="otp-box">{{ $otp }}</div>
            <p>This code will expire in <strong>5 minutes</strong>. If you did not request a password reset, please ignore this email or contact our support team.</p>
            <p>For any assistance, feel free to reach out to us.</p>
            <p>Best regards,<br><strong>The Navi Cargo Team</strong></p>
        </div> 
        <div class="footer">
            &copy; {{ date('Y') }} Navi Cargo. All rights reserved.
        </div>
    </div>
</body>
</html>
