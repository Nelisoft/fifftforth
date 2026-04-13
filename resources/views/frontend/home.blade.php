@extends('frontend.layout.default')
@section('title')
    {{ $settings->app_name }}- Invest and Grow  
@endsection
@section('content')




    <div class="promo">
      <style>
        @media (min-width: 600px) {

          .academy__promo__text,
          .promo .container .main-page {
            z-index: 1;
            max-width: 725px;
            position: absolute;
            top: 45%;
            transform: translateY(-50%);
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
          }
        }
      </style>
      <div class="container">
        <div class="main-page">
          <h1>fifth forth finance</h1>
          <p class="p1" style="font-size: 25px; font-weight: 700">
            Discover the future of trading with revolutionary AI technology.<span class="Apple-converted-space"> </span>
          </p>
          <p style="font-size: 18px; font-weight: 400">
            Experience Al-powered trading systems that can help you make smarter investment decisions and achieve
            greater success in the market. Simplifying sophisticated ways of market trading investment.
          </p>
        </div>
        <img width="1108" height="1491" src="{{ asset('frontend/main/wp-content/uploads/2021/02/Home-bg.png')}}" class="promoImg wp-post-image"
          alt="" loading="lazy" sizes="(max-width: 1108px) 100vw, 1108px" />
        <div class="rightText">
          <p class="subP">fifthforthfin</p>
          <span class="slash"></span>
        </div>
      </div>
      <div id="newNews">
        <div class="news">
          <a href="javascript:void(0)"><img width="150" height="150"
              src="{{ asset('frontend/main/wp-content/uploads/2022/12/6446225-150x150.jpg')}}" class="news_img wp-post-image"
              alt="Sunrise Academy Appeared in the Sollar Gifts Showcase" loading="lazy"
              sizes="(max-width: 150px) 100vw, 150px" />
            <div class="news__text">
              <h5 class="news__text__title">Sunrise Academy Appeared in the Sollar Gifts Showcase</h5>
              <p class="news__text__text">Great gift - knowledge!</p>
              <span class="news__link">Learn more</span>
            </div>
          </a>
        </div>
        <!-- marat -->
        <div class="news">
          <a href="javascript:void(0)"><img width="150" height="150"
              src="{{ asset('frontend/main/wp-content/uploads/2022/12/6446226-150x150.jpg' )}}" class="news_img wp-post-image"
              alt="Sollar Gifts pre-Christmas promotion" loading="lazy" sizes="(max-width: 150px) 100vw, 150px" />
            <div class="news__text">
              <h5 class="news__text__title">Sollar Gifts pre-Christmas promotion</h5>
              <p class="news__text__text">From December 5</p>
              <span class="news__link">Learn more</span>
            </div>
          </a>
        </div>
        <div class="news">
          <a href="javascript:void(0)"><img width="150" height="150"
              src="{{ asset('frontend/main/wp-content/uploads/2022/12/Frame-1430104066-150x150.jpg' )}}" class="news_img wp-post-image"
              alt="&#8220;Ambassador in touch&#8221;!" loading="lazy" sizes="(max-width: 150px) 100vw, 150px" />
            <div class="news__text">
              <h5 class="news__text__title">&#8220;Ambassador in touch&#8221;!</h5>
              <p class="news__text__text">Read more</p>
              <span class="news__link">Learn more</span>
            </div>
          </a>
        </div>
      </div>
    </div>
    <section class="aboutCompany">
      <div class="main-modal-box">
        <div class="main-modal-box-container">
          <div class="main-modal-box-button">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="6.22266" y="4.80762" width="24" height="2" rx="1" transform="rotate(45 6.22266 4.80762)"
                fill="white" />
              <rect x="4.80859" y="21.7783" width="24" height="2" rx="1" transform="rotate(-45 4.80859 21.7783)"
                fill="white" />
            </svg>
          </div>
          <div class="main-modal-box-content">
            <div class="main-modal-box-left">
              <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/img/main-modal-box-image.png' )}}" alt="image" />
              <p class="main-modal-box-title">Important information!</p>
              <p>The cybercriminals have created a website through which they can take over your personal data.</p>
              <a href="en/news/vazhnaya-informatsiya/index.html" class="main-modal-box-link">To learn more</a>
            </div>
            <div class="main-modal-box-right">
              <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/img/main-modal-box-phone-img.png' )}}" alt="image" />
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="aboutCompany__body">
          <div class="aboutCompany__body__img">
            <img width="1760" height="1760" src="{{ asset('frontend/main/wp-content/uploads/2020/10/onas-1.jpg' )}}" class="aboutCompany_img"
              alt="aboutCompany" loading="lazy" sizes="(max-width: 1760px) 100vw, 1760px" />
          </div>
          <div class="aboutCompany__body__text">
            <h2 class="aboutCompany__body__text__h2">About</h2>
            <div class="aboutCompany__body__text__p">
              <p>
                Over 8 year history, we have treated clients from over 114 different countries in the world. This
                company is managed by the best hands in the field of investing, successfully handling trading and
                assets management with an enviable track record and 100% assurance of optimum output. <br />Investing
                is made very simple with fifth forth finance! It is time to build your own investment portfolio with the power of
                Artificial Intelligence, a self-directed account and save on fees.
              </p>
            </div>
            <div class="aboutCompany__body__text__p">
              <p>
                - storage, exchange and transfers of cryptocurrency <br />
                - staking and landing of cryptoassets <br />
                - more than 44 business projects on the blockchain <br />
                - 8 jurisdictions (Kazakhstan, Russia, Georgia, Estonia, Lithuania, Canada, UAE, USA) <br />
                <a href="register.html" target="_blanck" style="
                      display: flex;
                      width: fit-content;
                      margin-top: 24px;
                      padding: 10px 20px;
                      border: 0;
                      background: #208cf0;
                      color: #fff;
                      box-shadow: 0 18px 20px -12px rgba(32, 140, 240, 0.2);
                      max-width: 250px;
                      border-radius: 16px;
                      text-align: center;
                      cursor: pointer;
                    ">Join us</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="advantages">
      <div class="container">
        <div class="advantages_block">
          <div class="advantages_bottom advantages_0 active">
            <div class="advantages_bottom__left">
              <h4>Excellent Service</h4>
              <p>
                We’re relentlessly focused on our clients, this means that your long-term success is our main goal. As
                a client you’ll hear from us regularly. Not because we have something to sell, but to keep you
                informed about how we’re managing your money and to make sure we understand your needs.
              </p>
            </div>
            <div class="advantages_bottom__right">
              <img width="1600" height="1600" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Group-547413559.png' )}}"
                class="attachment- size-" alt="Excellent Service" loading="lazy" id="modal-target"
                sizes="(max-width: 1600px) 100vw, 1600px" />
            </div>
          </div>
          <div class="advantages_bottom advantages_1 active">
            <div class="advantages_bottom__left">
              <h4>Experienced Team</h4>
              <p>
                Our 4-person Investment Policy Committee, who make strategic portfolio decisions, has over 130 years
                of combined industry experience. And our executive team has been working together for over three
                decades. This stability and experience across multiple market cycles help us deliver results for our
                clients
              </p>
            </div>
            <div class="advantages_bottom__right">
              <img width="1600" height="1600" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Group-547413560.png')}}"
                class="attachment- size-" alt="Experienced Team" loading="lazy" id="modal-target"
                sizes="(max-width: 1600px) 100vw, 1600px" />
            </div>
          </div>
          <div class="advantages_bottom advantages_2 active">
            <div class="advantages_bottom__left">
              <h4>Exceptional Returns</h4>
              <p>
                Over the last decade we have outperformed the average private client investor in almost all periods.
                Our client returns are one of the best in the whole world because we believe in using the least amount
                of input to achieve the highest amount of output.
              </p>
            </div>
            <div class="advantages_bottom__right">
              <img width="1600" height="1600" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Group-547413562.png' )}}"
                class="attachment- size-" alt="Acquiring a habit of constant learning" loading="lazy" id="modal-target"
                data-video="https://www.youtube.com/embed/HXcTu_guP1s" sizes="(max-width: 1600px) 100vw, 1600px" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="quote">
      <div class="container">
        <blockquote>
          <h3 class="quote__text">
            <span class="quote_spanStart">"</span> Our mission: Material freedom for everyone with the help of
            blockchain knowledge and Artificial Intelligence technology
            <span class="quote_spanFinish">"</span>
          </h3>
        </blockquote>
      </div>
    </section>
    <section class="facts">
      <div class="container">
        <div class="facts_items">
          <img width="172" height="172" src="{{ asset('frontend/main/wp-content/uploads/2020/10/activi.png')}}"
            class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="facts-0" loading="lazy"
            sizes="(max-width: 172px) 100vw, 172px" />
          <div class="facts_items-number">01<span class="blueText">.</span></div>
          <p>
            <b>Financial Planning</b> <br />
            A good financial plan is the blueprint that helps you make decisions holistically and confidently. We can
            help our clients with budgeting and cash flow analysis, estate and tax planning, and even strategies for
            maximizing Social Security.
          </p>
        </div>
        <div class="facts_items">
          <img width="172" height="172" src="{{ asset('frontend/main/wp-content/uploads/2020/10/sotrudniki.png')}}"
            class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="facts-1" loading="lazy"
            sizes="(max-width: 172px) 100vw, 172px" />
          <div class="facts_items-number">02<span class="orangeText">.</span></div>
          <p>
            <b>Retirement Planning</b> <br />
            We work now to help you stop working later. Tell us when and where you want to retire, and how much you’ve
            saved so far. We’ll help give you a sense of where you stand and guide you on the path forward.
          </p>
        </div>
        <div class="facts_items">
          <img width="172" height="172" src="{{ asset('frontend/main/wp-content/uploads/2020/10/investory.png')}}"
            class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="facts-2" loading="lazy"
            sizes="(max-width: 172px) 100vw, 172px" />
          <div class="facts_items-number">03<span class="redText">.</span></div>
          <p>
            <b>Risk Management</b> <br />
            Through timely, in-depth analysis of companies, industries, markets, and world economies, fifthforthfin
            has earned its reputation as a leader in the field of risk investment research and risk management.
          </p>
        </div>
        <div class="facts_items">
          <img width="172" height="172" src="{{ asset('frontend/main/wp-content/uploads/2020/10/chasi.png' ) }}"
            class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="facts-3" loading="lazy"
            sizes="(max-width: 172px) 100vw, 172px" />
          <div class="facts_items-number">04<span class="yellowText">.</span></div>
          <p>
            <b>Financial Freedom</b><br />
            Start investing with fifthforthfin today, Get access to wealth creation that was previously reserved for
            the top 1% of people.
          </p>
        </div>
      </div>
    </section>

    <section class="help">
      <div class="container">
        <div class="help_left">
          <h2>
            fifthforthfin have spent the last three years helping people to change their lives and to start gaining
            income.
          </h2>
          <ul class="help_list">
            <li>We break down the principles of investment awareness</li>
            <li>We educate people on financial awareness, which Is the basic requirement for becoming a success.</li>
            <li>
              We help our clients to learn about the investment tools, how to build proper investment portfolios, how
              to set their goals and achieve them.
            </li>
          </ul>
        </div>
        <div class="help_right">
          <img width="1721" height="1871" src="{{ asset('frontend/main/wp-content/uploads/2021/02/Home2.png' ) }}"
            class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="help" loading="lazy"
            sizes="(max-width: 1721px) 100vw, 1721px" />
        </div>
      </div>
    </section>
    <section class="founder" id="founder">
      <div id="founder-modal" class="modal founder__modal">
        <img id="founder-modal__close" src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/svg/cross.svg') }}"
          alt="A word from the Founder fifthforthfin" loading="lazy" />
        <div class="main">
          <iframe src="index.html" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
      </div>
      <div class="container">
        <h2>A word from the Founder fifthforthfin</h2>
        <div class="founder_box">
          <div class="founder_box__left">
            <img width="450" height="344" src="{{ asset('frontend/main/wp-content/uploads/2020/11/marat.jpg')}}"
              class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="help" loading="lazy" id="modal-target"
              data-video="https://www.youtube.com/embed/moWiBmlK4CQ" sizes="(max-width: 450px) 100vw, 450px" />
            <div class="founder_switch">
              <a class="founder_switch_prev" data-active="0" disabled="true">
                <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/svg/sliderArrow.svg' )}}" alt="arrow" loading="lazy" />
              </a>
              <a class="founder_switch_next" data-active="1" disabled="false">
                <img src="{{ asset('frontend/main/wp-content/themes/amircapital/assets/svg/sliderArrow.svg' )}}" alt="arrow" loading="lazy" />
              </a>
            </div>
          </div>
          <div class="founder_box__right">
            <h5>Coach Raphael Palmdale</h5>
            <p class="active">
              Hello, associates! My name is Coach Raphael Palmdale, the founding CEO of Digital Currency Group. I’ve been part
              of the investment industry for well over a decade and have made significant strides through our range of
              cryptocurrency, startup and artificial intelligence projects. Given the extensive resources and expert
              knowledge involved, I personally consider this as one of DCG's premium start-ups.
              <br />
              I established fifth forth finance with the primary purpose of preserving family wealth. Today, fifth forth finance has
              developed into an extensive ecosystem of AI investment tools, comprising more than 44 active business
              projects that have made forward strides in the field of Artificial Intelligence technology.
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="licenses">
      <div class="container">
        <h2>Licenses</h2>
        <div class="licenses_view">
          <div class="licenses_box">
            <div class="licenses_box__item">
              <a href="javascript:void(0)">
                <h5>OUR FOCUS</h5>
                <span class="more"></span>
              </a>
              <p class="card-text">
                fifthforthfin aims to uphold the highest standards in its governance, ethics and operational
                practices. We want to foster a corporate culture of transparency and integrity which inspires others,
                be a stimulating workplace for all employees, and a committed citizen who supports local communities.
                fifthforthfin’s approach is based on responsibility and is rooted in a ﬁrm belief in the core values
                of Sustainable Investing, Continuous Research, and Capacity Building. Those values drive fifth forth finance
                Broker’s behavior both as a company and an investor to deliver its mission.
              </p>
            </div>
            <div class="licenses_box__item">
              <a href="javascript:void(0)">
                <h5>SUSTAINABLE INVESTING</h5>
                <span class="more"></span>
              </a>
              <p class="card-text">
                At fifthforthfin we’ve successfully created the first scalable sustainable and impact investing
                solution that seeks to deliver competitive financial returns, while driving positive environment,
                social and governance (ESG) outcomes. As we engage in portfolio building and management for our
                clients, we are particularly keen to fund diverse range of funds and other investments designed to
                advance environmental, economic and more social goals while striving for competitive performance. We
                make it easy to craft an investment portfolio of any side that is tailored to meet the impact goals as
                deemed fit by our team of experienced investment managers.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="documents">
      <div class="container">
        <h2>Documentation</h2>
      </div>
      <div class="view">
        <div class="documents_box">
          <a href="{{ route('policy') }}" class="documents_box__items">
            <div class="documents_box__itemsTop">
              <img width="688" height="688" src="{{ asset('frontend/main/wp-content/uploads/2020/10/2-1.png' )}}"
                class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="documents" loading="lazy"
                sizes="(max-width: 688px) 100vw, 688px" />
            </div>
            <div class="documents_box__itemsBottom">
              <h5>Privacy policy</h5>
              <p></p>
              <span class="more">Learn more</span>
            </div>
          </a>

          <a href="{{ route('term') }}" class="documents_box__items">
            <div class="documents_box__itemsTop">
              <img width="688" height="688" src="{{ asset('frontend/main/wp-content/uploads/2020/10/5.png')}}"
                class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="documents" loading="lazy"
                sizes="(max-width: 688px) 100vw, 688px" />
            </div>
            <div class="documents_box__itemsBottom">
              <h5>fifthforthfin rules and regulations</h5>
              <p></p>
              <span class="more">Learn more</span>
            </div>
          </a>

          <a href="assets/white-paper.pdf" class="documents_box__items">
            <div class="documents_box__itemsTop">
              <img width="688" height="688" src="{{ asset('frontend/main/wp-content/uploads/2020/10/uslovia.png')}}"
                class="attachment-mainpage-card-bg size-mainpage-card-bg" alt="documents" loading="lazy"
                sizes="(max-width: 688px) 100vw, 688px" />
            </div>
            <div class="documents_box__itemsBottom">
              <h5>White paper</h5>
              <p></p>
              <span class="more">Learn more</span>
            </div>
          </a>
        </div>
      </div>
    </section>
    <section class="exchanges">
      <style>
        #exchanges-slider::-webkit-scrollbar {
          display: none;
        }
      </style>
      <ul class="exchanges__list" id="exchanges-slider" style="overflow-x: scroll">
        <li class="exchanges__list__item">
          <img width="160" height="32" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Group-547413368.png')}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Group-547413368-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="166" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/COINBASE.png')}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/COINBASE-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/UP-bit.png')}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/UP-bit-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="295" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Bitfinex.png')}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Bitfinex-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Bithumb.png')}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Bithumb-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="271" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Huobi-Global.png')}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Huobi-Global-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Poloniex.png' )}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Poloniex-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="127" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/OKEX.png' )}}" class="exchanges__list__item__img"
            alt="documents" loading="lazy" data-img="main/wp-content/uploads/2020/10/OKEX-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="82" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Gate-io.png' )}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Gate-io-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Bitstamp-2.png' )}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Bitstamp-1.html" />
        </li>
     
   


        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Liquid.png' )}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Liquid-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/CoinBene.png' )}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/CoinBene-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="188" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/DigiFinex.png' )}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/DigiFinex-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/BiBox.png' )}}" class="exchanges__list__item__img"
            alt="documents" loading="lazy" data-img="main/wp-content/uploads/2020/10/BiBox-1.html" />
        </li>
        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Cex-io.png' )}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Cex-io-1.html" />
        </li>
 
      
        <li class="exchanges__list__item">
          <img width="80" height="76" src="{{ asset('frontend/main/wp-content/uploads/2020/10/Ku-Coin.png' )}}"
            class="exchanges__list__item__img" alt="documents" loading="lazy"
            data-img="main/wp-content/uploads/2020/10/Ku-Coin-1.html" />
        </li>
      </ul>
    </section>
    
@endsection