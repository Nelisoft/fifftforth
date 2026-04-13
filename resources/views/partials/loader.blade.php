<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Advanced Preloader</title>
<style>
  * {margin: 0; padding: 0; box-sizing: border-box;}


  #preloader {
    position: fixed;
    top: 0; left: 0;
    height: 100vh; width: 100%;
    background: radial-gradient(circle at center, #0e0e10 0%, #050507 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    transition: opacity 1s ease, visibility 1s;
  }

  .glow-ring {
    width: 100px;
    height: 100px;
    border: 5px solid rgba(0, 255, 255, 0.1);
    border-top: 5px solid #00fff0;
    border-radius: 50%;
    animation: spin 1.5s linear infinite, pulse 2s ease-in-out infinite;
  }

  .logo-text {
    margin-top: 20px;
    font-size: 1.5rem;
    font-weight: 600;
    color: #00fff0;
    letter-spacing: 2px;
    animation: glowText 2s ease-in-out infinite alternate;
  }

  .loading-text {
    margin-top: 10px;
    font-size: 1rem;
    letter-spacing: 1px;
    color: #aaa;
    animation: blink 1.2s infinite;
  }

  @keyframes spin {
    to { transform: rotate(360deg); }
  }

  @keyframes pulse {
    0%, 100% { box-shadow: 0 0 10px #00fff0; }
    50% { box-shadow: 0 0 30px #00fff0; }
  }

  @keyframes glowText {
    0% { text-shadow: 0 0 5px #00fff0; }
    100% { text-shadow: 0 0 25px #00fff0, 0 0 50px #00fff0; }
  }

  @keyframes blink {
    0%, 100% { opacity: 0.4; }
    50% { opacity: 1; }
  }
</style>
</head>
<body>
  <div id="preloader">
    <div class="glow-ring"></div>
    <div class="logo-text">{{ $settings->app_name }}</div>
    <div class="loading-text">Loading ...</div>
  </div>

  <script>
    window.addEventListener("load", () => {
      setTimeout(() => {
        const preloader = document.getElementById("preloader");
        preloader.style.opacity = "0";
        preloader.style.visibility = "hidden";
      }, 1800);
    });
  </script>
</body>
</html>
