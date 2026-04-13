@extends('layout.default')
@section('title')
Admin Dashboard - Create Plans
    
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

      <div class="card shadow-sm mt-3">
        <div class="card-header">
          <h5 class="mb-0">Create New Plan</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Plan Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
              <label for="min_amount" class="form-label">Minimum Amount (USD)</label>
              <input type="number" name="min_amount" id="min_amount" class="form-control" step="0.01" value="{{ old('min_amount') }}" required>
            </div>

            <div class="mb-3">
              <label for="max_amount" class="form-label">Maximum Amount (USD)</label>
              <input type="number" name="max_amount" id="max_amount" class="form-control" step="0.01" value="{{ old('max_amount') }}" required>
            </div>

            <div class="mb-3">
              <label for="daily_roi" class="form-label">Daily ROI (%)</label>
              <input type="number" name="daily_roi" id="daily_roi" class="form-control" step="0.01" value="{{ old('daily_roi') }}" required>
              <small class="text-muted">This percentage will be applied daily for the plan duration.</small>
            </div>

            <div class="mb-3">
              <label for="duration_days" class="form-label">Duration (Days)</label>
              <input type="number" name="duration_days" id="duration_days" class="form-control" value="{{ old('duration_days') }}" required>
            </div>

            <button type="submit" class="btn btn-success">
              <i class="fas fa-plus me-1"></i> Create Plan
            </button>
            <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>
@endsection
