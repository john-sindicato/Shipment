<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification - Navi Cargo</title>
    <style> 
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
            <p>Thank you for registering with <strong>Navi Cargo</strong>.</p>
            <p>To complete your registration, please use the verification code below:</p>
            <div class="otp-box">{{ $otp }}</div>
            <p>This code will expire in <strong>5 minutes</strong>. If you did not initiate this request, please disregard this email.</p>
            <p>For any questions or support, feel free to contact us.</p>
            <p>Best regards,<br><strong>The Navi Cargo Team</strong></p>
        </div> 
        <div class="footer">
            &copy; {{ date('Y') }} Navi Cargo. All rights reserved.
        </div>
    </div>
</body>
</html>
