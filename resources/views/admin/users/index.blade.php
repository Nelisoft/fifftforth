@extends('layout.default')
@section('title')
Admin Dashboard - Users
    
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

      <div class="card shadow-sm mt-3" id="usersTable">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h5 class="mb-0">All Users</h5>

          <!-- Search -->
          <form method="GET" action="{{ route('admin.users.index') }}" class="mt-2 mt-lg-0">
            <div class="input-group input-group-sm">
              <input type="search" name="search" class="form-control" placeholder="Search users..." value="{{ request('search') }}">
              <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive scrollbar" style="max-height: 70vh; overflow-x: auto;">
            <form id="bulkActionForm" action="{{ route('admin.users.bulk-action') }}" method="POST">
              @csrf
              <input type="hidden" name="action" id="action_type">

              <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                <thead class="table-light">
                  <tr>
                    <th style="width: 5%">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                      </div>
                    </th>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>

                <tbody id="userTableBody">
                  @forelse ($users as $user)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input user-checkbox" type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                        </div>
                      </td>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $user->fullname }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->country }}</td>
                      <td>{{ $user->phone }}</td>
                      <td>
                        @if ($user->is_blocked)
                          <span class="badge bg-danger">Blocked</span>
                        @else
                          <span class="badge bg-success">Active</span>
                        @endif
                      </td>
                      <td class="text-end">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info mb-1">
                          <i class="fas fa-eye"></i> View
                        </a>

                        @if ($user->is_blocked)
                          <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST" class="d-inline unblock-form">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success mb-1">
                              <i class="fas fa-unlock"></i> Unblock
                            </button>
                          </form>
                        @else
                          <form action="{{ route('admin.users.block', $user->id) }}" method="POST" class="d-inline block-form">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning mb-1">
                              <i class="fas fa-ban"></i> Block
                            </button>
                          </form>
                        @endif

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline delete-form">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                          </button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="8" class="text-center text-muted py-4">No users found.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </form>
          </div>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center flex-wrap">
          <div id="bulkActions" class="d-none mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-warning me-1" onclick="submitBulkAction('block')"><i class="fas fa-ban"></i> Block Selected</button>
            <button type="button" class="btn btn-sm btn-success me-1" onclick="submitBulkAction('unblock')"><i class="fas fa-unlock"></i> Unblock Selected</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="submitBulkAction('delete')"><i class="fas fa-trash-alt"></i> Delete Selected</button>
          </div>
          <div>{{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}</div>
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
  const selectAll = document.getElementById('selectAll');
  const checkboxes = document.querySelectorAll('.user-checkbox');
  const bulkActions = document.getElementById('bulkActions');

  selectAll.addEventListener('change', function () {
    checkboxes.forEach(cb => cb.checked = this.checked);
    toggleBulkActions();
  });

  checkboxes.forEach(cb => cb.addEventListener('change', toggleBulkActions));

  function toggleBulkActions() {
    const anyChecked = [...checkboxes].some(cb => cb.checked);
    bulkActions.classList.toggle('d-none', !anyChecked);
  }

  // Confirm delete
  document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e){
      e.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if(result.isConfirmed) form.submit();
      });
    });
  });

  // Confirm block
document.getElementById('usersTable').addEventListener('submit', function(e){
    const form = e.target;
    
    if (form.classList.contains('block-form')) {
        e.preventDefault();
        Swal.fire({
            title: 'Block User?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, block',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if(result.isConfirmed) form.submit();
        });
    }

    if (form.classList.contains('unblock-form')) {
        e.preventDefault();
        Swal.fire({
            title: 'Unblock User?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, unblock',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if(result.isConfirmed) form.submit();
        });
    }

    if (form.classList.contains('delete-form')) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed) form.submit();
        });
    }
});

  // Confirm unblock
  document.querySelectorAll('.unblock-form').forEach(form => {
    form.addEventListener('submit', function(e){
      e.preventDefault();
      Swal.fire({
        title: 'Unblock User?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, unblock',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if(result.isConfirmed) form.submit();
      });
    });
  });
});

// Bulk actions with SweetAlert
function submitBulkAction(actionType) {
  const form = document.getElementById('bulkActionForm');
  const selected = document.querySelectorAll('.user-checkbox:checked');

  if (selected.length === 0) {
    Swal.fire('Oops', 'Please select at least one user.', 'info');
    return;
  }

  Swal.fire({
    title: `Are you sure you want to ${actionType} selected users?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('action_type').value = actionType;
      form.submit();
    }
  });
}
</script>
@endsection
