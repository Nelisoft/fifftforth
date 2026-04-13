@extends('layout.default')
@section('title')
    Dashboard Investments
@endsection

@section('content')
<main class="main" id="top">
    <div class="container-fluid px-3" data-layout="container">

        @include('partials.user.aside')

        <div class="content">

            @include('partials.user.nav')

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card mt-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Investments</h5>
                    <a href="{{ route('user.plans.create') }}" class="btn btn-sm btn-primary">+ New Investment</a>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover align-middle text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Plan</th>
                                <th>Amount ($)</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Remaining</th>
                                <th>Profit ($)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="investment-table-body">

                        @forelse($investments as $investment)
                            <tr id="investment-{{ $investment->id }}">

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $investment->plan->name }}</td>
                                <td>{{ number_format($investment->amount, 2) }}</td>

                                {{-- STATUS --}}
                                <td class="status">
                                    @if($investment->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($investment->status === 'cancelled')
                                        <span class="badge bg-secondary">Cancelled</span>
                                    @else
                                        <span class="badge bg-primary">Completed</span>
                                    @endif
                                </td>

                                {{-- PROGRESS BAR --}}
                                <td>
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar bg-success progress-bar-fill"
                                             role="progressbar"
                                             style="width: {{ $investment->progress }}%;">
                                            {{ round($investment->progress) }}%
                                        </div>
                                    </div>
                                </td>

                                {{-- REMAINING TIME --}}
                                <td class="remaining-time">
                                    {{ $investment->remaining_time ?? 'Ended' }}
                                </td>

                                {{-- PROFIT --}}
                                <td class="profit fw-semibold text-success">
                                    {{ number_format($investment->profit, 2) }}
                                </td>

                                {{-- ACTIONS --}}
                                <td>
                                    @if($investment->status === 'active')
                                        <form class="cancel-investment-form" method="POST"
                                              action="{{ route('user.plans.cancel', $investment->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-warning">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled>Cancel</button>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    You have no investments yet.
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $investments->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>

            @include('partials.user.footer')

        </div>
    </div>
</main>

{{-- LIVE UPDATES --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // 🔄 Live updates every 5 seconds
    setInterval(() => {
        fetch("{{ route('user.plans.live') }}")
        .then(res => res.json())
        .then(investments => {
            investments.forEach(inv => {

                const row = document.querySelector(`#investment-${inv.id}`);
                if (!row) return;

                // Progress Bar
                const bar = row.querySelector(".progress-bar-fill");
                if (bar) {
                    bar.style.width = inv.progress + "%";
                    bar.textContent = Math.round(inv.progress) + "%";
                }

                // Remaining Time
                const remain = row.querySelector(".remaining-time");
                if (remain) remain.textContent = inv.remaining_time;

                // Profit
                const profit = row.querySelector(".profit");
                if (profit) profit.textContent = parseFloat(inv.profit).toFixed(2);

                // Status Badge
                const status = row.querySelector(".status");
                if (status) {
                    let badge = '';
                    if (inv.status === 'active') badge = '<span class="badge bg-success">Active</span>';
                    else if (inv.status === 'cancelled') badge = '<span class="badge bg-secondary">Cancelled</span>';
                    else badge = '<span class="badge bg-primary">Completed</span>';
                    status.innerHTML = badge;
                }
            });
        })
        .catch(console.error);
    }, 5000);


    // ❗ Cancel confirmation
    document.querySelectorAll('.cancel-investment-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Cancel Investment?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it',
                cancelButtonText: 'No'
            }).then((res) => {
                if (res.isConfirmed) form.submit();
            });
        });
    });

});
</script>
@endsection
