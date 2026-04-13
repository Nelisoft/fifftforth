@extends('layout.default')
@section('title')
Dashboard Withdraw
@endsection

@section('content')
<main class="main" id="top">
  <div class="container" data-layout="container">
    <div class="row justify-content-center pt-6">
      <div class="col-sm-10 col-lg-7 col-xxl-5">

        {{-- FLASH MESSAGES --}}
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        {{-- WITHDRAWAL FORM --}}
        <form id="withdrawWizardForm" action="{{ route('user.withdrawals.store') }}" method="POST">
          @csrf

          {{-- Hidden Inputs --}}
          <input type="hidden" name="coin_type" id="coinTypeInput">
          <input type="hidden" name="amount" id="amountInput">
          <input type="hidden" name="wallet_address" id="walletInput">

          <div class="card theme-wizard shadow-lg border-0 mb-5" id="withdrawWizard">

            <div class="card-header bg-body-tertiary pt-3 pb-2">
              <ul class="nav justify-content-between nav-wizard">
                <li class="nav-item">
                  <a class="nav-link active fw-semi-bold" href="#step1" data-bs-toggle="tab">
                    <span class="nav-item-circle"><i class="fas fa-wallet"></i></span>
                    <span class="d-none d-md-block mt-1 fs-10">Details</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-semi-bold" href="#step2" data-bs-toggle="tab">
                    <span class="nav-item-circle"><i class="fas fa-check-circle"></i></span>
                    <span class="d-none d-md-block mt-1 fs-10">Confirm</span>
                  </a>
                </li>
              </ul>
            </div>

            <div class="card-body py-4">
              <div class="tab-content">

                {{-- STEP 1: WITHDRAWAL DETAILS --}}
                <div class="tab-pane active fade show" id="step1">
                  <h5 class="fw-bold mb-3">Withdrawal Details</h5>

                  {{-- TOTAL BALANCE --}}
                  @php
                      $totalBalance = ($user->balance ?? 0) + ($user->profit_balance ?? ($user->profit ?? 0));
                  @endphp

                  <div class="alert alert-info shadow-sm">
                    <strong>Total Available Balance:</strong>
                    ${{ number_format($totalBalance, 2) }}
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Network (TRC20, BEP20, ERC20, BTC)</label>
                    <input type="text" id="coinType" class="form-control"
                      placeholder="Enter network type" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Wallet Address</label>
                    <input type="text" id="walletAddress" class="form-control"
                      placeholder="Enter your wallet address" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold">Amount ($)</label>
                    <input type="number" id="withdrawAmount" class="form-control"
                      placeholder="Enter amount" min="1" step="0.01" required>
                  </div>
                </div>

                {{-- STEP 2: CONFIRMATION --}}
                <div class="tab-pane fade" id="step2">
                  <div class="text-center">
                    <h5 class="fw-bold mb-3">Review Withdrawal</h5>

                    <div class="text-start px-4">
                      <p><strong>Network:</strong> <span id="reviewCoinType"></span></p>
                      <p><strong>Amount:</strong> $<span id="reviewAmount"></span></p>
                      <p><strong>Wallet Address:</strong> <span id="reviewWallet"></span></p>
                    </div>

                    <p class="text-warning mt-3">
                      <i class="fas fa-info-circle"></i>
                      Please double-check all details — withdrawals cannot be reversed.
                    </p>
                  </div>
                </div>

              </div>
            </div>

            <div class="card-footer bg-body-tertiary">
              <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary" id="prevBtn" type="button">Previous</button>
                <button class="btn btn-primary px-4" id="nextBtn" type="button">Next</button>
              </div>
            </div>

          </div>
        </form>

      </div>
    </div>
  </div>
</main>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const tabs = document.querySelectorAll('.nav-wizard .nav-link');
  const nextBtn = document.getElementById('nextBtn');
  const prevBtn = document.getElementById('prevBtn');
  const form = document.getElementById('withdrawWizardForm');
  let current = 0;

  function showTab(index) {
    tabs[current].classList.remove('active');
    document.querySelector(tabs[current].getAttribute('href')).classList.remove('active', 'show');

    current = index;
    tabs[current].classList.add('active');
    document.querySelector(tabs[current].getAttribute('href')).classList.add('active', 'show');

    prevBtn.disabled = current === 0;
    nextBtn.textContent = current === tabs.length - 1 ? 'Submit' : 'Next';
  }

  nextBtn.addEventListener('click', () => {
    if (current === 0) {
      const coin = document.getElementById('coinType').value.trim();
      const amount = document.getElementById('withdrawAmount').value;
      const wallet = document.getElementById('walletAddress').value.trim();

      if (!coin) return Swal.fire('Oops!', 'Please enter a network type.', 'warning');
      if (!amount || amount <= 0) return Swal.fire('Oops!', 'Please enter a valid amount.', 'warning');
      if (!wallet) return Swal.fire('Oops!', 'Please enter a wallet address.', 'warning');

      document.getElementById('coinTypeInput').value = coin;
      document.getElementById('amountInput').value = amount;
      document.getElementById('walletInput').value = wallet;

      document.getElementById('reviewCoinType').textContent = coin;
      document.getElementById('reviewAmount').textContent = amount;
      document.getElementById('reviewWallet').textContent = wallet;
    }

    if (current === 1) {
      Swal.fire({
        title: 'Confirm Withdrawal',
        html:
          `<p><strong>Network:</strong> ${document.getElementById('reviewCoinType').textContent}</p>
           <p><strong>Amount:</strong> $${document.getElementById('reviewAmount').textContent}</p>
           <p><strong>Wallet:</strong> ${document.getElementById('reviewWallet').textContent}</p>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Submit Withdrawal'
      }).then((result) => {
        if (result.isConfirmed) {
          nextBtn.disabled = true;
          nextBtn.textContent = 'Submitting...';
          form.submit();
        }
      });
      return;
    }

    if (current < tabs.length - 1) showTab(current + 1);
  });

  prevBtn.addEventListener('click', () => {
    if (current > 0) showTab(current - 1);
  });

  showTab(0);
});
</script>
@endsection
