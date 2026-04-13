<!DOCTYPE html>
<html lang="en" style="font-family: Arial, sans-serif; background-color: #f5f6fa; margin:0; padding:0;">
<head>
    <meta charset="UTF-8">
    <title>Deposit {{ ucfirst($deposit->status) }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f5f6fa;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f5f6fa; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 0 10px rgba(0,0,0,0.1);">

                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 20px 0; background-color:#1e90ff;">
                            <img src="{{ asset('public/storage/' . $settings->logo) }} alt="{{ $settings->app_name}}" width="120" style="display:block;">
                        </td>
                    </tr>

                    <!-- Greeting & Deposit Info -->
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color:#333333; margin-top:0;">Hello, {{ $deposit->user->fullname }}!</h2>

                            @if($deposit->status == 'pending')
                                <p style="color:#555555; font-size:16px; line-height:1.5;">
                                    We have received your deposit request of <strong>${{ number_format($deposit->amount, 2) }}</strong> via <strong>{{ strtoupper($deposit->coin_type) }}</strong>.
                                </p>
                                <p style="color:#555555; font-size:16px; line-height:1.5;">
                                    Your deposit is currently <span style="font-weight:bold; color:#FFA500;">pending approval</span>. You will be notified once it is approved.
                                </p>
                            @elseif($deposit->status == 'approved')
                                <p style="color:#555555; font-size:16px; line-height:1.5;">
                                    Good news! Your deposit of <strong>${{ number_format($deposit->amount, 2) }}</strong> via <strong>{{ strtoupper($deposit->coin_type) }}</strong> has been <span style="font-weight:bold; color:#28a745;">approved</span> and credited to your account.
                                </p>
                            @endif

                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ route('user.dashboard') }}" style="background-color:#1e90ff; color:#ffffff; text-decoration:none; padding:12px 25px; border-radius:5px; font-weight:bold; display:inline-block;">Go to Dashboard</a>
                            </div>

                            <p style="color:#555555; font-size:14px; line-height:1.5;">
                                Cheers,<br>
                                The {{ $settings->app_name}} Team
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 15px; background-color:#f0f0f0; font-size:12px; color:#999999;">
                            &copy; {{ date('Y') }} {{ $settings->app_name}}. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
