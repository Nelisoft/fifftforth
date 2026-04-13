@extends('layout.default')
@section('title')
Admin Dashboard - Home
    
@endsection
@section('content')
<main class="main" id="top">
    <div class="container" data-layout="container">
        @include('partials.admin.aside')
        <div class="content">
            @include('partials.admin.nav')

            <!-- ================== Stats Section ================== -->
            <div class="row g-3 mb-4">
                <!-- Total Users -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-1">Total Users</h6>
                                <h3 class="fw-bold mb-2">{{ number_format($totalUsers ?? 0) }}</h3>
                                <small class="text-success">Active users overall</small>
                            </div>
                            <div class="icon bg-primary text-white rounded-circle p-3">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Deposits -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-1">Total Deposits</h6>
                                <h3 class="fw-bold mb-2">${{ number_format($totalDeposits ?? 0, 2) }}</h3>
                                <small class="text-success">Funds added by users</small>
                            </div>
                            <div class="icon bg-success text-white rounded-circle p-3">
                                <i class="fas fa-dollar-sign fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Investments -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-1">Total Investments</h6>
                                <h3 class="fw-bold mb-2">${{ number_format($totalInvestments ?? 0, 2) }}</h3>
                                <small class="text-success">Invested funds</small>
                            </div>
                            <div class="icon bg-warning text-white rounded-circle p-3">
                                <i class="fas fa-chart-line fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Withdrawals -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-1">Total Withdrawals</h6>
                                <h3 class="fw-bold mb-2">${{ number_format($totalWithdrawals ?? 0, 2) }}</h3>
                                <small class="text-danger">Funds withdrawn</small>
                            </div>
                            <div class="icon bg-danger text-white rounded-circle p-3">
                                <i class="fas fa-money-bill-wave fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================== Mini Stats / Trends ================== -->
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted">Today's Deposits</h6>
                            <h4 class="fw-bold mb-2">${{ number_format($todayDeposits ?? 0, 2) }}</h4>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 70%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted">Today's Investments</h6>
                            <h4 class="fw-bold mb-2">${{ number_format($todayInvestments ?? 0, 2) }}</h4>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 55%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted">Today's Withdrawals</h6>
                            <h4 class="fw-bold mb-2">${{ number_format($todayWithdrawals ?? 0, 2) }}</h4>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 40%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h6 class="text-uppercase text-muted mb-2">Quick Actions</h6>
                            <a href="{{ route('admin.deposits.index') }}" class="btn btn-primary btn-sm w-100 mb-2">View Deposits</a>
                            <a href="{{ route('admin.plans.index') }}" class="btn btn-warning btn-sm w-100 mb-2">View Investments</a>
                            <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-danger btn-sm w-100">View Withdrawals</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================== Recent Transactions ================== -->
            <div class="row g-4 mt-4">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Recent Transactions</h6>
                            {{-- <a href="" class="btn btn-sm btn-outline-primary">View All</a> --}}
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>User</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $transactions = collect()
                                                ->merge(\App\Models\Deposit::with('user')->latest()->take(10)->get())
                                                ->merge(\App\Models\Investment::with('user')->latest()->take(10)->get())
                                                ->merge(\App\Models\Withdrawal::with('user')->latest()->take(10)->get())
                                                ->sortByDesc('created_at')
                                                ->take(10);
                                        @endphp

                                        @foreach($transactions as $tx)
                                            @php
                                                $type = class_basename($tx);
                                                $icon = $type === 'Deposit' ? 'fas fa-arrow-down text-success' 
                                                      : ($type === 'Investment' ? 'fas fa-chart-line text-warning'
                                                      : 'fas fa-arrow-up text-danger');

                                                $status = $tx->status ?? 'completed';
                                                $badge = $status === 'approved' || $status === 'completed' ? 'bg-success' 
                                                       : ($status === 'pending' ? 'bg-warning' : 'bg-danger');
                                            @endphp
                                            <tr>
                                                <td>{{ $tx->user->fullname }}</td>
                                                <td><i class="{{ $icon }}"></i> {{ $type }}</td>
                                                <td>${{ number_format($tx->amount, 2) }}</td>
                                                <td><span class="badge {{ $badge }}">{{ ucfirst($status) }}</span></td>
                                                <td>{{ $tx->created_at->format('d M Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.admin.footer')
        </div>
    </div>
</main>
@endsection
