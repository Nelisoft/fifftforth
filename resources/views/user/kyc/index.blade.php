@extends('layout.default')

@section('title', 'KYC Verification')

@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">
    @include('partials.user.aside')
    <div class="content">
      @include('partials.user.nav')

      {{-- Flash Messages --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="row mt-4 g-4">
        <div class="col-lg-8 mx-auto">
          <div class="card shadow-sm rounded-3 p-4">
            <h3 class="fw-bold text-primary mb-3 text-center">KYC Verification</h3>
            <p class="text-muted text-center mb-4">
              Upload your identity document  to verify your account.
            </p>

            <div class="alert 
              @if(Auth::user()->kyc_status == 'approved') alert-success 
              @elseif(Auth::user()->kyc_status == 'rejected') alert-danger
              @else alert-warning @endif text-center">
              <strong>KYC Status:</strong> {{ ucfirst(Auth::user()->kyc_status) }}
            </div>

            @if(Auth::user()->kyc_status !== 'approved')
              <form action="{{ route('user.kyc') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label class="form-label fw-semibold">Residential  Address</label>
                  <input type="text" name="Home_address" class="form-control" placeholder="Enter your permanent Addrss"
                         value="{{ old('Home_address', Auth::user()->Home_address) }}" required>
                  @error('Home_address')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold">Upload ID Document  (Goverment approved ID Card) </label>
                  <input type="file" name="kyc_document" class="form-control" required>
                  @error('kyc_document')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold">
                  <i class="fas fa-upload me-1"></i> Submit KYC
                </button>
              </form>
            @else
              <div class="text-center">
                <i class="fas fa-check-circle text-success fs-1"></i>
                <p class="mt-3 fw-semibold text-success">Your KYC is already approved.</p>
              </div>
            @endif
          </div>
        </div>
      </div>

      @include('partials.user.footer')
    </div>
  </div>
</main>
@endsection
