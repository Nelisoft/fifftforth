<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Referral Bonus</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        .header { background: #4e73df; color: #fff; padding: 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 20px; color: #333; }
        .content p { margin: 10px 0; line-height: 1.6; }
        .bonus { font-size: 20px; font-weight: bold; color: #1cc88a; }
        .footer { background: #f1f1f1; text-align: center; padding: 15px; font-size: 12px; color: #777; }
        .btn { display: inline-block; padding: 10px 20px; background: #4e73df; color: #fff; border-radius: 5px; text-decoration: none; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Referral Bonus Earned!</h1>
        </div>
        <div class="content">
            <p>Hi {{ $referrer->fullname }},</p>
            <p>Great news! Your referral <strong>{{ $user->fullname }} ({{ $user->username }})</strong> just made a deposit on the platform.</p>
            <p>You have earned a referral bonus of <span class="bonus">${{ number_format($bonusAmount, 2) }}</span> credited to your account.</p>
            <p>Thank you for referring your friends and helping our community grow!</p>
            <a href="{{ route('user.dashboard') }}" class="btn">View Your Dashboard</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ $settings->app_nam}}. All rights reserved.
        </div>
    </div>
</body>
</html>
