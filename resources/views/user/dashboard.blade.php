@extends('layout.default')

@section('title', 'Dashboard - Home')

@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">
    @include('partials.user.aside')
    <div class="content">
      @include('partials.user.nav')

      {{-- Animated Welcome Section --}}
      <div class="welcome-section mb-4 py-4 px-4 rounded-4 shadow-lg position-relative overflow-hidden">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
          <div>
            @php
              $hour = now()->hour;
              $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
            @endphp
            <h2 class="fw-bold mb-1 text-light">{{ $greeting }}, <br> {{ auth()->user()->username }}!</h2>
            <p class="mb-2 opacity-85">Here's a snapshot of your account activity and growth.</p>

            <div class="mt-3 d-flex gap-3 flex-wrap">
              <a href="{{ route('user.deposit.create') }}" class="btn btn-primary btn-lg shadow-lg modern-btn">Deposit</a>
              <a href="{{ route('user.withdrawals.index') }}" class="btn btn-warning btn-lg shadow-lg modern-btn text-white">Withdraw</a>
            </div>
          </div>
          <div class="d-none d-md-block">
            <img src="{{ asset('images/dashboard/modern-welcome.svg') }}" alt="Welcome illustration" class="welcome-img">
          </div>
        </div>

        {{-- Floating circles --}}
        <span class="float-circle circle-1"></span>
        <span class="float-circle circle-2"></span>
        <span class="float-circle circle-3"></span>
      </div>

      {{-- Flash Messages --}}
      @foreach (['success', 'error'] as $msg)
        @if(session($msg))
          <div class="alert alert-{{ $msg === 'success' ? 'success' : 'danger' }} alert-dismissible fade show mt-3">
            {{ session($msg) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif
      @endforeach

      {{-- Dashboard Stats --}}
      <div class="row g-3 mb-4">
        @php
          $totalBalance = ($currentBalance ?? 0) + ($profitBalance ?? 0);
          $cards = [
              ['title' => 'Total Balance', 'amount' => $totalBalance, 'icon' => 'fas fa-wallet', 'color' => '#6610f2'],
              ['title' => 'Main Wallet', 'amount' => $currentBalance ?? 0, 'icon' => 'fas fa-piggy-bank', 'color' => '#00c6ff'],
              ['title' => 'Profit Wallet', 'amount' => $profitBalance ?? 0, 'icon' => 'fas fa-coins', 'color' => '#fbbc04'],
              ['title' => "Today's Profit", 'amount' => $todayProfit ?? 0, 'icon' => 'fas fa-sun', 'color' => '#28a745'],
              ['title' => 'Current Invest', 'amount' => $totalInvested ?? 0, 'icon' => 'fas fa-wallet', 'color' => '#007bff'],
              ['title' => 'Total Deposit', 'amount' => $totalDeposits ?? 0, 'icon' => 'fas fa-wallet', 'color' => '#17a2b8'],
          ];
        @endphp
 
 
        @foreach($cards as $card)
          <div class="col-md-6 col-xxl-3">
            <div class="card dashboard-card shadow-lg modern-card h-100 position-relative overflow-hidden">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="fw-semibold mb-1">{{ $card['title'] }}</h6>
                  <h3 class="fw-bold mb-1">${{ number_format($card['amount'], 2) }}</h3>
                  <div class="trend-bar" style="background: linear-gradient(90deg, {{ $card['color'] }} 0%, rgba(255,255,255,0.2) 100%);"></div>
                </div>
                <div class="icon-wrapper" style="background-color: {{ $card['color'] }}33;">
                  <i class="{{ $card['icon'] }} fs-3" style="color: {{ $card['color'] }};"></i>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Earnings Chart --}}
      <div class="row g-3 mb-4">
        <div class="col-lg-12">
          <div class="card shadow-lg modern-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h6 class="mb-0">Earnings Overview (Last 30 Days)</h6>
              <span class="badge bg-primary px-3 py-2">Live Profit Updates</span>
            </div>
            <div class="card-body">
              <canvas id="earningsChart" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>

      {{-- Recent Transactions --}}
      <div class="row g-4 mt-4">
        <div class="col-lg-12">
          <div class="card shadow-lg modern-card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h6 class="mb-0">Recent Transactions</h6>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle modern-table">
                  <thead class="table-light">
                    <tr>
                      <th>Type</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $transactions = collect()
                            ->merge(auth()->user()->deposits()->latest()->take(10)->get())
                            ->merge(auth()->user()->investments()->latest()->take(10)->get())
                            ->merge(auth()->user()->withdrawals()->latest()->take(10)->get())
                            ->sortByDesc('created_at')
                            ->take(10);
                    @endphp
                    @forelse($transactions as $tx)
                        @php
                            $type = class_basename($tx);
                            $icon = match($type) {
                                'Deposit' => 'fas fa-arrow-down text-success',
                                'Investment' => 'fas fa-chart-line text-warning',
                                'Withdrawal' => 'fas fa-arrow-up text-danger',
                                default => 'fas fa-question-circle text-muted'
                            };
                            $status = $tx->status ?? 'completed';
                            $badge = match($status) {
                                'approved', 'completed' => 'bg-success',
                                'pending' => 'bg-warning',
                                'rejected' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <tr>
                          <td><i class="{{ $icon }}"></i> {{ $type }}</td>
                          <td>${{ number_format($tx->amount, 2) }}</td>
                          <td><span class="badge {{ $badge }}">{{ ucfirst($status) }}</span></td>
                          <td>{{ $tx->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">No recent transactions found</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      @include('partials.user.footer')
    </div>
  </div>
</main>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('earningsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels ?? []),
            datasets: [{
                label: 'Earnings',
                data: @json($chartData ?? []),
                fill: true,
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderColor: '#007bff',
                tension: 0.4,
                pointBackgroundColor: '#007bff',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '$' + Number(context.raw).toFixed(2);
                        }
                    }
                },
                legend: { display: false }
            },
            scales: {
                x: { title: { display: true, text: 'Date' } },
                y: { title: { display: true, text: 'Earnings ($)' }, beginAtZero: true }
            }
        }
    });
});
</script>

{{-- Modern CSS --}}
<style>
.welcome-section { background: linear-gradient(135deg, #1a73e8, #00c6ff); color: #fff; border-radius: 1rem; position: relative; overflow: hidden; transition: all 0.5s ease; }
.welcome-section .welcome-img { max-height: 120px; animation: float 3s ease-in-out infinite; }
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
.float-circle { position: absolute; border-radius: 50%; opacity: 0.2; background: #fff; }
.circle-1 { width: 60px; height: 60px; top: -20px; left: -20px; }
.circle-2 { width: 40px; height: 40px; bottom: -10px; right: 30px; }
.circle-3 { width: 80px; height: 80px; top: 30px; right: -40px; }

.modern-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border-radius: 1rem; transition: all 0.4s ease; }
.modern-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.2); }

.icon-wrapper { width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
.trend-bar { height: 4px; border-radius: 4px; margin-top: 6px; width: 100%; }
.modern-btn { min-width: 140px; font-weight: 500; transition: all 0.3s ease; }
.modern-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.15); }
.modern-table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); }
</style>
@endsection
