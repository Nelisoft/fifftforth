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

        <!-- Withdrawal Wizard Card -->
        <div class="card theme-wizard mb-5" id="withdrawalWizard">
          <div class="card-header bg-body-tertiary pt-3 pb-2">
            <ul class="nav justify-content-between nav-wizard">
              <li class="nav-item">
                <a class="nav-link active fw-semi-bold" href="#wstep1" data-bs-toggle="tab">
                  <span class="nav-item-circle"><i class="fas fa-coins"></i></span>
                  <span class="d-none d-md-block mt-1 fs-10">Select Coin</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-semi-bold" href="#wstep2" data-bs-toggle="tab">
                  <span class="nav-item-circle"><i class="fas fa-wallet"></i></span>
                  <span class="d-none d-md-block mt-1 fs-10">Wallet Address</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-semi-bold" href="#wstep3" data-bs-toggle="tab">
                  <span class="nav-item-circle"><i class="fas fa-dollar-sign"></i></span>
                  <span class="d-none d-md-block mt-1 fs-10">Confirm Amount</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-semi-bold" href="#wstep4" data-bs-toggle="tab">
                  <span class="nav-item-circle"><i class="fas fa-check"></i></span>
                  <span class="d-none d-md-block mt-1 fs-10">Done</span>
                </a>
              </li>
            </ul>
          </div>

          <div class="card-body py-4">
            <div class="tab-content">
              <!-- STEP 1: Select Coin -->
              <div class="tab-pane active" id="wstep1">
                <form id="withdrawFormStep1">
                  <div class="mb-3">
                    <label class="form-label">Select Coin Type</label>
                    <select class="form-select" id="withdrawCoinType" required>
                      <option value="">Choose coin...</option>
                      <option value="BTC">Bitcoin (BTC)</option>
                      <option value="ETH">Ethereum (ETH)</option>
                      <option value="USDT">Tether (USDT)</option>
                    </select>
                  </div>
                </form>
              </div>

              <!-- STEP 2: Wallet Address -->
              <div class="tab-pane" id="wstep2">
                <form id="withdrawFormStep2">
                  <div class="mb-3">
                    <label class="form-label">Enter Your Wallet Address</label>
                    <input type="text" class="form-control" id="withdrawWalletAddress" placeholder="Paste your wallet address" required>
                  </div>
                </form>
              </div>

              <!-- STEP 3: Amount -->
              <div class="tab-pane" id="wstep3">
                <form id="withdrawFormStep3">
                  <div class="mb-3">
                    <label class="form-label">Withdrawal Amount (USD)</label>
                    <input type="number" class="form-control" id="withdrawAmount" placeholder="Enter amount to withdraw" required>
                  </div>
                  <p class="text-muted small">Note: Ensure the wallet address is correct. Transactions are irreversible.</p>
                </form>
              </div>

              <!-- STEP 4: Confirmation -->
              <div class="tab-pane text-center" id="wstep4">
                <h4 class="mb-1 text-success">Withdrawal Request Submitted!</h4>
                <p class="text-muted">Your withdrawal is being processed. Funds will be sent to your wallet soon.</p>
                <a href="#" class="btn btn-primary" onclick="restartWithdrawWizard()">Make Another Withdrawal</a>
              </div>
            </div>
          </div>

          <!-- Footer Navigation -->
          <div class="card-footer bg-body-tertiary">
            <div class="d-flex justify-content-between">
              <button class="btn btn-link" id="wprevBtn" type="button">
                <i class="fas fa-chevron-left me-2"></i>Prev
              </button>
              <button class="btn btn-primary" id="wnextBtn" type="button">
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
    const nextBtn = document.getElementById('wnextBtn');
    const prevBtn = document.getElementById('wprevBtn');
    let current = 0;

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
        const coin = document.getElementById('withdrawCoinType').value;
        if (!coin) return alert('Please select a coin type.');
      }
      if (current === 1) {
        const wallet = document.getElementById('withdrawWalletAddress').value.trim();
        if (!wallet) return alert('Please enter a valid wallet address.');
      }
      if (current === 2) {
        const amount = document.getElementById('withdrawAmount').value;
        if (!amount || amount <= 0) return alert('Please enter a valid amount.');
      }

      if (current < tabs.length - 1) showTab(current + 1);
    });

    prevBtn.addEventListener('click', () => {
      if (current > 0) showTab(current - 1);
    });

    window.restartWithdrawWizard = function () {
      document.getElementById('withdrawCoinType').value = '';
      document.getElementById('withdrawWalletAddress').value = '';
      document.getElementById('withdrawAmount').value = '';
      showTab(0);
    };

    showTab(0);
  });
</script>

@endsection
