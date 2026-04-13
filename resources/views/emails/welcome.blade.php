<!DOCTYPE html>
<html lang="en" style="font-family: 'Arial', sans-serif; background-color: #f5f6fa; margin:0; padding:0;">
<head>
    <meta charset="UTF-8">
    <title>Welcome to {{ $settings->app_name ?? config('app.name') }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f5f6fa;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f5f6fa; padding: 40px 0;">
        <tr>
            <td align="center">

                <!-- Main Card -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" 
                       style="background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 30px; background: linear-gradient(90deg, #1e90ff, #4facfe);">
                            <img src="{{ isset($settings->logo) ? asset('public/storage/' . $settings->logo) : asset('default-logo.png') }}" 
                                 alt="{{ $settings->app_name ?? config('app.name') }}" width="120" style="display:block;">
                            <h1 style="color:#ffffff; margin:10px 0 0; font-size:28px;">Welcome to {{ $settings->app_name ?? config('app.name') }}</h1>
                        </td>
                    </tr>

                    <!-- Greeting & Message -->
                    <tr>
                        <td style="padding: 40px 30px; text-align:left;">
                            <h2 style="color:#333333; margin-top:0;">Hello, {{ $user->fullname ?? 'User' }}!</h2>
                            <p style="color:#555555; font-size:16px; line-height:1.6;">
                                We’re excited to have you join <strong>{{ $settings->app_name ?? config('app.name') }}</strong>! Your journey towards smarter investing and financial growth starts here.
                            </p>
                            <p style="color:#555555; font-size:16px; line-height:1.6;">
                                Explore your dashboard, manage your investments, track profits, and enjoy a secure platform designed just for you.
                            </p>

                            <!-- CTA Button -->
                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ route('user.dashboard') }}" 
                                   style="background-color:#1e90ff; color:#ffffff; text-decoration:none; padding:14px 28px; border-radius:8px; font-weight:bold; display:inline-block; font-size:16px;">
                                    Go to Dashboard
                                </a>
                            </div>

                            <p style="color:#555555; font-size:14px; line-height:1.5;">
                                Cheers,<br>
                                The {{ $settings->app_name ?? config('app.name') }} Team
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px; background-color:#f0f0f0; font-size:12px; color:#888888;">
                            &copy; {{ date('Y') }} {{ $settings->app_name ?? config('app.name') }}. All rights reserved.
                        </td>
                    </tr>

                </table>
                <!-- End Card -->

            </td>
        </tr>
    </table>

</body>
</html>
