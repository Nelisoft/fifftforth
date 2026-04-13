@extends('layout.default')

@section('title')
Admin Dashboard - KYC Management
@endsection

@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">

    @include('partials.admin.aside')
    <div class="content">
      @include('partials.admin.nav')

      {{-- Flash Messages --}}
      @if (session('success'))
        <script>
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            timer: 2500,
            showConfirmButton: false
          });
        </script>
      @elseif (session('error'))
        <script>
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            timer: 2500,
            showConfirmButton: false
          });
        </script>
      @endif

      <div class="card shadow-sm mt-3" id="kycTable">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h5 class="mb-0">KYC Requests</h5>

          <!-- Search -->
          <form method="GET" action="{{ route('admin.kyc.index') }}" class="mt-2 mt-lg-0">
            <div class="input-group input-group-sm">
              <input type="search" name="search" class="form-control" placeholder="Search KYC..." value="{{ request('search') }}">
              <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive scrollbar" style="max-height: 70vh; overflow-x: auto;">
            <!-- Bulk KYC form (POST) -->
            <form id="bulkKycForm" action="{{ route('admin.kyc.bulk') }}" method="POST">
              @csrf
              <input type="hidden" name="action" id="kyc_action_type">

              <table class="table table-bordered mb-0">
                <thead>
                  <tr>
                    <th><input type="checkbox" id="selectAllKyc"></th>
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Document</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Action</th>
                  </tr>
                </thead>
            <tbody>
  @foreach($kycRequests as $user)
  <tr>
    <td><input type="checkbox" class="kyc-checkbox" name="kyc_ids[]" value="{{ $user->id }}"></td>
    <td>{{ $loop->iteration }}</td>
    <td>
      <a href="{{ route('admin.kyc.show', $user->id) }}" class="text-decoration-none">
        {{ $user->fullname }}
      </a>
    </td>
    <td>{{ $user->email }}</td>
    <td>
      @if($user->kyc_document)
        <a href="{{ asset('public/storage/' . $user->kyc_document) }}" target="_blank">View Document</a>
      @else
        N/A
      @endif
    </td>
    <td>{{ ucfirst($user->kyc_status) }}</td>
    <td>{{ $user->kyc_submitted_at?->format('d M Y H:i') ?? 'N/A' }}</td>
    <td>
      @if($user->kyc_status === 'pending')
        <!-- Individual Approve (POST) -->
        <form action="{{ route('admin.kyc.approve', $user->id) }}" method="POST" style="display:inline" class="approve-form">
          @csrf
          <button type="submit" class="btn btn-success btn-sm">Approve</button>
        </form>

        <!-- Individual Reject (POST) -->
        <form action="{{ route('admin.kyc.reject', $user->id) }}" method="POST" style="display:inline" class="reject-form">
          @csrf
          <button type="submit" class="btn btn-danger btn-sm">Reject</button>
        </form>
      @else
        <span class="text-muted">Reviewed</span>
      @endif
    </td>
  </tr>
  @endforeach
</tbody>

              </table>
            </form>
          </div>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center flex-wrap">
          <div id="bulkKycActions" class="d-none mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-success me-1" onclick="submitKycBulkAction('approve')">
              <i class="fas fa-check"></i> Approve Selected
            </button>
            <button type="button" class="btn btn-sm btn-danger me-1" onclick="submitKycBulkAction('reject')">
              <i class="fas fa-times"></i> Reject Selected
            </button>
          </div>
          <div>{{ $kycRequests->onEachSide(1)->links('pagination::bootstrap-5') }}</div>
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
  const selectAll = document.getElementById('selectAllKyc');
  const checkboxes = document.querySelectorAll('.kyc-checkbox');
  const bulkActions = document.getElementById('bulkKycActions');

  // Toggle bulk action visibility
  selectAll.addEventListener('change', () => {
    checkboxes.forEach(cb => cb.checked = selectAll.checked);
    toggleBulkActions();
  });

  checkboxes.forEach(cb => cb.addEventListener('change', toggleBulkActions));

  function toggleBulkActions() {
    bulkActions.classList.toggle('d-none', ![...checkboxes].some(cb => cb.checked));
  }

  // Confirm individual approve
  document.querySelectorAll('.approve-form').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      Swal.fire({
        title: 'Approve this KYC?',
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'Yes, approve',
        cancelButtonText: 'Cancel'
      }).then(result => {
        if(result.isConfirmed) form.submit();
      });
    });
  });

  // Confirm individual reject
  document.querySelectorAll('.reject-form').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      Swal.fire({
        title: 'Reject this KYC?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Yes, reject',
        cancelButtonText: 'Cancel'
      }).then(result => {
        if(result.isConfirmed) form.submit();
      });
    });
  });
});

// Bulk action confirmation
function submitKycBulkAction(actionType) {
  const form = document.getElementById('bulkKycForm');
  const selected = document.querySelectorAll('.kyc-checkbox:checked');

  if (selected.length === 0) {
    Swal.fire('Oops', 'Please select at least one KYC request.', 'info');
    return;
  }

  Swal.fire({
    title: `Are you sure you want to ${actionType} selected KYC requests?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel'
  }).then(result => {
    if(result.isConfirmed) {
      document.getElementById('kyc_action_type').value = actionType;
      form.submit(); // ✅ POST method for bulk
    }
  });
}
</script>
@endsection
