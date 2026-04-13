<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KYC Submission Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e2e2e2;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h2 {
            color: #2c3e50;
        }
        p {
            margin-bottom: 15px;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello {{ $user->fullname }},</h2>

        <p>We have received your KYC submission. Our team will review your documents shortly.</p>
        <p>You will be notified via email once your KYC has been <strong>approved</strong> or <strong>rejected</strong>.</p>

        <p>Thank you for completing your verification.</p>

        <div class="footer">
            &copy; {{ date('Y') }} {{ $settings->app_name }}. All rights reserved.
        </div>
    </div>
</body>
</html>
