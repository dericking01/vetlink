<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f7;
            color: #333333;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 40px auto;
            text-align: center;
        }
        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 24px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #666666;
        }
        .btn {
            display: inline-block;
            padding: 14px 24px;
            margin: 20px 0;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.5);
        }
        .footer {
            font-size: 14px;
            color: #888888;
            margin-top: 40px;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Password Reset Request</h1>
        <p>Dear user,</p>
        <p>We received a request to reset your password. Click the button below to reset it:</p>
        <a href="{{ route('reset.password', $token) }}" class="btn">Reset Password</a>
        <p>If you did not request a password reset, please ignore this email. This link will expire in 60 minutes.</p>
        <div class="footer">
            <p>Thank you,</p>
            <p>Dodoki Investments Ltd</p>
            <p><a href="https://dodokiinvestmenttz.co.tz">Visit our website</a></p>
        </div>
    </div>
</body>
</html>
