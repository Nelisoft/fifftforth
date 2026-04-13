@extends('layout.default')
@section('title', 'Withdrawal History')

@section('content')
<main class="main" id="top">
    <div class="container-fluid px-3" data-layout="container">
        @include('partials.user.aside')
        <div class="content">
            @include('partials.user.nav')

            {{-- ✅ Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- 💰 Withdrawal History Table --}}
            <div class="card mt-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Withdrawal History</h5>
                    <a href="{{ route('user.withdrawals.index') }}" class="btn btn-sm btn-primary">+ New Withdrawal</a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Coin</th>
                                <th>Wallet Address</th>
                                <th>Amount ($)</th>
                                <th>Status</th>
                                <th>Date Requested</th>
                                <th>Date Processed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawals as $withdrawal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ strtoupper($withdrawal->coin_type) }}</td>
                                    <td>{{ $withdrawal->wallet_address }}</td>
                                    <td>${{ number_format($withdrawal->amount, 2) }}</td>

                                    {{-- Status --}}
                                    <td>
                                        @if($withdrawal->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($withdrawal->status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($withdrawal->status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>

                                    <td>{{ $withdrawal->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        @if($withdrawal->status !== 'pending' && $withdrawal->updated_at)
                                            {{ $withdrawal->updated_at->format('M d, Y h:i A') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No withdrawals yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $withdrawals->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

            @include('partials.user.footer')
        </div>
    </div>
</main>
@endsection
