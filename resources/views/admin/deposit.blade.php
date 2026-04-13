@extends('layout.default')
@section('content')
      <main class="main" id="top">
    <div class="container" data-layout="container">
      <script>
        var isFluid = JSON.parse(localStorage.getItem('isFluid'));
        if (isFluid) {
          var container = document.querySelector('[data-layout]');
          container.classList.remove('container');
          container.classList.add('container-fluid');
        }
      </script>

      <div class="row justify-content-center pt-6">
        <div class="col-sm-10 col-lg-7 col-xxl-5">

          <!-- Wizard Card -->
          <div class="card theme-wizard mb-5" id="depositWizard">
            <div class="card-header bg-body-tertiary pt-3 pb-2">
              <ul class="nav justify-content-between nav-wizard">
                <li class="nav-item">
                  <a class="nav-link active fw-semi-bold" href="#step1" data-bs-toggle="tab">
                    <span class="nav-item-circle"><i class="fas fa-coins"></i></span>
                    <span class="d-none d-md-block mt-1 fs-10">Select Coin</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-semi-bold" href="#step2" data-bs-toggle="tab">
                    <span class="nav-item-circle"><i class="fas fa-wallet"></i></span>
                    <span class="d-none d-md-block mt-1 fs-10">Wallet</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-semi-bold" href="#step3" data-bs-toggle="tab">
                    <span class="nav-item-circle"><i class="fas fa-upload"></i></span>
                    <span class="d-none d-md-block mt-1 fs-10">Proof</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-semi-bold" href="#step4" data-bs-toggle="tab">
                    <span class="nav-item-circle"><i class="fas fa-check"></i></span>
                    <span class="d-none d-md-block mt-1 fs-10">Done</span>
                  </a>
                </li>
              </ul>
            </div>

            <div class="card-body py-4">
              <div class="tab-content">
                <!-- STEP 1: Select Coin -->
                <div class="tab-pane active" id="step1">
                  <form id="formStep1">
                    <div class="mb-3">
                      <label class="form-label">Select Coin Type</label>
                      <select class="form-select" id="coinType" required>
                        <option value="">Choose coin...</option>
                        <option value="BTC">Bitcoin (BTC)</option>
                        <option value="ETH">Ethereum (ETH)</option>
                        <option value="USDT">Tether (USDT)</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Amount (USD)</label>
                      <input type="number" class="form-control" id="depositAmount" placeholder="Enter deposit amount" required>
                    </div>
                  </form>
                </div>

                <!-- STEP 2: Wallet -->
                <div class="tab-pane" id="step2">
                  <div id="walletDetails" class="text-center">
                    <h5 class="mb-2">Deposit Address</h5>
                    <p id="walletAddress" class="fw-bold text-primary fs-5"></p>
                    <button class="btn btn-outline-primary btn-sm" onclick="copyWallet()">Copy Address</button>
                  </div>
                </div>

                <!-- STEP 3: Upload Proof -->
                <div class="tab-pane" id="step3">
                  <form id="formStep3" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label class="form-label">Upload Payment Proof (image or PDF)</label>
                      <input type="file" class="form-control" id="paymentProof" accept="image/*,.pdf" required>
                    </div>
                  </form>
                </div>

                <!-- STEP 4: Confirmation -->
                <div class="tab-pane text-center" id="step4">
                  <h4 class="mb-1 text-success">Deposit Submitted Successfully!</h4>
                  <p class="text-muted">Your deposit is being reviewed by our team.</p>
                  <a href="#" class="btn btn-primary" onclick="restartWizard()">Make Another Deposit</a>
                </div>
              </div>
            </div>

            <!-- Footer Navigation -->
            <div class="card-footer bg-body-tertiary">
              <div class="d-flex justify-content-between">
                <button class="btn btn-link" id="prevBtn" type="button">
                  <i class="fas fa-chevron-left me-2"></i>Prev
                </button>
                <button class="btn btn-primary" id="nextBtn" type="button">
                  Next<i class="fas fa-chevron-right ms-2"></i>
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const tabs = document.querySelectorAll('.nav-wizard .nav-link');
      const nextBtn = document.getElementById('nextBtn');
      const prevBtn = document.getElementById('prevBtn');
      let current = 0;

      const walletAddresses = {
        BTC: 'bc1qexamplebtcaddress1234xyz',
        ETH: '0xExampleEthereumAddress1234567890abcdef',
        USDT: 'TRXexampleTetherAddressABC123456'
      };

      function showTab(index) {
        tabs[current].classList.remove('active');
        document.querySelector(tabs[current].getAttribute('href')).classList.remove('active');

        current = index;
        tabs[current].classList.add('active');
        document.querySelector(tabs[current].getAttribute('href')).classList.add('active');

        prevBtn.disabled = current === 0;
        nextBtn.textContent = current === tabs.length - 1 ? 'Finish' : 'Next';
      }

      nextBtn.addEventListener('click', () => {
        if (current === 0) {
          const coin = document.getElementById('coinType').value;
          const amount = document.getElementById('depositAmount').value;
          if (!coin) return alert('Please select a coin type.');
          if (!amount || amount <= 0) return alert('Please enter a valid amount.');
          document.getElementById('walletAddress').textContent = walletAddresses[coin] || 'Wallet not available.';
        }
        if (current === 2) {
          const proof = document.getElementById('paymentProof').files[0];
          if (!proof) return alert('Please upload your payment proof.');
        }
        if (current < tabs.length - 1) showTab(current + 1);
      });

      prevBtn.addEventListener('click', () => {
        if (current > 0) showTab(current - 1);
      });

      window.copyWallet = function () {
        const wallet = document.getElementById('walletAddress').textContent;
        navigator.clipboard.writeText(wallet);
        alert('Wallet address copied to clipboard!');
      };

      window.restartWizard = function () {
        document.getElementById('coinType').value = '';
        document.getElementById('depositAmount').value = '';
        document.getElementById('walletAddress').textContent = '';
        document.getElementById('paymentProof').value = '';
        showTab(0);
      };

      showTab(0);
    });
  </script>

@endsection