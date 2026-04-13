@extends('frontend.layout.default')
@section('title')
    {{ $settings->app_name }} - Invest and Grow - Contact
@endsection
@section('content')
    

    <main class="contacts">
      <section class="contacts__promo promo">
        <div class="contacts__promo__container container">
          <div class="contacts__promo__text">
            <h1 class="contacts__promo__text__title">Contacts</h1>
            <p class="p1">We do not have any permanent office as we work remotely.</p>
            <p class="p1">You can contact Ambassadors in your city or send us an email:</p>
            <a class="contacts__promo__text__email" href="#">
              <svg width="56" height="16" viewBox="0 0 56 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g opacity="0.2">
                  <rect x="3.65625" y="13.6567" width="10" height="2" rx="1" transform="rotate(-45 3.65625 13.6567)"
                    fill="white" />
                  <rect x="10.7285" y="9.41431" width="10" height="2" rx="1" transform="rotate(-135 10.7285 9.41431)"
                    fill="white" />
                </g>
                <g opacity="0.5">
                  <rect x="23.6562" y="13.6567" width="10" height="2" rx="1" transform="rotate(-45 23.6562 13.6567)"
                    fill="white" />
                  <rect x="30.7285" y="9.41431" width="10" height="2" rx="1" transform="rotate(-135 30.7285 9.41431)"
                    fill="white" />
                </g>
                <rect x="43.6562" y="13.6567" width="10" height="2" rx="1" transform="rotate(-45 43.6562 13.6567)"
                  fill="white" />
                <rect x="50.7285" y="9.41431" width="10" height="2" rx="1" transform="rotate(-135 50.7285 9.41431)"
                  fill="white" />
              </svg>
              <h5>
                <span class="__cf_email__"></span>
              </h5>
            </a>
          </div>
          <img width="1525" height="1688" src="{{ asset('frontend/main/wp-content/uploads/2021/02/Contact.png') }}"
            class="contacts__promo__icon wp-post-image" alt="Contacts" loading="lazy"
            sizes="(max-width: 1525px) 100vw, 1525px" />
          <div class="rightText">
            <p class="subP">fifthforthfin</p>
            <span class="slash"></span>
          </div>
        </div>
      </section>
      <section class="contacts__mail">
        <div class="container">
          <ul class="contacts__mail__list">
            <li class="contacts__mail__list__item">
              <div class="contacts__mail__list__item__block">
                <div class="contacts__mail__list-group">
                  <div>
                    <p class="contacts__mail__list__item__title">Email:</p>
                    <a class="contacts__mail__list__item__mail" href="mailto:support@fifthforthfin.com">
                      <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/img/contacts/planet.svg') }}" alt="socnet icon"
                        loading="lazy" />
                      <b>
                        <span class="__cf_email__"
                         >support@fifthforthfin.com</span>
                      </b>
                    </a>
                  </div>
                  <div>
                    <p class="contacts__mail__list__item__title">Instagram:</p>
                    <a class="contacts__mail__list__item__mail" href="https://www.instagram.com/">
                      <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/img/contacts/Instagram.svg') }}" alt="socnet icon"
                        loading="lazy" />
                      <b>fifth forth finance</b>
                    </a>
                  </div>
                  <div>
                    <p class="contacts__mail__list__item__title">Telegram:</p>
                    <a class="contacts__mail__list__item__mail" href="https://t.me/">
                      <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/img/contacts/Telegram.svg') }}" alt="socnet icon"
                        loading="lazy" />
                      <b>fifth forth finance</b>
                    </a>
                  </div>
                </div>
                <img class="contacts__mail__list__item__icon"
                  src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/img/contacts/wallet.svg') }}" alt="gift" loading="lazy" />
              </div>
            </li>
          </ul>
        </div>
      </section>
      <section class="contacts__chat">
        <div class="container">
          <h3 class="contacts__chat__title">You can also use our Support Chat</h3>
          <p class="contacts__chat__text">Icon in the lower left corner</p>
        </div>
      </section>
    </main>

 @endsection
