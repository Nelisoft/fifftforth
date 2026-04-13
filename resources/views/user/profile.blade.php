@extends('layout.default')
@section('title')
Dashboard Profile Setting
    
@endsection
@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">
    @include('partials.user.aside')

    <div class="content">
      @include('partials.user.nav')

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
      {{-- Update Profile --}}
<div class="col-lg-6 mb-4">
  <div class="card shadow-sm">
    <div class="card-header">
      <h5 class="mb-0">Update Profile</h5>
    </div>
    <div class="card-body">
      <form id="profileForm" method="POST" action="{{ route('user.profile.update') }}">
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
          <label for="country" class="form-label">Country</label>
          <input type="text" class="form-control @error('country') is-invalid @enderror" 
                 id="country" name="country" value="{{ old('country', auth()->user()->country) }}">
          @error('country')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="country_code" class="form-label">Country Code</label>
          <input type="text" class="form-control @error('country_code') is-invalid @enderror" 
                 id="country_code" name="country_code" value="{{ old('country_code', auth()->user()->country_code) }}">
          @error('country_code')
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
          <div class="card shadow-sm">
            <div class="card-header">
              <h5 class="mb-0">Change Password</h5>
            </div>
            <div class="card-body">
              <form id="passwordForm" method="POST" action="{{ route('user.profile.change-password') }}">
                @csrf

                <div class="mb-3">
                  <label for="current_password" class="form-label">Current Password</label>
                  <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                         id="current_password" name="current_password" required>
                  @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="new_password" class="form-label">New Password</label>
                  <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                         id="new_password" name="new_password" required>
                  @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                         id="new_password_confirmation" name="new_password_confirmation" required>
                  @error('new_password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <button type="submit" class="btn btn-warning">Change Password</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      @include('partials.user.footer')
    </div>
  </div>
</main>

{{-- SweetAlert2 Confirmations --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const profileForm = document.getElementById('profileForm');
    const passwordForm = document.getElementById('passwordForm');

    profileForm.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Update Profile?',
            text: "Are you sure you want to save these changes?",
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
            text: "Are you sure you want to change your password?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) passwordForm.submit();
        });
    });
});
</script>
@endsection
