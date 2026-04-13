<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KYC Status Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 30px; margin: 0;">

    <table width="100%" cellpadding="0" cellspacing="0" 
           style="max-width: 600px; margin: auto; background-color: #ffffff; 
                  border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        
        <!-- Header -->
        <tr style="background-color: #1d4ed8; color: #ffffff;">
            <td style="padding: 25px; text-align: center;">
                <img  src="{{ $settings && $settings->logo ? asset('public/storage/' . $settings->logo) : asset('assets/img/default-logo.png') }}"
                     alt="{{ $settings->app_name ?? config('app.name') }} Logo" 
                     width="80" 
                     style="margin-bottom: 10px; border-radius: 6px;">
                <h2 style="margin: 0; font-size: 22px;">{{ $settings->app_name ?? config('app.name') }}</h2>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 25px;">
                <h3 style="margin-top: 0;">Hello {{ $user->fullname }},</h3>

                @if($status === 'approved')
                    <p style="font-size: 16px; color: #16a34a; font-weight: bold;">
                        Congratulations! Your KYC verification has been approved.
                    </p>
                    <p style="font-size: 16px; color: #333;">
                        You can now deposit and invest on the platform without restrictions.
                    </p>
                @else
                    <p style="font-size: 16px; color: #dc2626; font-weight: bold;">
                        Unfortunately, your KYC verification has been rejected.
                    </p>
                    <p style="font-size: 16px; color: #333;">
                        Please review your submitted documents and re-submit the correct information.
                    </p>
                @endif

                <p style="margin-top: 20px; color: #4b5563; font-size: 15px;">
                    Thank you for using <strong>{{ $settings->app_name ?? config('app.name') }}</strong>.
                    Our team is always here to assist you.
                </p>

                <p style="margin-top: 10px; color: #4b5563;">
                    Best regards,<br>
                    <strong>{{ $settings->app_name ?? config('app.name') }} Team</strong>
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr style="background-color: #1d4ed8; color: #fff;">
            <td style="padding: 15px; text-align: center; font-size: 12px;">
                &copy; {{ date('Y') }} {{ $settings->app_name ?? config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>

</body>
</html>
