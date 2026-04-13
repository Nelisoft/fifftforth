
    <header id="masthead" class="site-header header">
      <div class="container">
        <a href="{{ route('home') }}" style="font-size: 20px">
          <img class="logo" src="{{ $settings && $settings->logo ? asset('public/storage/' . $settings->logo) : asset('assets/img/default-logo.png') }}" alt="fifthforthfin" loading="lazy" style="height: 25px; width: auto" />
        </a>
        <div class="socBar">
          <a href="{{ route('home') }}"> Home </a>
          <a href="{{ route('about') }}"> About </a>
          <a href="{{ route('offer') }}"> Investors </a>
          <a href="{{ route('faq') }}"> FAQ </a>
          <a href="contact"> Contact </a>
        </div>
        <div class="right">
          <button class="menuButton" id="btnMenu">
            <span class="burger"></span>
          </button>

<div class="log">

 @auth
    {{-- User is logged in --}}
    <a href="{{ route('user.dashboard') }}" class="registration">Dashboard</a>
  @else
    {{-- User is NOT logged in --}}
    <a href="{{ route('user.login') }}" class="registration">Login</a>
    <a href="{{ route('user.register') }}" class="registration">Register</a>
@endauth

</div>

        </div>
      </div>
    </header>