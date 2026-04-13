@extends('frontend.layout.default')
@section('title')
    {{ $settings->app_name }} - Invest and Grow - About
@endsection
@section('content')
    
 

    <main class="about">
      <div class="promo about__promo">
        <div class="container">
          <div class="promoText">
            <h1>About Us</h1>
            <p>
              Welcome to fifth forth finance , where innovation meets investment expertise. At fifth forth finance, we harness the
              power of artificial intelligence to analyze market trends, optimize investment strategies, and
              empower you to make informed decisions.<br />
              With cutting-edge technology and a commitment to financial excellence, we strive to redefine
              the future of trading, making it more accessible and rewarding for every investor.<br />
              Join us on this journey towards intelligent investing and unlock new possibilities in the
              world of finance.
            </p>
          </div>
        </div>
      </div>

      <style>
        @media (max-width: 600px) {
          .viss {
            flex-direction: column;
          }

          .miss {
            flex-direction: column-reverse;
          }
        }
      </style>

      <div class="viss" style="max-width: 700px; text-align: center; margin: 0 auto 20px; display: flex; gap: 30px">
        <div style="width: 350px; align-self: center">
          <h3>Vision</h3>
          <p style="font-size: 18px">
            fifth forth finance aims to be the leading investment and technology provider specialised in digital
            assets, cryptocurrencies, and related services.
          </p>
        </div>

        <img src="{{ asset('frontend/main/wp-content/uploads/2022/01/hex-eye-vision.png' )}}" alt="" style="width: 200px; align-self: center" />
      </div>

      <div class="miss" style="max-width: 700px; text-align: center; margin: 0 auto 50px; display: flex; gap: 30px">
        <img src="{{ asset('frontend/main/wp-content/uploads/2022/01/hex-target.png')}}" alt="" style="width: 200px; align-self: center" />

        <div style="width: 350px; align-self: center">
          <h3>Mission</h3>
          <p style="font-size: 18px">
            fifth forth finance is helping to professionalise the emerging digital asset market, aiming to be the most
            advanced and secure investment and technology provider.
          </p>
        </div>
      </div>

      <section class="licenses" style="padding: 50px 0">
        <div class="container">
          <div class="licenses_view">
            <div class="licenses_box">
              <div class="licenses_box__item">
                <a href="javascript:void(0)">
                  <h5>TEAM</h5>
                  <span class="more"></span>
                </a>
                <p class="card-text">
                  Our team of seasoned financial experts collaborates seamlessly with AI specialists to
                  develop sophisticated algorithms that analyze market trends, identify investment
                  opportunities, and optimize portfolios. By seamlessly integrating artificial intelligence
                  into our investment processes, we unlock new dimensions of efficiency and precision.
                </p>
              </div>
              <div class="licenses_box__item">
                <a href="javascript:void(0)">
                  <h5>PHILOSOPHY</h5>
                  <span class="more"></span>
                </a>
                <p class="card-text">
                  At the core of fifth forth finance philosophy is a commitment to delivering superior returns and
                  personalized financial solutions to our clients. We recognize the dynamic nature of
                  financial markets and, through continuous learning algorithms, adapt our strategies to
                  stay ahead of the curve.
                </p>
              </div>
              <div class="licenses_box__item">
                <a href="javascript:void(0)">
                  <h5>SECURITY</h5>
                  <span class="more"></span>
                </a>
                <p class="card-text">
                  Our commitment to safeguarding your assets is fortified by a team of top-tier security
                  experts, each a maestro in the intricacies of IT security. With a collective dedication to
                  fortifying your financial transactions, we ensure a robust shield against cyber threats,
                  setting new standards for safety in AI-driven trading.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <script>
        let ajaxurl = "wp-admin/admin-ajax.html";
        let true_posts =
          'a:65:{s:9:"post_type";s:12:"comment-user";s:7:"orderby";s:4:"date";s:5:"order";s:4:"DESC";s:14:"posts_per_page";i:4;s:5:"error";s:0:"";s:1:"m";s:0:"";s:1:"p";i:0;s:11:"post_parent";s:0:"";s:7:"subpost";s:0:"";s:10:"subpost_id";s:0:"";s:10:"attachment";s:0:"";s:13:"attachment_id";i:0;s:4:"name";s:0:"";s:8:"pagename";s:0:"";s:7:"page_id";i:0;s:6:"second";s:0:"";s:6:"minute";s:0:"";s:4:"hour";s:0:"";s:3:"day";i:0;s:8:"monthnum";i:0;s:4:"year";i:0;s:1:"w";i:0;s:13:"category_name";s:0:"";s:3:"tag";s:0:"";s:3:"cat";s:0:"";s:6:"tag_id";s:0:"";s:6:"author";s:0:"";s:11:"author_name";s:0:"";s:4:"feed";s:0:"";s:2:"tb";s:0:"";s:5:"paged";i:0;s:8:"meta_key";s:0:"";s:10:"meta_value";s:0:"";s:7:"preview";s:0:"";s:1:"s";s:0:"";s:8:"sentence";s:0:"";s:5:"title";s:0:"";s:6:"fields";s:0:"";s:10:"menu_order";s:0:"";s:5:"embed";s:0:"";s:12:"category__in";a:0:{}s:16:"category__not_in";a:0:{}s:13:"category__and";a:0:{}s:8:"post__in";a:0:{}s:12:"post__not_in";a:0:{}s:13:"post_name__in";a:0:{}s:7:"tag__in";a:0:{}s:11:"tag__not_in";a:0:{}s:8:"tag__and";a:0:{}s:12:"tag_slug__in";a:0:{}s:13:"tag_slug__and";a:0:{}s:15:"post_parent__in";a:0:{}s:19:"post_parent__not_in";a:0:{}s:10:"author__in";a:0:{}s:14:"author__not_in";a:0:{}s:10:"meta_query";a:1:{i:0;a:3:{s:8:"relation";s:2:"OR";i:0;a:2:{s:3:"key";s:10:"_languages";s:7:"compare";s:10:"NOT EXISTS";}i:1;a:3:{s:3:"key";s:10:"_languages";s:5:"value";s:9:"s:2:"en";";s:7:"compare";s:4:"LIKE";}}}s:19:"ignore_sticky_posts";b:0;s:16:"suppress_filters";b:0;s:13:"cache_results";b:1;s:22:"update_post_term_cache";b:1;s:19:"lazy_load_term_meta";b:1;s:22:"update_post_meta_cache";b:1;s:8:"nopaging";b:0;s:17:"comments_per_page";s:2:"50";s:13:"no_found_rows";b:0;}';
        let current_page = 0;
        let max_pages = "9";
      </script>

      <section class="vacancies" style="margin-top: 20px">
        <div class="container">
          <div class="vacancies_box">
            <div class="vacancies_box__left">
              <h3>WE ARE SHAPING THE FUTURE OF THE FINANCIAL INDUSTRY</h3>
              <p>
                A pioneer in digital assets since 2017 and trusted FINMA-regulated partner of financial
                institutions looking to participate and evolve in the digital asset space. Our fully
                integrated platform provides access to invest in, manage, trade, and store digital
                assets securely.
              </p>
            </div>
            <div class="vacancies_box__right">
              <a class="advantages_tabs__items active" style="
                    color: #fff;
                    padding: 20px 10px;
                    margin: 40px auto 0;
                    display: block;
                    background: #208cf0;
                    width: auto;
                  " href="register.html" rel="noopener noreferrer">Start</a>
            </div>
          </div>
        </div>
      </section>
    </main>

@endsection