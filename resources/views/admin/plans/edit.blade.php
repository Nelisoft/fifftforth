@extends('layout.default')

@section('title')
Admin Dashboard - Plans
    
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
          <h5 class="mb-0">Edit Plan: {{ $plan->name }}</h5>
        </div>

        <div class="card-body">
          <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
              <label for="name" class="form-label">Plan Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
            </div>

            <div class="mb-3">
              <label for="min_amount" class="form-label">Minimum Amount (USD)</label>
              <input type="number" name="min_amount" id="min_amount" class="form-control" step="0.01" value="{{ old('min_amount', $plan->min_amount) }}" required>
            </div>

            <div class="mb-3">
              <label for="max_amount" class="form-label">Maximum Amount (USD)</label>
              <input type="number" name="max_amount" id="max_amount" class="form-control" step="0.01" value="{{ old('max_amount', $plan->max_amount) }}" required>
            </div>

            <div class="mb-3">
              <label for="duration_days" class="form-label">Duration (Days)</label>
              <input type="number" name="duration_days" id="duration_days" class="form-control" value="{{ old('duration_days', $plan->duration_days) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-1"></i> Update Plan
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
