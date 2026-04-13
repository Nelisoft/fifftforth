@extends('layout.default')
@section('title')
Dashboard Active Plans
@endsection

@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">
    @include('partials.user.aside')
    <div class="content">
      @include('partials.user.nav')

      {{-- Flash messages --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="card mt-3 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Active Investments</h5>
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

                {{-- Status --}}
                <td class="status">
                  <span class="badge bg-success">Active</span>
                </td>

                {{-- Progress Bar --}}
                <td>
                  <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-success progress-bar-fill"
                        role="progressbar"
                        style="width: {{ $investment->progress }}%;">
                        {{ round($investment->progress) }}%
                    </div>
                  </div>
                </td>

                {{-- Remaining Time --}}
                <td class="remaining-time">
                    {{ $investment->remaining_time ?? 'Ended' }}
                </td>

                {{-- Profit --}}
                <td class="profit fw-semibold text-success">
                    {{ number_format($investment->profit, 2) }}
                </td>

                {{-- Actions --}}
                <td>
                  <form class="cancel-investment-form" method="POST"
                    action="{{ route('user.plans.cancel', $investment->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-outline-warning">Cancel</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center text-muted py-4">You have no active investments at the moment.</td>
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

    setInterval(() => {
        fetch("{{ route('user.plans.live') }}")
            .then(res => res.json())
            .then(investments => {
                investments.forEach(inv => {

                    if(inv.status !== 'active') return;

                    const row = document.querySelector(`#investment-${inv.id}`);
                    if (!row) return;

                    // Update progress bar
                    const progressBar = row.querySelector(".progress-bar-fill");
                    if (progressBar) {
                        progressBar.style.width = inv.progress + "%";
                        progressBar.textContent = Math.round(inv.progress) + "%";
                    }

                    // Update remaining time
                    const remaining = row.querySelector(".remaining-time");
                    if (remaining) remaining.textContent = inv.remaining_time;

                    // Update profit
                    const profit = row.querySelector(".profit");
                    if (profit) profit.textContent = parseFloat(inv.profit).toFixed(2);
                });
            })
            .catch(err => console.error("Live update failed:", err));
    }, 5000);

    // Cancel confirmation
    document.querySelectorAll('.cancel-investment-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Cancel Investment?',
                text: "Are you sure you want to cancel this investment?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) this.submit();
            });
        });
    });
});
</script>
@endsection
