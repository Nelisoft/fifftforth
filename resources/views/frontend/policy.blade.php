@extends('frontend.layout.default')
@section('title')
    {{ $settings->app_name }} - Invest and Grow - About
@endsection
@section('content')
    
 

     <main class="faq">
      <section class="faq__promo promo">
        <div class="faq__promo__container container">
          <div class="faq__promo__text">
            <h1 class="faq__promo__text__title">Privacy Policy</h1>
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
          <h3>fifthforthfinPrivacy Policy</h3>
          <p><strong>Effective Date:</strong> February 12, 2024</p>
          <p>
            fifthforthfinis dedicated to protecting your privacy. This Privacy Policy explains how we collect, use,
            and safeguard your personal information when using our services or platform.
          </p>

          <h5>1. Information We Collect</h5>
          <ul>
            <li>
              <strong>Personal Identification Information:</strong> Name, email, phone number, address, date of birth,
              and verification info.
            </li>
            <li><strong>Financial Information:</strong> Payment details, transaction history.</li>
            <li><strong>Technical Data:</strong> IP address, browser, device, and usage data.</li>
            <li><strong>Cookies & Tracking:</strong> Used to improve user experience and analyze behavior.</li>
          </ul>

          <h5>2. How We Use Your Information</h5>
          <ul>
            <li>For <strong>Account Management</strong>, investments, and customer support.</li>
            <li>To comply with <strong>KYC & AML regulations</strong>.</li>
            <li>For <strong>Marketing Communications</strong> (with your consent).</li>
            <li>For <strong>Data Analysis</strong> to improve services.</li>
          </ul>

          <h5>3. Legal Basis for Processing Personal Data</h5>
          <ul>
            <li>Based on <strong>Consent</strong> where applicable.</li>
            <li>For <strong>Contractual Necessity</strong>.</li>
            <li>For <strong>Legal Compliance</strong>.</li>
            <li>In our <strong>Legitimate Interests</strong>, balancing your rights.</li>
          </ul>

          <h5>4. Data Sharing and Disclosure</h5>
          <ul>
            <li>We may share data with <strong>Service Providers</strong> and regulatory bodies.</li>
            <li><strong>No selling</strong> of personal data to third parties.</li>
            <li>In the event of <strong>business transfers</strong>, data may be shared.</li>
          </ul>

          <h5>5. Data Security</h5>
          <ul>
            <li><strong>Encryption</strong> and secure protocols for data protection.</li>
            <li>Access is limited based on <strong>roles and responsibilities</strong>.</li>
            <li>We conduct <strong>regular security audits</strong>.</li>
          </ul>

          <h5>6. International Data Transfers</h5>
          <p>Your data may be transferred internationally, but we ensure adequate safeguards are in place.</p>

          <h5>7. Your Rights</h5>
          <ul>
            <li>Right to <strong>Access</strong> your personal data.</li>
            <li>Right to <strong>Rectification</strong> of inaccurate data.</li>
            <li>Right to <strong>Erasure</strong> under certain conditions.</li>
            <li>Right to <strong>Restrict Processing</strong>.</li>
            <li>Right to <strong>Data Portability</strong>.</li>
            <li>Right to <strong>Object</strong> to data processing in some cases.</li>
          </ul>

          <h5>8. Withdrawals and Margin Requirements</h5>
          <ul>
            <li>
              Investors are legally bound by the <strong>terms of their plan</strong> and withdrawal conditions.
            </li>
            <li>
              Withdrawals are processed once all <strong>obligations</strong> are met (e.g., margin requirements).
            </li>
            <li><strong>Early withdrawals</strong> are restricted to protect both parties.</li>
          </ul>

          <h5>9. Changes to This Privacy Policy</h5>
          <p>We may update this policy periodically. Please review it regularly for updates.</p>

          <h5>10. Contact Us</h5>
          <div class="contact-section">
            <h2>Contact Information</h2>
            <p><strong>fifth forth financeBroker</strong></p>
            <p>Email: <a href="mailto:support@fifthforthfin.com">support@fifthforthfin.com</a></p>
          </div>
        </div>
      </section>
    </main>

@endsection