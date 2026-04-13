<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Withdrawal Status Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 30px; margin: 0;">

    <table width="100%" cellpadding="0" cellspacing="0" 
           style="max-width: 600px; margin: auto; background-color: #ffffff; 
                  border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

        <!-- Header -->
        <tr style="background-color: #1d4ed8; color: #fff;">
            <td style="padding: 25px; text-align: center;">
              <img src="{{ isset($settings->logo) 
            ? asset('storage/' . $settings->logo) 
            : asset('default-logo.png') }}" 
     alt="{{ $settings->app_name ?? config('app.name') }} Logo" 
     width="80" 
     style="margin-bottom: 10px; border-radius: 6px;">

                <h2 style="margin: 0; font-size: 22px;">{{ $settings->app_name ?? config('app.name') }}</h2>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 25px;">
                <h3 style="margin-top: 0;">Hello, {{ $withdrawal->user->fullname }}!</h3>

                <p style="font-size: 16px; color: #333;">
                    Your withdrawal request has been updated with the following status:
                </p>

                <table cellpadding="8" cellspacing="0" 
                       style="width: 100%; background-color: #f9fafb; 
                              border-radius: 8px; border: 1px solid #e5e7eb; margin-top: 15px;">
                    <tr>
                        <td style="width: 40%; font-weight: bold;">Amount:</td>
                        <td>${{ number_format($withdrawal->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Coin Type:</td>
                        <td>{{ strtoupper($withdrawal->coin_type ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Wallet Address:</td>
                        <td>{{ $withdrawal->wallet_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Status:</td>
                        <td>
                            @if($withdrawal->status === 'pending')
                                <span style="color: #f59e0b;">Pending</span>
                            @elseif($withdrawal->status === 'approved')
                                <span style="color: #16a34a;">Approved</span>
                            @elseif($withdrawal->status === 'rejected')
                                <span style="color: #dc2626;">Rejected</span>
                            @endif
                        </td>
                    </tr>
                    @if($withdrawal->admin_note)
                    <tr>
                        <td style="font-weight: bold;">Admin Note:</td>
                        <td>{{ $withdrawal->admin_note }}</td>
                    </tr>
                    @endif
                </table>

                <p style="margin-top: 20px; color: #4b5563; font-size: 15px;">
                    Thank you for using <strong>{{ $settings->app_name ?? config('app.name') }}</strong>. 
                    We are always here to assist you with your withdrawals.
                </p>

                <p style="margin-top: 10px; color: #4b5563;">
                    Cheers,<br>
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
