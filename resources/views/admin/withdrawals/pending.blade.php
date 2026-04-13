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
      @if(session('success'))
        <script>
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
          });
        </script>
      @elseif(session('error'))
        <script>
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            timer: 2000,
            showConfirmButton: false
          });
        </script>
      @endif

      <div class="card shadow-sm mt-3">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h5 class="mb-0">Pending Withdrawals</h5>
          <form method="GET" action="{{ route('admin.withdrawals.pending') }}" class="mt-2 mt-lg-0">
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
                  <th>Amount (USD)</th>
                  <th>Wallet Address</th>
                  <th>Status</th>
                  <th class="text-end">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($withdrawals as $withdrawal)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $withdrawal->user->fullname }} ({{ $withdrawal->user->username }})</td>
                  <td>{{ number_format($withdrawal->amount, 2) }}</td>
                  <td>
                    @if($withdrawal->wallet_address)
                      <div class="d-flex align-items-center gap-2">
                        <span id="wallet-{{ $withdrawal->id }}">{{ $withdrawal->wallet_address }}</span>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="copyToClipboard('wallet-{{ $withdrawal->id }}')">
                          <i class="fas fa-copy"></i>
                        </button>
                      </div>
                    @else N/A @endif
                  </td>
                  <td><span class="badge bg-warning">Pending</span></td>
                  <td class="text-end d-flex gap-2">
                    {{-- Approve Form --}}
                    <form method="POST" action="{{ route('admin.withdrawals.update', $withdrawal->id) }}" class="approve-form">
                      @csrf
                      <input type="hidden" name="status" value="approved">
                      <button type="submit" class="btn btn-outline-success btn-sm" data-action="approve">
                        <i class="fas fa-check me-1"></i> Approve
                      </button>
                    </form>

                    {{-- Reject Form --}}
                    <form method="POST" action="{{ route('admin.withdrawals.update', $withdrawal->id) }}" class="reject-form">
                      @csrf
                      <input type="hidden" name="status" value="rejected">
                      <button type="submit" class="btn btn-outline-danger btn-sm" data-action="reject">
                        <i class="fas fa-times me-1"></i> Reject
                      </button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-4">No pending withdrawals found.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

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
  // Copy wallet
  function copyToClipboard(elementId) {
    const text = document.getElementById(elementId).textContent;
    navigator.clipboard.writeText(text).then(() => {
      Swal.fire({
        icon: 'success',
        title: 'Copied!',
        text: 'Wallet address copied to clipboard.',
        timer: 1500,
        showConfirmButton: false
      });
    });
  }

  // SweetAlert for approve/reject
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.approve-form, .reject-form').forEach(form => {
      form.querySelector('button[type="submit"]').addEventListener('click', function(e) {
        e.preventDefault();
        const action = this.dataset.action;

        Swal.fire({
          title: 'Are you sure?',
          text: `Do you want to ${action} this withdrawal?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, proceed!',
          cancelButtonText: 'Cancel'
        }).then(result => {
          if (result.isConfirmed) form.submit();
        });
      });
    });
  });
</script>
@endsection
