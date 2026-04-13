<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>{{ $subject }}</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .email-container {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      max-width: 600px;
      margin: 0 auto;
      padding: 30px;
    }
    h2 {
      color: #0d6efd;
      margin-bottom: 20px;
    }
    .message {
      line-height: 1.6;
      font-size: 15px;
      white-space: pre-line;
    }
    .footer {
      margin-top: 30px;
      text-align: center;
      font-size: 13px;
      color: #777;
      border-top: 1px solid #eee;
      padding-top: 15px;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <h2>{{ $subject }}</h2>
    <div class="message">
      {!! nl2br(e($messageContent)) !!}
    </div>
    <div class="footer">
      <p>Sent from {{ $settings->app_name }}</p>
    </div>
  </div>
</body>
</html>
