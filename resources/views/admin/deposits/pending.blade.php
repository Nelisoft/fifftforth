@extends('layout.default')
@section('title')
    Admin Dashboard
@endsection
@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">

    @include('partials.admin.aside')

    <div class="content">
      @include('partials.admin.nav')

      {{-- Flash Messages --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card shadow-sm mt-3" id="depositsTable">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h5 class="mb-0">Pending Deposits</h5>

          <!-- Search -->
          <form method="GET" action="{{ route('admin.deposits.pending') }}" class="mt-2 mt-lg-0">
            <div class="input-group input-group-sm">
              <input type="search" name="search" class="form-control" placeholder="Search deposits..." value="{{ request('search') }}">
              <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive scrollbar" style="max-height: 70vh; overflow-x: auto;">
            <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>User</th>
                  <th>Coin</th>
                  <th>Amount (USD)</th>
                  <th>Payment Proof</th>
                  <th>Status</th>
                  <th class="text-end">Action</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($deposits as $deposit)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $deposit->user->fullname }} ({{ $deposit->user->username }})</td>
                  <td>{{ $deposit->wallet->coin_type }}</td>
                  <td>{{ number_format($deposit->amount, 2) }}</td>
                  <td>
                    @if($deposit->payment_proof)
                      <a href="{{ asset('public/storage/'.$deposit->payment_proof) }}" target="_blank">View Proof</a>
                    @else
                      N/A
                    @endif
                  </td>
                  <td>
                    <span class="badge bg-warning">Pending</span>
                  </td>
                  <td class="text-end">
                    <div class="d-flex justify-content-end gap-2">
                      <form class="approve-form" method="POST" action="{{ route('admin.deposits.approve', $deposit->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">
                          <i class="fas fa-check me-1"></i> Approve
                        </button>
                      </form>
                      <form class="reject-form" method="POST" action="{{ route('admin.deposits.reject', $deposit->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger btn-sm">
                          <i class="fas fa-times me-1"></i> Reject
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center text-muted py-4">No pending deposits found.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-end">
          {{ $deposits->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Approve confirmation
    document.querySelectorAll('.approve-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Approve Deposit?',
                text: "Are you sure you want to approve this deposit?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Reject confirmation
    document.querySelectorAll('.reject-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Reject Deposit?',
                text: "Are you sure you want to reject this deposit?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Flash message with SweetAlert2
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});
</script>
@endsection
