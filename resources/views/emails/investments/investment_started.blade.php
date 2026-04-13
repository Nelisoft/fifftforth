<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Investment Started</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f5f5f5; padding:20px;">
  <div style="max-width:600px;margin:auto;background:white;padding:20px;border-radius:10px;">
    <h2 style="color:#16a34a;">Your Investment Has Started 🚀</h2>
    <p>Hi {{ $investment->user->fullname }},</p>
    <p>You have successfully started a new investment in the <strong>{{ $investment->plan->name }}</strong> plan.</p>
    <p><b>Amount:</b> ${{ number_format($investment->amount, 2) }}</p>
    <p><b>Duration:</b> {{ $investment->plan->duration_days }} days</p>
    <p><b>Daily ROI:</b> {{ $investment->plan->daily_roi }}%</p>
    <p>Your investment will end on <b>{{ $investment->ends_at->format('M d, Y') }}</b>.</p>
    <br>
    <p>Thank you for trusting us with your investment!</p>
  </div>
</body>
</html>
