
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Reply from Navi Cargo')</title>
    <style>
        body {
            background-color: #f2f4f8;
            font-family: Arial, sans-serif;
            padding: 0px;
            color: #333;
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
        }
        .original-message-box {
            background-color: #f9f9f9;
            padding: 15px;
            margin: 20px 0 10px 0;
            border-left: 4px solid #004aad;
            border-radius: 6px;
            color: #333;
        }
        .reply-box {
            background-color: #f0f4ff; 
            padding: 15px;
            margin: 10px 0 20px 0;
            border-radius: 6px;
            color: #004aad;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #004aad;
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
            <p>Dear {{ $name }},</p>

            <p>Thank you for reaching out to <strong>Navi Cargo</strong>. Below is your message and our response:</p>

            <div class="section-title">Your Message:</div>
            <div class="original-message-box">
                {{ $customerMessage }}
            </div>

            <div class="section-title">Our Reply:</div>
            <div class="reply-box">
                {{ $replyMessage }}
            </div>

            <p>If you have any further questions or concerns, feel free to reply to this email. We’re always here to help.</p>

            <p>Best regards,<br>
            <strong>Navi Cargo Support Team</strong></p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Navi Cargo. All rights reserved.
        </div>
    </div>
</body>
</html>
