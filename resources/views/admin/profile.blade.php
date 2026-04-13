@extends('layout.default')
@section('title')
Admin Dashboard - Profile Settings
    
@endsection
@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">
    @include('partials.admin.aside')

    <div class="content">
      @include('partials.admin.nav')

      {{-- Flash Messages --}}
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

      <div class="row mt-3">

        {{-- Update Profile --}}
        <div class="col-lg-6 mb-4">
          <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">Update Admin Profile</h5>
            </div>
            <div class="card-body">
              <form id="adminProfileForm" method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label for="fullname" class="form-label">Full Name</label>
                  <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                        id="fullname" name="fullname" value="{{ old('fullname', auth()->user()->fullname) }}" required>
                  @error('fullname')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control @error('username') is-invalid @enderror"
                        id="username" name="username" value="{{ old('username', auth()->user()->username) }}" required>
                  @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="text" class="form-control @error('phone') is-invalid @enderror"
                        id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
              </form>
            </div>
          </div>
        </div>

        {{-- Change Password --}}
        <div class="col-lg-6 mb-4">
          <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark">
              <h5 class="mb-0">Change Password</h5>
            </div>
            <div class="card-body">
              <form id="adminPasswordForm" method="POST" action="{{ route('admin.profile.change-password') }}">
                @csrf

                {{-- Current Password --}}
                <div class="mb-3 position-relative">
                  <label for="current_password" class="form-label">Current Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                          id="current_password" name="current_password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                      <i class="fa fa-eye"></i>
                    </button>
                  </div>
                  @error('current_password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                {{-- New Password --}}
                <div class="mb-3 position-relative">
                  <label for="new_password" class="form-label">New Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                          id="new_password" name="new_password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password">
                      <i class="fa fa-eye"></i>
                    </button>
                  </div>
                  @error('new_password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Confirm New Password --}}
                <div class="mb-3 position-relative">
                  <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror"
                          id="new_password_confirmation" name="new_password_confirmation" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password_confirmation">
                      <i class="fa fa-eye"></i>
                    </button>
                  </div>
                  @error('new_password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                <button type="submit" class="btn btn-warning text-dark">Change Password</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>

{{-- SweetAlert2 & Password Toggle --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/a2e0b1d6c6.js" crossorigin="anonymous"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const profileForm = document.getElementById('adminProfileForm');
    const passwordForm = document.getElementById('adminPasswordForm');

    // SweetAlert confirmations
    profileForm.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Update Profile?',
            text: "Confirm saving these admin changes?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) profileForm.submit();
        });
    });

    passwordForm.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Change Password?',
            text: "Are you sure you want to change your admin password?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) passwordForm.submit();
        });
    });

    // Show/Hide password functionality
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });
});
</script>
@endsection
