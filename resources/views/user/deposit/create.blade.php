@extends('layout.default')
@section('title')
Dashboard Deposit
    
@endsection

@section('content')
<main class="main" id="top">
    <div class="container" data-layout="container">
        <div class="row justify-content-center pt-6">
            <div class="col-sm-10 col-lg-7 col-xxl-5">

                <!-- Deposit Wizard -->
                <form id="depositWizardForm" action="{{ route('user.deposit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="wallet_id" id="walletInput">
                    <input type="hidden" name="coin_type" id="coinInput">
                    <input type="hidden" name="amount" id="amountInput">

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
                            </ul>
                        </div>

                        <div class="card-body py-4">
                            <div class="tab-content">
                                <!-- STEP 1: Select Coin -->
                                <div class="tab-pane active" id="step1">
                                    <div class="mb-3">
                                        <label class="form-label">Select Coin Type</label>
                                        <select class="form-select" id="coinType" required>
                                            <option value="">Choose coin...</option>
                                            @foreach($wallets as $wallet)
                                                <option value="{{ $wallet->coin_type }}" 
                                                        data-wallet-id="{{ $wallet->id }}" 
                                                        data-address="{{ $wallet->wallet_address }}">
                                                    {{ $wallet->coin_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Amount (USD)</label>
                                        <input type="number" class="form-control" id="depositAmount" placeholder="Enter deposit amount" required>
                                    </div>
                                </div>

                                <!-- STEP 2: Wallet -->
                                <div class="tab-pane" id="step2">
                                    <div id="walletDetails" class="text-center">
                                        <h5 class="mb-2">Deposit Address</h5>
                                        <p id="walletAddress" class="fw-bold text-primary fs-5"></p>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyWallet()">Copy Address</button>
                                    </div>
                                </div>

                                <!-- STEP 3: Upload Proof -->
                                <div class="tab-pane" id="step3">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Payment Proof (image or PDF)</label>
                                        <input type="file" class="form-control" name="payment_proof" id="paymentProof" accept="image/*,.pdf" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-body-tertiary">
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-link" id="prevBtn" type="button">Prev</button>
                                <button class="btn btn-primary" id="nextBtn" type="button">Next</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

{{-- SweetAlert CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.nav-wizard .nav-link');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    let current = 0;

    function showTab(index) {
        tabs[current].classList.remove('active');
        document.querySelector(tabs[current].getAttribute('href')).classList.remove('active');
        current = index;
        tabs[current].classList.add('active');
        document.querySelector(tabs[current].getAttribute('href')).classList.add('active');
        prevBtn.disabled = current === 0;
        nextBtn.textContent = current === tabs.length - 1 ? 'Submit' : 'Next';
    }

    nextBtn.addEventListener('click', () => {
        if (current === 0) {
            const coinSelect = document.getElementById('coinType');
            const coin = coinSelect.value;
            const amount = document.getElementById('depositAmount').value;
            if (!coin) {
                Swal.fire('Oops!', 'Please select a coin type.', 'warning');
                return;
            }
            if (!amount || amount <= 0) {
                Swal.fire('Oops!', 'Please enter a valid amount.', 'warning');
                return;
            }

            const selectedOption = coinSelect.options[coinSelect.selectedIndex];
            const walletAddress = selectedOption.getAttribute('data-address');
            const walletId = selectedOption.getAttribute('data-wallet-id');

            document.getElementById('walletAddress').textContent = walletAddress || 'Wallet not available.';
            document.getElementById('coinInput').value = coin;
            document.getElementById('amountInput').value = amount;
            document.getElementById('walletInput').value = walletId;
        }

        if (current === 2) {
            const proof = document.getElementById('paymentProof').files[0];
            if (!proof) {
                Swal.fire('Oops!', 'Please upload your payment proof.', 'warning');
                return;
            }
            document.getElementById('depositWizardForm').submit();
            return;
        }

        if (current < tabs.length - 1) showTab(current + 1);
    });

    prevBtn.addEventListener('click', () => {
        if (current > 0) showTab(current - 1);
    });

    window.copyWallet = function () {
        const wallet = document.getElementById('walletAddress').textContent;
        navigator.clipboard.writeText(wallet);
        Swal.fire('Copied!', 'Wallet address copied to clipboard!', 'success');
    };

    showTab(0);
});
</script>
@endsection
