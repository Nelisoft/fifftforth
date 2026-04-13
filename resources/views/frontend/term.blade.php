@extends('frontend.layout.default')
@section('title')
    {{ $settings->app_name }} - Invest and Grow - About
@endsection
@section('content')
    
 

      <main class="faq">
      <section class="faq__promo promo">
        <div class="faq__promo__container container">
          <div class="faq__promo__text">
            <h1 class="faq__promo__text__title">Rules and Policies</h1>
            <div class="faq__promo__text__text">
              <!-- <p>Answers to frequently asked questions</p> -->
            </div>
          </div>
          <img width="1893" height="1750" src="{{ asset('frontend/main/wp-content/uploads/2021/02/FAQ-1536x1420.png') }}"
            class="faq__promo__icon wp-post-image" alt="FAQ" loading="lazy" sizes="(max-width: 1893px) 100vw, 1893px" />
          <div class="rightText">
            <p class="subP">fifthforthfin</p>
            <span class="slash"></span>
          </div>
        </div>
      </section>

      <section>
        <div class="container">
          <h4>fifthforthfin- Rules and Regulations</h4>

          <div>
            <h5>1. Account and Identity Verification</h5>
            <p>
              <strong>1.1 Know Your Customer (KYC):</strong> fifthforthfin requires all users to complete AI-assisted
              KYC verification by submitting valid identification and proof of address. This process ensures
              compliance with global financial regulations, safeguarding the platform from fraudulent activity and
              unauthorized access.
            </p>

            <p>
              <strong>1.2 Anti-Money Laundering (AML):</strong> Our advanced AI algorithms continuously monitor
              transactions for suspicious activity. We work closely with global regulatory bodies to ensure strict AML
              compliance, protecting investor funds and maintaining a secure platform.
            </p>

            <p>
              <strong>1.3 Age and Eligibility Requirements:</strong> Investors must be at least 18 years old and
              reside in countries where AI-managed investments are legal. AI-based systems ensure real-time
              verification of eligibility.
            </p>

            <p>
              <strong>1.4 Restricted Regions:</strong> fifthforthfin blocks unauthorized access from sanctioned or
              restricted regions using AI to detect attempts from these locations.
            </p>

            <p>
              <strong>1.5 Single Account Policy:</strong> Each investor is limited to one account unless explicitly
              authorized. AI systems monitor for multiple accounts to enhance platform security.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>2. AI-Managed Investment Plans</h5>
            <p>
              <strong>2.1 Professional AI-Driven Investment Plans:</strong> Our platform automatically manages and
              optimizes your investments, leveraging cutting-edge market analysis and predictive models.
            </p>
            <ul class="investment-plans">
              <li>
                <strong>Trial Plan:</strong> Term: 3 Days | Minimum: $500 | Maximum: $1,500 | ROI: 15% | Margin
                Fee: 15%
              </li>
              <li>
                <strong>Advanced Trading Plan (AI TRADING):</strong> Term: 7 Days | Minimum: $1,500 | Maximum: $5000 | ROI: 35% |
                Margin Fee: 25%
              </li>
              <li>
                <strong>JOIN TRADING PLAN:</strong> Term: 14 Days | Minimum: $10,000 | Maximum: $50,000 | ROI: 50% |
                Margin Fee: 20%
              </li>
              <li>
                <strong>VIP PLAN(Special Edition Growth:</strong> Term: 60 Days | Minimum: $50,000 | Maximum: Unlimited | ROI: 70% | Margin
                Fee: 15%
              </li>
            </ul>
          </div>
          <br /><br />

          <div>
            <h5>3. AI-Driven Trading on Behalf of Investors</h5>
            <p>
              <strong>3.1 Autonomous Trading:</strong> Our AI systems autonomously manage trades using sophisticated
              algorithms to monitor, assess, and execute trades based on real-time data, ensuring optimal results with
              minimized risk.
            </p>
            <p>
              <strong>3.2 Human Oversight:</strong> Human experts monitor AI performance to ensure both technological
              precision and expert oversight.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>4. Margin Payment Policies</h5>
            <p>
              <strong>4.1 Internal Margin Payments via ETH:</strong> Investors can cover margin fees using their ETH
              balance, which will be temporarily held as security while trades are open. Once the transaction is
              complete and all trading obligations are settled, the margin is accessible for withdrawal.
            </p>
            <p>
              <strong>4.2 External Margin Payments via Trust Wallet:</strong> Investors who opt for external margin
              payments must ensure their ETH is available in their Trust Wallet. After confirming the deposit, the
              platform will allow withdrawals once all trading obligations are met.
            </p>
            <p>
              <strong>4.3 Why Margin is Necessary:</strong> The margin acts as a critical risk management tool,
              protecting both the investor and the platform against market volatility.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>5. Binding Investment Agreement and Withdrawal Restrictions</h5>
            <p>
              <strong>5.1 Legally Binding Agreement:</strong> Upon initiating an investment, investors enter into a
              legally binding agreement with fifth forth financeBroker, committing to the terms and conditions of the selected
              investment plan.
            </p>
            <p>
              <strong>5.2 Withdrawal Conditions:</strong> Withdrawals are subject to specific conditions, including a
              minimum account balance of $10,000 and the full settlement of trading obligations.
            </p>
            <p>
              <strong>5.3 Margin Coverage and Withdrawal Eligibility:</strong> Withdrawals are restricted until all
              obligations are satisfied, including margin requirements.
            </p>
            <p>
              <strong>5.4 Investor Commitment:</strong> Investors agree to abide by platform rules, including
              completing the full term of their investment.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>6. Withdrawals and Margin Requirements</h5>
            <p>
              fifthforthfin imposes specific conditions on withdrawals, ensuring the integrity and security of
              investments.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>7. Transparent AI-Powered Fees and Trading Rules</h5>
            <p>
              <strong>7.1 Real-Time Fee Tracking:</strong> All fees are fully transparent and tracked in real-time.
            </p>
            <p>
              <strong>7.2 AI-Executed Trades:</strong> Every trade is managed by AI, ensuring optimal trading outcomes
              using real-time market data.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>8. Security and Data Protection</h5>
            <p>
              <strong>8.1 End-to-End Encryption:</strong> All investor data is protected using advanced encryption
              techniques.
            </p>
            <p>
              <strong>8.2 Compliance with Global Privacy Laws:</strong> The platform adheres to GDPR and other global
              data protection laws.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>9. Regulatory Compliance and Independent Oversight</h5>
            <p>
              <strong>9.1 Regulated by Global Financial Authorities:</strong> fifthforthfin adheres to guidelines set
              by regulatory bodies such as ESMA, CFTC, FCA, and IOSCO.
            </p>
            <p>
              <strong>9.2 Third-Party Audits and AI Reviews:</strong> Regular independent audits ensure that our
              systems are transparent and compliant.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>10. Investor Protection and Insurance</h5>
            <p>
              <strong>10.1 Investment Protection Insurance:</strong> Investors are protected against market volatility
              through comprehensive insurance policies.
            </p>
            <p>
              <strong>10.2 Compensation Policies:</strong> In the rare event of a system malfunction, compensation
              will be provided according to platform policy.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>11. Customer Support and Professional Services</h5>
            <p>
              <strong>11.1 24/7 AI-Enhanced Support:</strong> Our AI-powered support team is available 24/7 to handle
              investor inquiries efficiently.
            </p>
            <p>
              <strong>11.2 VIP Client Services:</strong> VIP investors have access to dedicated account managers and
              exclusive services.
            </p>
          </div>
          <br /><br />

          <div>
            <h5>12. Ethical AI Practices and Sustainability</h5>
            <p>
              <strong>12.1 Ethical AI Standards:</strong> Our AI algorithms are regularly reviewed for fairness and
              transparency.
            </p>
            <p>
              <strong>12.2 Sustainable Investment Practices:</strong> fifthforthfin prioritizes investments in
              companies with strong ESG records, promoting responsible and sustainable investing.
            </p>
          </div>
        </div>
      </section>
    </main>
@endsection