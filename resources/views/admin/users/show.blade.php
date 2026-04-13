@extends('layout.default')
@section('title')
Admin Dashboard - Manage Users
    
@endsection
@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">
    @include('partials.admin.aside')
    <div class="content">
      @include('partials.admin.nav')
      @includeIf('partials.admin.flash-messages')

      <div class="page-header mb-4">
        <h3 class="fw-bold mb-1">
          <i class="fas fa-user-shield me-2 text-primary"></i>Manage User – {{ $user->username }}
        </h3>
        <p class="text-muted mb-0">View and manage user details, balances, and account actions.</p>
      </div>

      <div class="row g-4">
        {{-- Left Column: Profile Info --}}
        <div class="col-lg-6">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">
              <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>User Profile</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="fullname" value="{{ $user->fullname }}" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" value="{{ $user->username }}" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" rows="2" class="form-control">{{ $user->address }}</textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                  <button class="btn btn-outline-primary px-4">
                    <i class="fas fa-save me-2"></i>Update Profile
                  </button>
                </div>
              </form>
            </div>
          </div>

          {{-- Change Password --}}
          <div class="card border-0 shadow-sm rounded-4 mt-4">
            <div class="card-header bg-secondary text-white rounded-top-4">
              <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Change Password</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.users.change-password', $user) }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label class="form-label">New Password</label>
                  <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>
                <button class="btn btn-outline-secondary w-100">
                  <i class="fas fa-key me-2"></i>Update Password
                </button>
              </form>
            </div>
          </div>
        </div>

        {{-- Right Column: Balances & Actions --}}
        <div class="col-lg-6">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-success text-white rounded-top-4">
              <h5 class="mb-0"><i class="fas fa-wallet me-2"></i>Balances</h5>
            </div>
            <div class="card-body">
              <div class="row text-center mb-4">
                <div class="col-6 border-end">
                  <h6 class="text-muted mb-1">Main Balance</h6>
                  <h4 class="fw-bold text-success">${{ number_format($mainBalance, 2) }}</h4>
                </div>
                <div class="col-6">
                  <h6 class="text-muted mb-1">Profit Balance</h6>
                  <h4 class="fw-bold text-info">${{ number_format($profitBalance, 2) }}</h4>
                </div>
              </div>

              {{-- Adjust Balances --}}
              <form action="{{ route('admin.users.adjust-balance', $user) }}" method="POST" class="border-top pt-3">
                @csrf
                <h6 class="fw-bold mb-3">Adjust Balances</h6>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Main Balance</label>
                    <input type="number" step="0.01" name="main_balance" class="form-control" placeholder="+/- Amount">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Profit Balance</label>
                    <input type="number" step="0.01" name="profit_balance" class="form-control" placeholder="+/- Amount">
                  </div>
                </div>
                <button class="btn btn-outline-success w-100 mt-3">
                  <i class="fas fa-sync-alt me-2"></i>Apply Adjustment
                </button>
              </form>
            </div>
          </div>

         {{-- Actions --}}
<div class="card border-0 shadow-sm rounded-4 mt-4">
  <div class="card-header bg-dark text-white rounded-top-4">
    <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Actions</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.users.send-email', $user) }}" method="POST" class="mb-4">
      @csrf
      <h6 class="fw-bold">Send Email</h6>
      <div class="mb-2">
        <input type="text" name="subject" class="form-control" placeholder="Subject" required>
      </div>
      <div class="mb-3">
        <textarea name="message" rows="3" class="form-control" placeholder="Message..." required></textarea>
      </div>
      <button class="btn btn-outline-dark w-100">
        <i class="fas fa-paper-plane me-2"></i>Send Email
      </button>
    </form>

    <a href="{{ route('admin.users.login-as', $user) }}" class="btn btn-outline-primary w-100 mb-2">
      <i class="fas fa-sign-in-alt me-2"></i>Login as User
    </a>

    {{-- Block User --}}
{{-- Block / Unblock User --}}
{{-- Block / Unblock User --}}
<form action="{{ $user->is_blocked 
                ? route('admin.users.unblock', $user) 
                : route('admin.users.block', $user) }}" 
      method="POST" class="mb-2">
    @csrf
    <button type="submit" class="btn {{ $user->is_blocked ? 'btn-outline-success' : 'btn-outline-warning' }} w-100">
        <i class="{{ $user->is_blocked ? 'fas fa-user-check' : 'fas fa-user-lock' }} me-2"></i>
        {{ $user->is_blocked ? 'Unblock User' : 'Block User' }}
    </button>
</form>



    {{-- Delete User --}}
    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-outline-danger w-100">
        <i class="fas fa-user-times me-2"></i>Delete User
      </button>
    </form>

  </div>
</div>

        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>
@endsection
