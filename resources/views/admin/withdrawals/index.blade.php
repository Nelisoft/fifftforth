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

      <div class="card shadow-sm mt-3" id="withdrawalsTable">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h5 class="mb-0">All Withdrawals</h5>

          <!-- Search -->
          <form method="GET" action="{{ route('admin.withdrawals.index') }}" class="mt-2 mt-lg-0">
            <div class="input-group input-group-sm">
              <input type="search" name="search" class="form-control" placeholder="Search withdrawals..." value="{{ request('search') }}">
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
                  <th>Network</th>
                  <th>Wallet Address</th>
                  <th>Amount ($)</th>
                  <th>From</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th class="text-end">Action</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($withdrawals as $withdrawal)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    {{ $withdrawal->user->fullname ?? $withdrawal->user->name }}
                    <br>
                    <small class="text-muted">{{ $withdrawal->user->email }}</small>
                  </td>
                  <td>{{ strtoupper($withdrawal->coin_type) }}</td>
                  <td><code>{{ $withdrawal->wallet_address }}</code></td>
                  <td>${{ number_format($withdrawal->amount, 2) }}</td>
                  <td>
                    @if($withdrawal->from_balance === 'profit')
                      <span class="badge bg-success">Profit</span>
                    @else
                      <span class="badge bg-primary">Main</span>
                    @endif
                  </td>
                  <td>
                    @if($withdrawal->status == 'pending')
                      <span class="badge bg-warning">Pending</span>
                    @elseif($withdrawal->status == 'approved')
                      <span class="badge bg-success">Approved</span>
                    @else
                      <span class="badge bg-danger">Rejected</span>
                    @endif
                  </td>
                  <td>{{ $withdrawal->created_at->format('Y-m-d H:i') }}</td>
                  <td class="text-end">
                    @if($withdrawal->status == 'pending')
                      <div class="d-flex justify-content-end gap-2">
                        {{-- Approve --}}
                        <form method="POST" action="{{ route('admin.withdrawals.update', $withdrawal->id) }}" class="action-form">
                          @csrf
                          <input type="hidden" name="status" value="approved">
                          <button type="submit" class="btn btn-success btn-sm" data-action="approve">
                            <i class="fas fa-check me-1"></i> Approve
                          </button>
                        </form>

                        {{-- Reject --}}
                        <form method="POST" action="{{ route('admin.withdrawals.update', $withdrawal->id) }}" class="action-form">
                          @csrf
                          <input type="hidden" name="status" value="rejected">
                          <button type="submit" class="btn btn-danger btn-sm" data-action="reject">
                            <i class="fas fa-times me-1"></i> Reject
                          </button>
                        </form>
                      </div>
                    @else
                      <span class="text-muted">No action</span>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="9" class="text-center text-muted py-4">No withdrawals found.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-end">
         {{ $withdrawals->onEachSide(1)->links('pagination::bootstrap-5') }}

        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // SweetAlert confirmation before approve/reject
  document.querySelectorAll('.action-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const action = this.querySelector('button[type="submit"]').dataset.action;
      Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to ${action} this withdrawal?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, proceed!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      });
    });
  });
});
</script>
@endsection
