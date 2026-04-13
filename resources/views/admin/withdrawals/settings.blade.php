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

      {{-- Validation Errors --}}
      @if ($errors->any())
        <div class="alert alert-danger mt-3">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Withdrawal Settings Card --}}
      <div class="card shadow-sm mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Withdrawal Settings</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('admin.withdrawal-settings.update') }}" method="POST">
            @csrf
            @method('PUT') {{-- << REQUIRED FOR UPDATE --}}

            <div class="mb-3">
              <label for="min_withdrawal" class="form-label">Minimum Withdrawal Amount (USD)</label>
              <input type="number" name="min_withdrawal" id="min_withdrawal" class="form-control" step="0.01"
                value="{{ old('min_withdrawal', $settings->min_withdrawal ?? 0) }}" required>
            </div>

            <div class="mb-3">
              <label for="max_withdrawal" class="form-label">Maximum Withdrawal Amount (USD)</label>
              <input type="number" name="max_withdrawal" id="max_withdrawal" class="form-control" step="0.01"
                value="{{ old('max_withdrawal', $settings->max_withdrawal ?? 0) }}" required>
            </div>

            <button type="submit" class="btn btn-success">
              <i class="fas fa-save me-1"></i> Save Settings
            </button>
          </form>
        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>
@endsection
