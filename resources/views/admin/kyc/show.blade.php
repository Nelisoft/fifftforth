@extends('layout.default')
@section('title')
Admin Dashboard - KYC Details
@endsection

@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">
    @include('partials.admin.aside')
    <div class="content">
      @include('partials.admin.nav')

      <div class="card shadow-sm mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">KYC Details - {{ $user->fullname }}</h5>
          <a href="{{ route('admin.kyc.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>

        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th>Full Name</th>
              <td>{{ $user->fullname }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>Billing Address</th>
              <td>{{ $user->Home_address ?? '-' }}</td>
            </tr>
            <tr>
              <th>KYC Status</th>
              <td>
                @if ($user->kyc_status == 'pending')
                  <span class="badge bg-warning">Pending</span>
                @elseif ($user->kyc_status == 'approved')
                  <span class="badge bg-success">Approved</span>
                @else
                  <span class="badge bg-danger">Rejected</span>
                @endif
              </td>
            </tr>
            <tr>
              <th>KYC Document</th>
              <td>
                @if($user->kyc_document)
                  <a href="{{ asset('public/storage/' . $user->kyc_document) }}" target="_blank" class="text-decoration-none">View Document</a>
                @else
                  -
                @endif
              </td>
            </tr>
            <tr>
              <th>Submitted At</th>
              <td>{{ $user->kyc_submitted_at?->format('d M Y') ?? $user->created_at->format('d M Y') }}</td>
            </tr>
          </table>

          {{-- Individual Approve/Reject Actions --}}
          <div class="mt-3">
            @if ($user->kyc_status === 'pending')
              <form action="{{ route('admin.kyc.approve', $user->id) }}" method="POST" class="d-inline approve-form">
                @csrf
                <button type="submit" class="btn btn-success">Approve</button>
              </form>

              <form action="{{ route('admin.kyc.reject', $user->id) }}" method="POST" class="d-inline reject-form">
                @csrf
                <button type="submit" class="btn btn-danger">Reject</button>
              </form>
            @endif
          </div>
        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>

{{-- SweetAlert2 Confirmation --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Approve Confirmation
  document.querySelectorAll('.approve-form').forEach(form => {
    form.addEventListener('submit', function(e) {
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

  // Reject Confirmation
  document.querySelectorAll('.reject-form').forEach(form => {
    form.addEventListener('submit', function(e) {
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
</script>
@endsection
