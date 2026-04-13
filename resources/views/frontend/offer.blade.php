@extends('frontend.layout.default')
@section('title')
    {{ $settings->app_name }} - Invest and Grow - About
@endsection
@section('content')
    
 
  <main class="about">
      <div class="promo about__promo" style="max-height: 500px !important; min-height: auto">
        <div class="container">
          <div class="promoText">
            <h1>Investment Plans</h1>
            <!-- <p>Investment options</p> -->
          </div>
        </div>
      </div>

      <script>
        let ajaxurl = "wp-admin/admin-ajax.html";
        let true_posts =
          'a:65:{s:9:"post_type";s:12:"comment-user";s:7:"orderby";s:4:"date";s:5:"order";s:4:"DESC";s:14:"posts_per_page";i:4;s:5:"error";s:0:"";s:1:"m";s:0:"";s:1:"p";i:0;s:11:"post_parent";s:0:"";s:7:"subpost";s:0:"";s:10:"subpost_id";s:0:"";s:10:"attachment";s:0:"";s:13:"attachment_id";i:0;s:4:"name";s:0:"";s:8:"pagename";s:0:"";s:7:"page_id";i:0;s:6:"second";s:0:"";s:6:"minute";s:0:"";s:4:"hour";s:0:"";s:3:"day";i:0;s:8:"monthnum";i:0;s:4:"year";i:0;s:1:"w";i:0;s:13:"category_name";s:0:"";s:3:"tag";s:0:"";s:3:"cat";s:0:"";s:6:"tag_id";s:0:"";s:6:"author";s:0:"";s:11:"author_name";s:0:"";s:4:"feed";s:0:"";s:2:"tb";s:0:"";s:5:"paged";i:0;s:8:"meta_key";s:0:"";s:10:"meta_value";s:0:"";s:7:"preview";s:0:"";s:1:"s";s:0:"";s:8:"sentence";s:0:"";s:5:"title";s:0:"";s:6:"fields";s:0:"";s:10:"menu_order";s:0:"";s:5:"embed";s:0:"";s:12:"category__in";a:0:{}s:16:"category__not_in";a:0:{}s:13:"category__and";a:0:{}s:8:"post__in";a:0:{}s:12:"post__not_in";a:0:{}s:13:"post_name__in";a:0:{}s:7:"tag__in";a:0:{}s:11:"tag__not_in";a:0:{}s:8:"tag__and";a:0:{}s:12:"tag_slug__in";a:0:{}s:13:"tag_slug__and";a:0:{}s:15:"post_parent__in";a:0:{}s:19:"post_parent__not_in";a:0:{}s:10:"author__in";a:0:{}s:14:"author__not_in";a:0:{}s:10:"meta_query";a:1:{i:0;a:3:{s:8:"relation";s:2:"OR";i:0;a:2:{s:3:"key";s:10:"_languages";s:7:"compare";s:10:"NOT EXISTS";}i:1;a:3:{s:3:"key";s:10:"_languages";s:5:"value";s:9:"s:2:"en";";s:7:"compare";s:4:"LIKE";}}}s:19:"ignore_sticky_posts";b:0;s:16:"suppress_filters";b:0;s:13:"cache_results";b:1;s:22:"update_post_term_cache";b:1;s:19:"lazy_load_term_meta";b:1;s:22:"update_post_meta_cache";b:1;s:8:"nopaging";b:0;s:17:"comments_per_page";s:2:"50";s:13:"no_found_rows";b:0;}';
        let current_page = 0;
        let max_pages = "9";
      </script>

      <section class="vacancies" style="
            width: 100%;
            padding: 0;

            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
          ">
        <div>
          <h2 style="text-align: center">Our Investment <span style="color: #208cf0">Plans</span></h2>

          <style>
            *,
            *:after,
            *:before {
              box-sizing: border-box;
            }

            :root {
              --c-white: #fff;
              --c-black: #000;
              --c-ash: #eaeef6;
              --c-charcoal: #a0a0a0;
              --c-void: #141b22;
              --c-fair-pink: #ffedec;
              --c-apricot: #fbc8be;
              --c-coffee: #754d42;
              --c-del-rio: #917072;
              --c-java: #208cf0;
              --c-titan-white: #f1eeff;
              --c-cold-purple: #a69fd6;
              --c-indigo: #6558d3;
              --c-governor: #4133b7;
            }

            .cards {
              display: flex;
              flex-wrap: wrap;
              align-items: flex-start;
              flex-wrap: wrap;
              justify-content: center;
              gap: 2.5rem;
              width: 90%;
              max-width: 1000px;
              margin: 10vh auto;
            }

            .card {
              border-radius: 16px;
              box-shadow: 0 30px 30px -25px rgba(65, 51, 183, 0.25);
              max-width: 300px;
            }

            .information {
              background-color: var(--c-white);
              padding: 1.5rem;
            }

            .information .tag {
              display: inline-block;
              background-color: var(--c-titan-white);
              color: var(--c-indigo);
              font-weight: 600;
              font-size: 0.875rem;
              padding: 0.5em 0.75em;
              line-height: 1;
              border-radius: 6px;
            }

            .information .tag+* {
              margin-top: 1rem;
            }

            .information .title {
              font-size: 1.5rem;
              color: var(--c-void);
              line-height: 1.25;
            }

            .information .title+* {
              margin-top: 1rem;
            }

            .information .info {
              color: var(--c-charcoal);
            }

            .information .info+* {
              margin-top: 1.25rem;
            }

            .information .button {
              font: inherit;
              line-height: 1;
              background-color: var(--c-white);
              border: 2px solid var(--c-indigo);
              color: var(--c-indigo);
              padding: 0.5em 1em;
              border-radius: 6px;
              font-weight: 500;
              display: inline-flex;
              align-items: center;
              justify-content: space-between;
              gap: 0.5rem;
            }

            .information .button:hover,
            .information .button:focus {
              background-color: var(--c-indigo);
              color: var(--c-white);
            }

            .information .details {
              display: flex;
              gap: 1rem;
            }

            .information .details div {
              padding: 0.75em 1em;
              background-color: var(--c-titan-white);
              border-radius: 8px;
              display: flex;
              flex-direction: column-reverse;
              gap: 0.125em;
              flex-basis: 50%;
            }

            .information .details dt {
              font-size: 0.875rem;
              color: var(--c-cold-purple);
            }

            .information .details dd {
              color: var(--c-indigo);
              font-weight: 600;
              font-size: 1.25rem;
            }

            .plan {
              padding: 10px;
              background-color: #1c1e25;
              color: var(--c-del-rio);
              min-width: 300px;
            }

            span:has(> strong) {
              color: #fff;
            }

            .plan strong {
              font-weight: 600;
              color: #fff;
            }

            .plan .inner {
              padding: 20px;
              padding-top: 40px;
              background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url(main/images/plan-black-bg.jpg) no-repeat center;
              border-radius: 12px;
              position: relative;
              overflow: hidden;
            }

            .plan .pricing {
              position: absolute;
              top: 0;
              right: 0;
              background-color: #208cf0;
              border-radius: 99em 0 0 99em;
              display: flex;
              align-items: center;
              padding: 0.625em 0.75em;
              font-size: 1.3rem;
              font-weight: 600;
              color: #fff;
            }

            .plan .pricing small {
              color: #fff;
              font-size: 0.75em;
              margin-left: 0.25em;
            }

            .plan .title {
              font-weight: 600;
              font-size: 1.5rem;
              color: #fff;
            }

            .plan .title+* {
              margin-top: 0.75rem;
            }

            .plan .info+* {
              margin-top: 1rem;
            }

            .plan .features {
              display: flex;
              flex-direction: column;
            }

            .plan .features li {
              display: flex;
              align-items: center;
              gap: 0.5rem;
            }

            .plan .features li+* {
              margin-top: 0.75rem;
            }

            .plan .features .icon {
              background-color: var(--c-java);
              display: inline-flex;
              align-items: center;
              justify-content: center;
              color: var(--c-white);
              border-radius: 50%;
              width: 20px;
              height: 20px;
            }

            .plan .features .icon svg {
              width: 14px;
              height: 14px;
            }

            .plan .features+* {
              margin-top: 1.25rem;
            }

            .plan button {
              font: inherit;
              background-color: #208cf0;
              border-radius: 6px;
              color: var(--c-white);
              font-weight: 500;
              font-size: 1.25rem;
              width: 100%;
              border: 0;
              padding: 1em;
            }

            .plan button:hover,
            .plan button:focus {
              background-color: #208cf0;
            }

            /*# sourceMappingURL=y.css.map */
          </style>

          <div class="cards">

            <article class="plan [ card ]">
              <div class="inner">
                <span class="pricing">
                  <span style="color: #fff"> 15% <small>/ 3 Days</small> </span>
                </span>
                <h2 class="title">Trial Plan</h2>

                <ul class="features" style="margin: 40px 0">
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Term:</strong> 3 Days</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Min Amount:</strong> $500</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Max Amount:</strong> $1500</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>ROI:</strong> 30% after 3 Days</span>
                  </li>
                </ul>
                <a href="{{ route('user.login') }}">
                  <button class="button">Invest</button>
                </a>
              </div>
            </article>

            <article class="plan [ card ]">
              <div class="inner">
                <span class="pricing">
                  <span style="color: #fff"> 35% <small>/ 7 Days</small> </span>
                </span>
                <h2 class="title">Advanced Trading Plan (AI TRADING)</h2>

                <ul class="features" style="margin: 40px 0">
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Term:</strong> 7 Days</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Min Amount:</strong> $1500</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Max Amount:</strong> $10000</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>ROI:</strong> 35% after 7 Days</span>
                  </li>
                </ul>
                <a href="{{ route('user.login') }}">
                  <button class="button">Invest</button>
                </a>
              </div>
            </article>

            <article class="plan [ card ]">
              <div class="inner">
                <span class="pricing">
                  <span style="color: #fff"> 50% <small>/ 14 Days</small> </span>
                </span>
                <h2 class="title">JOIN TRADING PLAN</h2>

                <ul class="features" style="margin: 40px 0">
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Term:</strong> 14 Days</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Min Amount:</strong> $100000</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Max Amount:</strong> $50000</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>ROI:</strong> 50% after 14 Days</span>
                  </li>
                </ul>
                <a href="{{ route('user.login') }}">
                  <button class="button">Invest</button>
                </a>
              </div>
            </article>

            <article class="plan [ card ]">
              <div class="inner">
                <span class="pricing">
                  <span style="color: #fff"> 70% <small>/ 30 Days</small> </span>
                </span>
                <h2 class="title">VIP PLAN(Special Edition Growth)</h2>

                <ul class="features" style="margin: 40px 0">
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Term:</strong>30 Days</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Min Amount:</strong> $50000</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>Max Amount:</strong>Unlimited</span>
                  </li>
                  <li>
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"
                          fill="currentColor" />
                      </svg>
                    </span>
                    <span><strong>ROI:</strong> 70% after 60 Days</span>
                  </li>
                </ul>
                <a href="{{ route('user.login') }}">
                  <button class="button">Invest</button>
                </a>
              </div>
            </article>

          </div>
        </div>
        <div style="min-height: 100px"></div>
      </section>
    </main>
@endsection