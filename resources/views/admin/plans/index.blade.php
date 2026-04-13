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

      <div class="card shadow-sm mt-3" id="plansTable">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h5 class="mb-0">Manage Plans</h5>

          <!-- Add Plan Button -->
          <a href="{{ route('admin.plans.create') }}" class="btn btn-success btn-sm mt-2 mt-lg-0">
            <i class="fas fa-plus me-1"></i> Add New Plan
          </a>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive scrollbar" style="max-height: 70vh; overflow-x: auto;">
            <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Min Amount</th>
                  <th>Max Amount</th>
                  <th>Duration (Days)</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($plans as $plan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $plan->name }}</td>
                  <td>${{ number_format($plan->min_amount, 2) }}</td>
                  <td>${{ number_format($plan->max_amount, 2) }}</td>
                  <td>{{ $plan->duration_days }}</td>
                  <td class="text-end">
                    <div class="d-flex justify-content-end gap-2">
                      <a href="{{ route('admin.plans.edit', $plan->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit
                      </a>
                      <form method="POST" action="{{ route('admin.plans.destroy', $plan->id) }}" 
                            onsubmit="return confirm('Are you sure you want to delete this plan?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                          <i class="fas fa-trash me-1"></i> Delete
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-4">No plans found.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-end">
          {{ $plans->links('pagination::bootstrap-5') }}
          
        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>
@endsection
