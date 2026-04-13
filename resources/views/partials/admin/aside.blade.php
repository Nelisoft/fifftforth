<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
  <script>
    var navbarStyle = localStorage.getItem("navbarStyle");
    if (navbarStyle && navbarStyle !== 'transparent') {
      document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
    }
  </script>
  <div class="d-flex align-items-center">
    <div class="toggle-icon-wrapper">
      <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
        data-bs-placement="left" title="Toggle Navigation">
        <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
      </button>
    </div>
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
      <div class="d-flex align-items-center py-3">
        <img class="me-2"
          src="{{ $settings && $settings->logo_dark ? asset('public/storage/' . $settings->logo_dark) : asset('assets/img/default-logo.png') }}"
          alt="Logo" width="200">

        {{-- <span class="font-sans-serif text-primary">Admin</span> --}}
      </div>
    </a>
  </div>

  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <div class="navbar-vertical-content scrollbar">
      <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">

        <!-- Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span>
              <span class="nav-link-text ps-1">Dashboard</span>
            </div>
          </a>
        </li>

        <!-- Core Label -->
        <li class="nav-item">
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Core</div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider">
            </div>
          </div>
        </li>

        <!-- Users -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users.index') }}">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><span class="fas fa-users"></span></span>
              <span class="nav-link-text ps-1">Users</span>
            </div>
          </a>
        </li>

        <!-- KYC Management -->
        @php
          use App\Models\User; // <-- Add this

          $pendingKycCount = User::where('kyc_status', 'pending')->count();
        @endphp
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.kyc.index') }}">
            <div class="d-flex align-items-center justify-content-between w-100">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon"><span class="fas fa-id-card"></span></span>
                <span class="nav-link-text ps-1">KYC Requests</span>
              </div>
              @if($pendingKycCount > 0)
                <span class="badge bg-warning rounded-pill">{{ $pendingKycCount }}</span>
              @endif
            </div>
          </a>
        </li>


        <!-- Manage Deposits -->
        @php
          use App\Models\Deposit;
          $pendingCount = Deposit::where('status', 'pending')->count();
        @endphp
        <li class="nav-item">
          <a class="nav-link dropdown-indicator" href="#deposit" role="button" data-bs-toggle="collapse"
            aria-expanded="false" aria-controls="deposit">
            <div class="d-flex align-items-center justify-content-between w-100">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon"><span class="fas fa-wallet"></span></span>
                <span class="nav-link-text ps-1">Manage Deposits</span>
              </div>
              @if($pendingCount > 0)
                <span class="badge bg-danger rounded-pill">{{ $pendingCount }}</span>
              @endif
            </div>
          </a>
          <ul class="nav collapse" id="deposit">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.deposits.pending') }}">
                <div class="d-flex align-items-center justify-content-between w-100">
                  <span class="nav-link-text ps-1">Pending Deposits</span>
                  @if($pendingCount > 0)
                    <span class="badge bg-danger rounded-pill">{{ $pendingCount }}</span>
                  @endif
                </div>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.deposits.index') }}">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">All Deposits</span></div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Manage Withdrawals -->
        @php
          use App\Models\Withdrawal;
          $pendingWithdrawals = Withdrawal::where('status', 'pending')->count();
        @endphp
        <li class="nav-item">
          <a class="nav-link dropdown-indicator" href="#withdrawal" role="button" data-bs-toggle="collapse"
            aria-expanded="false" aria-controls="withdrawal">
            <div class="d-flex align-items-center justify-content-between w-100">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon"><span class="fas fa-coins"></span></span>
                <span class="nav-link-text ps-1">Manage Withdrawals</span>
              </div>
              @if($pendingWithdrawals > 0)
                <span class="badge bg-warning rounded-pill">{{ $pendingWithdrawals }}</span>
              @endif
            </div>
          </a>
          <ul class="nav collapse" id="withdrawal">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.withdrawals.pending') }}">
                <div class="d-flex align-items-center justify-content-between w-100">
                  <span class="nav-link-text ps-1">Pending Withdrawals</span>
                  @if($pendingWithdrawals > 0)
                    <span class="badge bg-warning rounded-pill">{{ $pendingWithdrawals }}</span>
                  @endif
                </div>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.withdrawals.index') }}">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">All Withdrawals</span></div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Plans -->
        <li class="nav-item">
          <a class="nav-link dropdown-indicator" href="#plans" role="button" data-bs-toggle="collapse"
            aria-expanded="false" aria-controls="plans">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><span class="fas fa-cog"></span></span>
              <span class="nav-link-text ps-1">Plans</span>
            </div>
          </a>
          <ul class="nav collapse" id="plans">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.plans.index') }}">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">All Plans</span></div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.plans.create') }}">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Create Plan</span></div>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Settings</div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider">
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link dropdown-indicator" href="#settings" role="button" data-bs-toggle="collapse"
            aria-expanded="false" aria-controls="plans">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><span class="fas fa-cog"></span></span>
              <span class="nav-link-text ps-1">General Settings</span>
            </div>
          </a>
          <ul class="nav collapse" id="settings">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.app.settings') }}">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">System Setting</span></div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.withdrawal-settings.index') }}">

                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Withdrawal Settings</span></div>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.wallets.index') }}">
                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Set Deposit Methods</span></div>
              </a>
            </li>

          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>

<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;"></nav>