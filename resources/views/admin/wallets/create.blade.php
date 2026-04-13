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

      <div class="card shadow-sm mt-3">
        <div class="card-header">
          <h5 class="mb-0">Create New Wallet</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('admin.wallets.store') }}" method="POST">
            @csrf

            {{-- Wallet Name --}}
            <div class="mb-3">
              <label for="name" class="form-label">Wallet Name</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Enter wallet name" value="{{ old('name') }}" required>
            </div>

            {{-- Coin Type --}}
            <div class="mb-3">
              <label for="coin_type" class="form-label">Coin Type</label>
              <input type="text" name="coin_type" id="coin_type" class="form-control" placeholder="Enter coin type (e.g., BTC, USDT)" value="{{ old('coin_type') }}" required>
            </div>

            {{-- Wallet Address --}}
            <div class="mb-3">
              <label for="wallet_address" class="form-label">Wallet Address</label>
              <input type="text" name="wallet_address" id="wallet_address" class="form-control" placeholder="Enter wallet address" value="{{ old('wallet_address') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Wallet</button>
            <a href="{{ route('admin.wallets.index') }}" class="btn btn-secondary ms-2">Cancel</a>
          </form>
        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>
@endsection
