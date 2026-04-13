@extends('layout.default')

@section('title', 'Referral Program')

@section('content')
@php
use App\Models\Setting;

// Fetch referral bonus once to avoid repeated queries
$referralBonus = Setting::first()->referral_bonus ?? 0;
@endphp

<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">
    @include('partials.user.aside')
    <div class="content">
      @include('partials.user.nav')

      {{-- Referral Link Card --}}
      <div class="card shadow-lg modern-card mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0 fw-bold">Your Referral Link</h5>
        </div>
        <div class="card-body">
          <div class="input-group">
            <input type="text" id="referralLink" class="form-control" value="{{ $referralLink }}" readonly>
            <button class="btn btn-primary" id="copyReferralBtn">
              <i class="fas fa-copy"></i> Copy
            </button>
          </div>
          <small class="text-muted d-block mt-2">
            Share this link to invite friends and earn a bonus when they make their first deposit!
          </small>
        </div>
      </div>

      {{-- Referral Tree --}}
      <div class="card shadow-lg modern-card">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0 fw-bold">Your Referral Tree</h5>
        </div>
        <div class="card-body">
          @if($referrals->count() > 0)
            <div class="table-responsive">
              <table class="table table-striped align-middle modern-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Deposited</th>
                    <th>Referral Bonus Earned</th>
                    <th>Joined On</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($referrals as $index => $ref)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $ref->username }}</td>
                      <td>{{ $ref->fullname }}</td>
                      <td>{{ $ref->email }}</td>
                      <td>${{ number_format($ref->deposits->first()?->amount ?? 0, 2) }}</td>
                      <td>${{ $ref->referral_bonus_received ? number_format($referralBonus, 2) : '0.00' }}</td>
                      <td>{{ $ref->created_at->format('d M Y') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <p class="text-muted mb-0">You haven’t referred anyone yet. Share your referral link above!</p>
          @endif
        </div>
      </div>

    </div>
  </div>
</main>

{{-- SweetAlert2 Copy Script --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const copyBtn = document.getElementById('copyReferralBtn');
  copyBtn.addEventListener('click', async function() {
    const referralInput = document.getElementById('referralLink');
    try {
      await navigator.clipboard.writeText(referralInput.value);
      Swal.fire({
        icon: 'success',
        title: 'Copied!',
        text: 'Your referral link has been copied to the clipboard.',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      });
    } catch (err) {
      console.error('Copy failed', err);
    }
  });
});
</script>

{{-- Modern CSS --}}
<style>
.modern-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 1rem;
    transition: all 0.4s ease;
}
.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}
.modern-table tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}
.btn-primary {
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}
.table thead th {
    font-weight: 600;
}
</style>
@endsection
