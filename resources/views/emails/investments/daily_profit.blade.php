<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Daily Profit Update</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f5f5f5; padding:20px;">
  <div style="max-width:600px;margin:auto;background:white;padding:20px;border-radius:10px;">
    <h2 style="color:#3b82f6;">Daily Profit Report 💰</h2>
    <p>Hi {{ $investment->user->fullname }},</p>
    <p>Here’s your current progress for your investment in <b>{{ $investment->plan->name }}</b>:</p>
    <ul style="list-style:none;padding:0;">
      <li><b>Invested:</b> ${{ number_format($investment->amount, 2) }}</li>
      <li><b>Profit so far:</b> ${{ number_format($investment->profit, 2) }}</li>
      <li><b>Progress:</b> {{ $investment->progress ?? 0 }}%</li>
      <li><b>Ends on:</b> {{ \Carbon\Carbon::parse($investment->ends_at)->format('M d, Y') }}</li>
    </ul>
    <br>
    <p>Keep watching your profits grow!</p>
    <p style="font-size:12px;color:#777;">This is an automated message from your investment platform.</p>
  </div>
</body>
</html>
