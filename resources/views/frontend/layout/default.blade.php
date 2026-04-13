<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
   
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>fifthforthfin - official website</title>

    <!-- SEO -->
    <meta 
        name="description"
        content="Delivers expert, tailored solutions for digital asset investors through a reliable brokerage platform that connects traditional and modern markets. The company offers access to a diverse portfolio—spanning cryptocurrencies, gold, mining, energy, and real estate—providing clients with premium investment opportunities. With a strong commitment to innovation, transparency, and sustainable long-term growth, it empowers investors to thrive in an evolving financial landscape."
    />

    <!-- WordPress-style Emoji Reset -->
    <style>
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 0.07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('frontend/main/wp-includes/css/dist/block-library/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/main/wp-content/plugins/contact-form-7/includes/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/main/wp-content/plugins/lightbox-photoswipe/lib/photoswipe.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/main/wp-content/plugins/lightbox-photoswipe/lib/skins/default/skin.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/main/wp-content/plugins/meow-gallery/app/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/main/wp-content/plugins/wp-multilang/assets/styles/main.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/main/wp-content/themes/amircapital/assets/css/style.css') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link 
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    />
    <link 
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    <!-- Custom Font Override -->
    <style>
        * {
            font-family: "Poppins", sans-serif !important;
        }
        .fas {
            font-family: "Font Awesome 6 Free" !important;
        }
    </style>

    <!-- Embed Links -->
    <link rel="alternate" type="application/json+oembed" href="{{ asset('frontend/wp-json/oembed/1.0/embed?url=https://fifthforthfinancebroker') }}" />
    <link rel="alternate" type="text/xml+oembed" href="{{ asset('frontend/wp-json/oembed/1.0/embed?url=https://fifthforthfinancebroker-2') }}" />
    <link rel="shortcut icon" href="{{ $settings && $settings->fav ? asset('public/storage/' . $settings->fav) : asset('assets/img/default-logo.png') }}" type="image/x-icon">
    
    <style>
        .right .menu-translate-container {
            right: 200px;
        }
        @media (max-width: 920px) {
            .right .menu-translate-container {
                right: 0;
            }
        }
    </style>
</head>

<body class="home page-template page-id-8 wp-custom-logo language-en">
    <div id="page" class="wrapper">

        <!-- Back to Top -->
        <div class="toTop" onclick="window.scrollTo(0, 0)">
            <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/svg/toTop.svg') }}" alt="Back to top" />
        </div>
          
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


    
    <div class="full-menu" id="menu">
      <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/svg/menuCross.svg') }}" alt="cross" id="menuClose"
        class="menuCross" loading="lazy" />
      <nav class="full-menu__box">
        <div class="full-menu__box-link">
          <a href="{{ route('home') }}" class="full-menu__box__item active" target=""><svg width="32" height="32"
              viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M16 2.15381C16 2.15381 6.48308 10.3692 1.16462 14.8184C0.995382 14.9659 0.859033 15.1473 0.764415 15.3508C0.669797 15.5544 0.619023 15.7755 0.615387 16C0.615387 16.408 0.777474 16.7993 1.06599 17.0878C1.35451 17.3763 1.74582 17.5384 2.15385 17.5384H5.23077V28.3077C5.23077 28.7157 5.39286 29.107 5.68138 29.3955C5.96989 29.684 6.36121 29.8461 6.76923 29.8461H11.3846C11.7926 29.8461 12.184 29.684 12.4725 29.3955C12.761 29.107 12.9231 28.7157 12.9231 28.3077V22.1538H19.0769V28.3077C19.0769 28.7157 19.239 29.107 19.5275 29.3955C19.816 29.684 20.2074 29.8461 20.6154 29.8461H25.2308C25.6388 29.8461 26.0301 29.684 26.3186 29.3955C26.6071 29.107 26.7692 28.7157 26.7692 28.3077V17.5384H29.8462C30.2542 17.5384 30.6455 17.3763 30.934 17.0878C31.2225 16.7993 31.3846 16.408 31.3846 16C31.3825 15.7712 31.3283 15.546 31.2262 15.3413C31.1241 15.1366 30.9768 14.9578 30.7954 14.8184C25.5138 10.3692 16 2.15381 16 2.15381Z"
                fill="white" />
            </svg>Home</a>

          <a href="{{ route('about') }}" class="full-menu__box__item" target=""><svg width="32" height="32" viewBox="0 0 32 32"
              fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M30 1H2C1.73478 1 1.48043 1.10536 1.29289 1.29289C1.10536 1.48043 1 1.73478 1 2V30C1 30.2652 1.10536 30.5196 1.29289 30.7071C1.48043 30.8946 1.73478 31 2 31H30C30.2652 31 30.5196 30.8946 30.7071 30.7071C30.8946 30.5196 31 30.2652 31 30V2C31 1.73478 30.8946 1.48043 30.7071 1.29289C30.5196 1.10536 30.2652 1 30 1ZM27 26C27 26.2652 26.8946 26.5196 26.7071 26.7071C26.5196 26.8946 26.2652 27 26 27H6C5.73478 27 5.48043 26.8946 5.29289 26.7071C5.10536 26.5196 5 26.2652 5 26V6C5 5.73478 5.10536 5.48043 5.29289 5.29289C5.48043 5.10536 5.73478 5 6 5H26C26.2652 5 26.5196 5.10536 26.7071 5.29289C26.8946 5.48043 27 5.73478 27 6V26Z"
                fill="white" />
              <path
                d="M22 15H20.8989C20.7699 14.3741 20.5214 13.7789 20.167 13.2471L20.707 12.7071C20.8892 12.5185 20.99 12.2659 20.9877 12.0037C20.9854 11.7415 20.8802 11.4907 20.6948 11.3053C20.5094 11.1199 20.2586 11.0147 19.9964 11.0124C19.7342 11.0101 19.4816 11.1109 19.293 11.2931L18.753 11.8331C18.2212 11.4786 17.626 11.2301 17 11.1011V10C17 9.73478 16.8946 9.48043 16.7071 9.29289C16.5196 9.10536 16.2652 9 16 9C15.7348 9 15.4804 9.10536 15.2929 9.29289C15.1054 9.48043 15 9.73478 15 10V11.1011C14.3741 11.2301 13.7789 11.4786 13.2471 11.833L12.7071 11.293C12.5185 11.1108 12.2659 11.01 12.0037 11.0123C11.7415 11.0146 11.4907 11.1198 11.3053 11.3052C11.1199 11.4906 11.0147 11.7414 11.0124 12.0036C11.0101 12.2658 11.1109 12.5184 11.2931 12.707L11.8331 13.247C11.4786 13.7788 11.2301 14.374 11.1011 15H10C9.73478 15 9.48043 15.1054 9.29289 15.2929C9.10536 15.4804 9 15.7348 9 16C9 16.2652 9.10536 16.5196 9.29289 16.7071C9.48043 16.8946 9.73478 17 10 17H11.1011C11.2301 17.6259 11.4786 18.2211 11.833 18.7529L11.293 19.2929C11.1108 19.4815 11.01 19.7341 11.0123 19.9963C11.0146 20.2585 11.1198 20.5093 11.3052 20.6947C11.4906 20.8801 11.7414 20.9853 12.0036 20.9876C12.2658 20.9899 12.5184 20.8891 12.707 20.7069L13.247 20.1669C13.7788 20.5214 14.374 20.7699 15 20.8989V22C15 22.2652 15.1054 22.5196 15.2929 22.7071C15.4804 22.8946 15.7348 23 16 23C16.2652 23 16.5196 22.8946 16.7071 22.7071C16.8946 22.5196 17 22.2652 17 22V20.8989C17.6259 20.7699 18.2211 20.5214 18.7529 20.167L19.2929 20.707C19.4815 20.8892 19.7341 20.99 19.9963 20.9877C20.2585 20.9854 20.5093 20.8802 20.6947 20.6948C20.8801 20.5094 20.9853 20.2586 20.9876 19.9964C20.9899 19.7342 20.8891 19.4816 20.7069 19.293L20.1669 18.753C20.5214 18.2212 20.7699 17.626 20.8989 17H22C22.2652 17 22.5196 16.8946 22.7071 16.7071C22.8946 16.5196 23 16.2652 23 16C23 15.7348 22.8946 15.4804 22.7071 15.2929C22.5196 15.1054 22.2652 15 22 15Z"
                fill="white" />
            </svg>About Us</a>
          <a href="{{ route('offer') }}" class="full-menu__box__item" target=""><svg width="32" height="32" viewBox="0 0 32 32"
              fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M30 9H24V6C23.9991 5.20462 23.6828 4.44206 23.1204 3.87964C22.5579 3.31722 21.7954 3.00087 21 3H11C10.2046 3.00087 9.44206 3.31722 8.87964 3.87964C8.31722 4.44206 8.00087 5.20462 8 6V9H2C1.73478 9 1.48043 9.10536 1.29289 9.29289C1.10536 9.48043 1 9.73478 1 10V11C1.00294 13.6513 2.05745 16.1931 3.93218 18.0678C5.8069 19.9426 8.34874 20.9971 11 21H21C23.6512 20.997 26.193 19.9424 28.0677 18.0677C29.9424 16.193 30.997 13.6512 31 11V10C31 9.73478 30.8946 9.48043 30.7071 9.29289C30.5196 9.10536 30.2652 9 30 9ZM10 9V6C10.0003 5.73489 10.1058 5.48073 10.2933 5.29327C10.4807 5.10581 10.7349 5.00034 11 5H21C21.2651 5.00024 21.5194 5.10567 21.7068 5.29316C21.8943 5.48064 21.9998 5.73486 22 6V9H10Z"
                fill="white"></path>
              <path
                d="M21 23H11C9.01836 22.9988 7.06787 22.5067 5.32284 21.5677C3.57782 20.6286 2.09263 19.2719 1 17.6187V26C1.00087 26.7953 1.31722 27.5579 1.87964 28.1203C2.44206 28.6827 3.20462 28.9991 4 29H28C28.7954 28.9991 29.5579 28.6827 30.1204 28.1203C30.6828 27.5579 30.9991 26.7953 31 26V17.6189C29.9074 19.272 28.4222 20.6288 26.6772 21.5678C24.9321 22.5068 22.9816 22.9989 21 23V23Z"
                fill="white"></path>
            </svg>Investors</a>
          <a href="{{ route('faq') }}" class="full-menu__box__item" target=""><svg width="32" height="32" viewBox="0 0 32 32"
              fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M26 1H6C5.46975 1.00061 4.9614 1.21152 4.58646 1.58646C4.21152 1.9614 4.00061 2.46975 4 3V29C4.00061 29.5302 4.21152 30.0386 4.58646 30.4135C4.9614 30.7885 5.46975 30.9994 6 31H26C26.5302 30.9994 27.0386 30.7885 27.4135 30.4135C27.7885 30.0386 27.9994 29.5302 28 29V3C27.9994 2.46975 27.7885 1.9614 27.4135 1.58646C27.0386 1.21152 26.5302 1.00061 26 1V1ZM22 26H10C9.73478 26 9.48043 25.8946 9.29289 25.7071C9.10536 25.5196 9 25.2652 9 25C9 24.7348 9.10536 24.4804 9.29289 24.2929C9.48043 24.1054 9.73478 24 10 24H22C22.2652 24 22.5196 24.1054 22.7071 24.2929C22.8946 24.4804 23 24.7348 23 25C23 25.2652 22.8946 25.5196 22.7071 25.7071C22.5196 25.8946 22.2652 26 22 26ZM22 21H10C9.73478 21 9.48043 20.8946 9.29289 20.7071C9.10536 20.5196 9 20.2652 9 20C9 19.7348 9.10536 19.4804 9.29289 19.2929C9.48043 19.1054 9.73478 19 10 19H22C22.2652 19 22.5196 19.1054 22.7071 19.2929C22.8946 19.4804 23 19.7348 23 20C23 20.2652 22.8946 20.5196 22.7071 20.7071C22.5196 20.8946 22.2652 21 22 21ZM23 13C23 13.2652 22.8946 13.5196 22.7071 13.7071C22.5196 13.8946 22.2652 14 22 14H10C9.73478 14 9.48043 13.8946 9.29289 13.7071C9.10536 13.5196 9 13.2652 9 13V7C9 6.73478 9.10536 6.48043 9.29289 6.29289C9.48043 6.10536 9.73478 6 10 6H22C22.2652 6 22.5196 6.10536 22.7071 6.29289C22.8946 6.48043 23 6.73478 23 7V13Z"
                fill="white" />
            </svg>FAQ</a>
          <a href="{{ route('contact') }}" class="full-menu__box__item" target=""><svg width="32" height="32" viewBox="0 0 32 32"
              fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M29 7H19C19.2652 7 19.5196 6.89464 19.7071 6.70711C19.8946 6.51957 20 6.26522 20 6C20 5.73478 19.8946 5.48043 19.7071 5.29289C19.5196 5.10536 19.2652 5 19 5H13C12.7348 5 12.4804 5.10536 12.2929 5.29289C12.1054 5.48043 12 5.73478 12 6C12 6.26522 12.1054 6.51957 12.2929 6.70711C12.4804 6.89464 12.7348 7 13 7H3C2.46973 7.00053 1.96133 7.21141 1.58637 7.58637C1.21141 7.96133 1.00053 8.46973 1 9V25C1.00053 25.5303 1.21141 26.0387 1.58637 26.4136C1.96133 26.7886 2.46973 26.9995 3 27H29C29.5303 26.9995 30.0387 26.7886 30.4136 26.4136C30.7886 26.0387 30.9995 25.5303 31 25V9C30.9995 8.46973 30.7886 7.96133 30.4136 7.58637C30.0387 7.21141 29.5303 7.00053 29 7ZM13 22H5C4.73478 22 4.48043 21.8946 4.29289 21.7071C4.10536 21.5196 4 21.2652 4 21C4.00298 20.1225 4.23757 19.2614 4.68006 18.5037C5.12255 17.746 5.75725 17.1185 6.52 16.6847C6.21308 16.2338 6.0349 15.7077 6.00462 15.1631C5.97435 14.6185 6.09313 14.076 6.34819 13.5938C6.60324 13.1117 6.98492 12.7082 7.45217 12.4268C7.91942 12.1453 8.45455 11.9966 9 11.9966C9.54545 11.9966 10.0806 12.1453 10.5478 12.4268C11.0151 12.7082 11.3968 13.1117 11.6518 13.5938C11.9069 14.076 12.0256 14.6185 11.9954 15.1631C11.9651 15.7077 11.7869 16.2338 11.48 16.6847C12.2427 17.1185 12.8774 17.746 13.3199 18.5037C13.7624 19.2614 13.997 20.1225 14 21C14 21.2652 13.8946 21.5196 13.7071 21.7071C13.5196 21.8946 13.2652 22 13 22ZM26.707 15.707L22.707 19.707C22.6142 19.7999 22.504 19.8736 22.3827 19.9239C22.2614 19.9742 22.1313 20 22 20C21.8687 20 21.7386 19.9742 21.6173 19.9239C21.496 19.8736 21.3858 19.7999 21.293 19.707L19.293 17.707C19.1108 17.5184 19.01 17.2658 19.0123 17.0036C19.0146 16.7414 19.1198 16.4906 19.3052 16.3052C19.4906 16.1198 19.7414 16.0146 20.0036 16.0123C20.2658 16.01 20.5184 16.1108 20.707 16.293L22 17.5859L25.293 14.293C25.4816 14.1108 25.7342 14.01 25.9964 14.0123C26.2586 14.0146 26.5094 14.1198 26.6948 14.3052C26.8802 14.4906 26.9854 14.7414 26.9877 15.0036C26.99 15.2658 26.8892 15.5184 26.707 15.707V15.707Z"
                fill="white" />
            </svg>Contacts</a>
        </div>

     <div style="display: flex">
  
    @auth
        <div class="log">
            <a href="{{ route('user.dashboard') }}" class="registration">Dashboard</a>
        </div>

   

    @else
        <div class="log">
            <a href="{{ route('user.login') }}" class="registration">Login</a>
        </div>
        <div class="log">
            <a href="{{ route('user.register') }}" class="registration">Register</a>
        </div>
    @endauth

</div>


      </nav>
      <script>
        document.querySelector("#btnMenu").addEventListener("click", (e) => {
          document.querySelector("#menu").classList.add("active");
        });
        document.querySelector("#menuClose").addEventListener("click", (e) => {
          document.querySelector("#menu").classList.remove("active");
        });
      </script>
    </div>


        <!-- Page Content -->
        @yield('content')

        <!-- Footer -->
        @include('frontend.partials.footer')

        <!-- JS Files -->
        <script src="{{ asset('frontend/main/wp-content/plugins/lightbox-photoswipe/lib/photoswipe.min.js') }}"></script>
        <script src="{{ asset('frontend/main/wp-content/plugins/lightbox-photoswipe/lib/photoswipe-ui-default.min.js') }}"></script>
        <script src="{{ asset('frontend/main/wp-content/plugins/lightbox-photoswipe/js/frontend.min.js') }}"></script>
        <script src="{{ asset('frontend/main/wp-content/plugins/meow-gallery/app/galleries.js') }}"></script>
        <script src="{{ asset('frontend/assets/templates/js/add.js') }}"></script>

    </div>
</body>
</html>
