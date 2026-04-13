@extends('frontend.layout.default')
@section('title')
    {{ $settings->app_name }}  - Invest and Grow - Faq
@endsection

@section('content')
 

    <main class="faq">
      <section class="faq__promo promo">
        <div class="faq__promo__container container">
          <div class="faq__promo__text">
            <h1 class="faq__promo__text__title">FAQ</h1>
            <div class="faq__promo__text__text">
              <p>Answers to frequently asked questions</p>
            </div>
          </div>
          <img width="1893" height="1750" src="{{ asset('frontend/main/wp-content/uploads/2021/02/FAQ-1536x1420.png' )}}"
            class="faq__promo__icon wp-post-image" alt="FAQ" loading="lazy" sizes="(max-width: 1893px) 100vw, 1893px" />
          <div class="rightText">
            <p class="subP">fifthforthfin</p>
            <span class="slash"></span>
          </div>
        </div>
      </section>
      <section class="faq__info">
        <div class="container">
          <h3 class="faq__info__title" id="registration">
            Registration <span class="faq__info__title__span">#</span>
          </h3>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">How to set up an account?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                You can see a “Log in/sign up” button in the top right corner of the page. After clicking on it, you
                need to enter the following information: your e-mail, create a Password, enter your Name and Phone
                number. If you sign up using a referral link, there will be the partner’s login in the “Partner”
                field. Click on the checkbox next to “I agree to the processing of my personal data”. Click on the
                “Sing up” button.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">The “Sign up” button is not active</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Try to enter a new password at least 8 symbols long and containing at least one numeral and one
                capital letter. No special symbols are allowed.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                I cannot log in to my account after I have signed up, there is an error “Something went wrong”
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                There may be a chance that you have not confirm your new account via email. Please follow the link
                given in the letter.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">There is no confirmation letter in my inbox.</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>Please check the “SPAM” folder.</p>
            </div>
          </div>
          <h3 class="faq__info__title" id="verification">
            Verification <span class="faq__info__title__span">#</span>
          </h3>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">How do I undergo the process of verification?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p class="faq__info__item__body_text faq__info__text-video">
                After you have signed up, you need to click on the “Undergo KYC” and to upload the required documents
                following the instructions.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                What documents are required in the process of verification?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                - Passport (international or regular)<br />
                - Driver’s license<br />
                - ID card<br />
                - Resident card
              </p>

              <p>
                <br />
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                Why should I share my personal persona data and documents?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                We understand that you may be worried. However, we can assure you that our company is legally
                registered and granted with a business license. Providing your personal data, you make ensure your own
                safety and security. fifthforthfin does not have access to your personal data, as the verification
                process is carried out by a third party. This is an independent company dealing with personal data
                processing operations, which has a license given by the Federal Service for Supervision of
                Communications, Information Technology, and Mass Media and an international certificate.
              </p>
              <p></p>
            </div>
          </div>
          <h3 class="faq__info__title" id="accounts">
            Managing your accounts <span class="faq__info__title__span">#</span>
          </h3>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">What is a margin fee?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                argin fee is the cost associated with borrowing funds to trade securities on margin, essentially
                leveraging your investment.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">How can I monitor my margin fees?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Regularly review your brokerage statements, online account portal, or contact your broker's customer
                service to stay informed about your margin
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                Are there any risks associated with using ETH for margin fee payments?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Cryptocurrency markets can be volatile. Be aware of potential price fluctuations and ensure you have
                enough ETH to cover the fees.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">How can I initiate an ETH deposit for my account margin ?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Navigate to the deposit section on your page, obtain the necessary wallet address, and transfer the
                desired amount of ETH indicated .
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                What happens if the ETH deposit doesn't cover the entire margin fee?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Ensure the deposited ETH amount is sufficient to cover the margin fees. If not, your withdrawal would
                be pending
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                How is the margin fee calculated based on company profits?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>The margin fee is calculated as 20% of the profit generated for the investor by the company.</p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">Are there penalties for late payment of the margin fee?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Investors should be aware of any penalties outlined in the agreement for late payment of margin fees.
                Timely payments are essential to avoid complications such as ETH price fluctuations
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                Can investors withdraw the margin fee after their first withdrawal?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Yes, after the initial withdrawal, investors gain the flexibility to withdraw the margin fee. This
                approach allows investors to experience the profit-sharing arrangement before the fee becomes
                withdrawable.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                Why can't investors internally deduct or swap fees, and why must it be paid through external
                exchanges?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                To ensure financial transparency and independence, investors pay the margin fee through external
                exchanges. This prevents internal deductions, promoting clear financial transactions on the
                blockchain.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">How is the margin fee calculated, and when is it due?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                The margin fee is 20% of the profit generated for the investor by the company. It is a one-time fee
                for new investors and is due before the first withdrawal.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                Can investors use funds from their accounts to cover the margin fee internally?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                No, internal deductions or swaps are not allowed. This policy maintains financial independence for
                investors, ensuring the margin fee is transparently processed through external exchanges.
              </p>
            </div>
          </div>

          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                How long does it take for a crypto payment from an external exchange to reflect in the investor's
                account?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Processing times depend on blockchain confirmations and the company's procedures. Investors should
                check with the company for estimated deposit processing times. .
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                How can investors initiate a crypto payment for the margin fee from an external exchange?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Investors initiate payment by transferring the required amount in cryptocurrency, such as ETH, from
                their external exchange account to the specified wallet address provided by the company.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                How does the withdrawal process for the margin fee work after the initial withdrawal?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                After the first withdrawal, investors can withdraw the margin fee, providing them with flexibility and
                allowing them to experience the profit-sharing arrangement before the fee becomes withdrawable.
              </p>
            </div>
          </div>

          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                What if the crypto payment doesn't cover the full margin fee amount?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Ensure the crypto payment is 20% of the generated profit to cover the margin fee. If not, the company
                may provide guidance on addressing the remaining fee.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                Can investors use funds from their accounts to cover the margin fee internally?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p class="faq__info__item__body_text faq__info__text-video">
                No, internal deductions or swaps are not allowed. This policy maintains financial independence for
                investors, ensuring the margin fee is transparently processed through external exchanges.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">
                Why is the margin fee only payable through external exchanges?
              </h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p class="faq__info__item__body_text faq__info__text-video">
                Utilizing external exchanges adds an extra layer of transparency and security. The use of blockchain
                technology ensures a clear and auditable trail for the margin fee payment, reducing the risk of
                internal manipulation.
              </p>
            </div>
          </div>
          <h3 class="faq__info__title" id="settings">Settings <span class="faq__info__title__span">#</span></h3>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">Reinvestment</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                Find your email in the top right corner of the website and click on it. The reinvestment settings can
                be found in the “Settings” section. Then choose “Reinvestment”.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">How can I change my email?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                To change your email, you need to find the account settings (click on your email in the top right
                corner) and to click on the pencil icon near the email address. Enter new email after which there will
                be a letter sent to your previous email.
              </p>
            </div>
          </div>
          <div class="faq__info__item">
            <div class="faq__info__item__header">
              <h5 class="faq__info__item__header__text">How can I change my email if I don’t have access to it?</h5>
              <span class="faq__info__item__header__open"></span>
            </div>
            <div class="faq__info__item__body">
              <p>
                In this case you should contact the support team via
                <a href="">
                  <span class="__cf_email__" data-cfemail="b4c7c1c4c4dbc6c0f4d5d9ddc69ad7d5c4ddc0d5d8">[email
                    &#160;protected]</span>
                </a>
                . State you full name, the reason for changing your email and attach a selfie with your ID and a sheet
                of paper with the today’s date written on it. You also need to give your old email.
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>-->
    <!-- End -->

@endsection