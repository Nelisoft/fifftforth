<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Investment Completed</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f5f5f5; padding:20px;">
  <div style="max-width:600px;margin:auto;background:white;padding:20px;border-radius:10px;">
    <h2 style="color:#f59e0b;">Investment Completed 🎉</h2>
    <p>Hi {{ $investment->user->name }},</p>
    <p>Congratulations! Your investment in the <b>{{ $investment->plan->name }}</b> plan has completed successfully.</p>
    <p><b>Amount:</b> ${{ number_format($investment->amount, 2) }}</p>
    <p><b>Total Profit:</b> ${{ number_format($investment->profit, 2) }}</p>
    <p><b>Duration:</b> {{ $investment->plan->duration_days }} days</p>
    <br>
    <p>Your capital and profit have been credited to your account balance.</p>
    <p>Thank you for investing with us!</p>
  </div>
</body>
</html>
