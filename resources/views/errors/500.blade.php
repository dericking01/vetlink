<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #ff6f61;
            color: #fff;
            padding: 20px;
        }

        .header h1 {
            font-size: 48px;
            font-weight: bold;
        }

        .content {
            padding: 30px 20px;
        }

        .content p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #555;
        }

        .content a {
            display: inline-block;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .content a:hover {
            background-color: #0056b3;
        }

        footer {
            background: #f1f1f1;
            padding: 10px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>500</h1>
            <p>Server Error</p>
        </div>
        <div class="content">
            <p>Oops! Something went wrong on our end. Please try again later or contact support if the problem persists.</p>
            {{-- <a href="{{ url('/') }}">Go Back to Homepage</a> --}}
            <a href="{{ url()->previous() }}">Go Back</a>
        </div>
        <footer>
            &copy; {{ date('Y') }} Dodoki Investments Co Ltd. <br> All rights reserved.
        </footer>
    </div>
</body>
</html>
