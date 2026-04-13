<script>
    var isFluid = JSON.parse(localStorage.getItem('isFluid'));
    if (isFluid) {
        var container = document.querySelector('[data-layout]');
        container.classList.remove('container');
        container.classList.add('container-fluid');
    }
</script>

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
                data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>
        </div>
        <a class="navbar-brand" href="{{ route('user.dashboard') }}">
            <div class="d-flex align-items-center py-3">
                <img class="me-2"
                 src="{{ $settings && $settings->logo_dark ? asset('public/storage/' . $settings->logo_dark) : asset('assets/img/default-logo.png') }}" 
                    alt="Logo" width="200">
            </div>
        </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span>
                            <span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item mt-3 mb-2">
                    <div class="row navbar-vertical-label-wrapper">
                        <div class="col-auto navbar-vertical-label">Core</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>

                    <!-- Deposit -->
                    <a class="nav-link" href="{{ route('user.deposit.create') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-money-bill-alt"></span></span>
                            <span class="nav-link-text ps-1">Deposit</span>
                        </div>
                    </a>

                    <!-- Withdraw -->
                    <a class="nav-link" href="{{ route('user.withdrawals.index') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-university"></span></span>
                            <span class="nav-link-text ps-1">Withdraw</span>
                        </div>
                    </a>

                    <!-- KYC -->
                    <a class="nav-link" href="{{ route('user.kyc') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-id-card"></span></span>
                            <span class="nav-link-text ps-1">KYC Verification</span>
                        </div>
                    </a>

                    <!-- Investment -->
                    <a class="nav-link dropdown-indicator" href="#investment" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="investment">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-cog"></span></span>
                            <span class="nav-link-text ps-1">Investment</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="investment">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.plans.create') }}">
                                <span class="nav-link-text ps-1">Invest</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.plans.active') }}">
                                <span class="nav-link-text ps-1">Active Investments</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.plans.index') }}">
                                <span class="nav-link-text ps-1">All Investments</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Referrals -->
                <a class="nav-link" href="{{ route('user.referrals.index') }}" role="button">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span class="fas fa-user-friends"></span></span>
                        <span class="nav-link-text ps-1">Referrals</span>
                    </div>
                </a>

                <!-- History -->
                <a class="nav-link dropdown-indicator" href="#history" role="button" data-bs-toggle="collapse"
                    aria-expanded="false" aria-controls="history">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span class="fas fa-chart-line"></span></span>
                        <span class="nav-link-text ps-1">History</span>
                    </div>
                </a>
                <ul class="nav collapse" id="history">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.history.deposits') }}">
                            <span class="nav-link-text ps-1">Deposit History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.withdrawals.history') }}">
                            <span class="nav-link-text ps-1">Withdrawal History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.plans.index') }}">
                            <span class="nav-link-text ps-1">Investment History</span>
                        </a>
                    </li>
                </ul>

                <!-- Profile -->
                <a class="nav-link" href="{{ route('user.profile') }}" role="button">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span class="fas fa-user-cog"></span></span>
                        <span class="nav-link-text ps-1">Profile Settings</span>
                    </div>
                </a>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;"></nav>
