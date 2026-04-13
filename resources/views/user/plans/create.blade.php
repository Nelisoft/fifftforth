@extends('layout.default')
@section('title')
Dashboard Create Plans
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

      {{-- Investment Plans Section --}}
      <div class="row mt-4 g-3">
        @forelse($plans as $plan)
        <div class="col-lg-4 border-top border-bottom">
          <div class="h-100 shadow-sm bg-white rounded-3 overflow-hidden hover-scale">
            
            {{-- Header Section --}}
            <div class="text-center p-4">
              <h3 class="fw-bold text-primary my-0">{{ $plan->name }}</h3>
              @if(!empty($plan->description))
                <p class="mt-3 text-muted small">{{ $plan->description }}</p>
              @endif

              <h2 class="fw-semibold my-4 text-dark">
                <sup class="fw-normal fs-7 me-1">$</sup>{{ number_format($plan->min_amount, 2) }} 
                <small class="text-muted">– ${{ number_format($plan->max_amount, 2) }}</small>
                <br>
                <small class="fs-10 text-700 text-muted">/ {{ $plan->duration_days }} days</small>
              </h2>

              <span class="badge bg-success-subtle text-success fs-9 px-3 py-2 rounded-pill mb-3">
                {{ $plan->daily_roi }}% Daily ROI
              </span>

              {{-- Investment Form --}}
              <form class="investment-form" action="{{ route('user.plans.store') }}" method="POST">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                <div class="mb-2">
                  <input type="number" name="amount" class="form-control text-center amount-input" 
                         placeholder="Enter amount ($)"
                         min="{{ $plan->min_amount }}" max="{{ $plan->max_amount }}" required>
                </div>

                <div class="mb-2">
                  <small>Total Balance: ${{ number_format(Auth::user()->balance + Auth::user()->profit, 2) }}</small>
                </div>

                <div class="mb-2">
                  <small class="text-danger error-msg d-none">Insufficient total balance.</small>
                </div>

                <button type="submit" class="btn btn-outline-primary w-100 rounded-pill fw-semibold invest-btn">
                  <i class="fas fa-wallet me-1"></i> Invest Now
                </button>
              </form>
            </div>

            <hr class="border-bottom-0 m-0">

            {{-- Features Section --}}
            <div class="text-start px-sm-4 py-4">
              <h5 class="fw-medium fs-9 text-dark">Plan Details</h5>
              <ul class="list-unstyled mt-3 mb-4 text-muted">
                <li class="py-1"><span class="me-2 fas fa-check text-success"></span> Minimum: ${{ number_format($plan->min_amount, 2) }}</li>
                <li class="py-1"><span class="me-2 fas fa-check text-success"></span> Maximum: ${{ number_format($plan->max_amount, 2) }}</li>
                <li class="py-1"><span class="me-2 fas fa-check text-success"></span> Duration: {{ $plan->duration_days }} Days</li>
                <li class="py-1"><span class="me-2 fas fa-check text-success"></span> Daily ROI: {{ $plan->daily_roi }}%</li>
                <li class="py-1"><span class="me-2 fas fa-check text-success"></span> Capital Back: 
                  <span class="badge bg-success-subtle text-success rounded-pill ms-1">Yes</span>
                </li>
              </ul>

              @if(!empty($plan->features))
                <h6 class="fw-semibold text-dark">Additional Features</h6>
                <ul class="list-unstyled mt-2">
                  @foreach(explode(',', $plan->features) as $feature)
                    <li class="py-1"><span class="me-2 fas fa-check text-primary"></span>{{ trim($feature) }}</li>
                  @endforeach
                </ul>
              @endif
            </div>

          </div>
        </div>
        @empty
        <div class="col-12 text-center">
          <p class="text-muted mt-4">No investment plans available at the moment.</p>
        </div>
        @endforelse
      </div>

      @include('partials.user.footer')
    </div>
  </div>
</main>

@push('styles')
<style>
  .hover-scale {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .hover-scale:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
  }
  .bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1);
  }
  .form-control {
    border-radius: 0.6rem;
    border: 1px solid #dee2e6;
  }
  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.15);
  }
  .error-msg {
    font-size: 0.875rem;
  }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const totalBalance = parseFloat(@json(Auth::user()->balance + Auth::user()->profit));

  document.querySelectorAll('.investment-form').forEach(form => {
    const amountInput = form.querySelector('.amount-input');
    const errorMsg = form.querySelector('.error-msg');

    form.addEventListener('submit', function (e) {
      const amount = parseFloat(amountInput.value);

      if (amount > totalBalance) {
        e.preventDefault();
        errorMsg.classList.remove('d-none');
      } else {
        errorMsg.classList.add('d-none');
      }
    });

    amountInput.addEventListener('input', () => errorMsg.classList.add('d-none'));
  });
});
</script>
@endpush
@endsection
