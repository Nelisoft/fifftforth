@extends('layout.default')
@section('title', 'Admin Dashboard - Profile Settings')

@section('content')
<main class="main" id="top">
  <div class="container-fluid px-3" data-layout="container">

    @include('partials.admin.aside')
    <div class="content">
      @include('partials.admin.nav')
      @includeIf('partials.admin.flash-messages')

      <div class="page-header mb-4">
        <h3 class="fw-bold mb-1"><i class="fas fa-cogs me-2 text-primary"></i>Application Settings</h3>
        <p class="text-muted mb-0">Manage app name, logo, dark logo, favicon, and referral bonus details.</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">
              <h5 class="mb-0"><i class="fas fa-wrench me-2"></i>General Settings</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.app.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- App Name --}}
                <div class="mb-3">
                  <label class="form-label fw-semibold">App Name</label>
                  <input type="text" name="app_name" value="{{ old('app_name', $setting->app_name ?? '') }}" class="form-control" required>
                </div>

                {{-- Tagline --}}
                <div class="mb-3">
                  <label class="form-label fw-semibold">Tagline</label>
                  <input type="text" name="tagline" value="{{ old('tagline', $setting->tagline ?? '') }}" class="form-control">
                </div>

                {{-- Referral Bonus --}}
                <div class="mb-3">
                  <label class="form-label fw-semibold">Referral Bonus ($)</label>
                  <input type="number" step="0.01" min="0" name="referral_bonus" value="{{ old('referral_bonus', $setting->referral_bonus ?? 0) }}" class="form-control">
                  <small class="text-muted d-block mt-1">Users earn this when a referred user deposits.</small>
                </div>

                {{-- Logo --}}
                <div class="mb-3">
                  <label class="form-label fw-semibold">App Logo</label>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ $setting->logo ? asset('public/storage/' . $setting->logo) : asset('assets/img/default-logo.png') }}" alt="Logo" class="rounded" height="50">
                    <input type="file" name="logo" accept="image/*" class="form-control">
                  </div>
                  <small class="text-muted">Recommended: 200x50px (PNG)</small>
                </div>

                {{-- Dark Logo --}}
                <div class="mb-3">
                  <label class="form-label fw-semibold">Dark Logo</label>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ $setting->logo_dark ? asset('public/storage/' . $setting->logo_dark) : asset('assets/img/default-logo.png') }}" alt="Dark Logo" class="rounded" height="50">
                    <input type="file" name="logo_dark" accept="image/*" class="form-control">
                  </div>
                  <small class="text-muted">Recommended: 200x50px (PNG)</small>
                </div>

                {{-- Favicon --}}
                <div class="mb-3">
                  <label class="form-label fw-semibold">Favicon</label>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ $setting->favicon ? asset('public/storage/' . $setting->favicon) : asset('assets/img/default-favicon.png') }}" alt="Favicon" class="rounded" height="32">
                    <input type="file" name="favicon" accept="image/*" class="form-control">
                  </div>
                  <small class="text-muted">Recommended: 32x32px (ICO/PNG)</small>
                </div>

                {{-- App URL --}}
                <div class="mb-3">
                  <label class="form-label fw-semibold">App URL</label>
                  <input type="url" name="app_url" value="{{ old('app_url', $setting->app_url ?? '') }}" class="form-control" placeholder="https://example.com">
                </div>

                {{-- Default Language --}}
                <div class="mb-3">
                  <label class="form-label fw-semibold">Default Language</label>
                  <select name="default_language" class="form-select">
                    <option value="en" {{ ($setting->default_language ?? '') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ ($setting->default_language ?? '') == 'fr' ? 'selected' : '' }}>French</option>
                    <option value="es" {{ ($setting->default_language ?? '') == 'es' ? 'selected' : '' }}>Spanish</option>
                  </select>
                </div>

                {{-- Timezone --}}
                <div class="mb-4">
                  <label class="form-label fw-semibold">Timezone</label>
                  <input type="text" name="timezone" value="{{ old('timezone', $setting->timezone ?? 'UTC') }}" class="form-control" placeholder="e.g. Africa/Lagos">
                </div>

                {{-- Save --}}
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-primary px-4"><i class="fas fa-save me-2"></i>Save Changes</button>
                </div>
              </form>
            </div>
          </div>

          {{-- Live Preview --}}
          <div class="card border-0 shadow-sm rounded-4 mt-4">
            <div class="card-header bg-light rounded-top-4">
              <h5 class="mb-0 text-secondary"><i class="fas fa-eye me-2"></i>Live Preview</h5>
            </div>
            <div class="card-body text-center py-5">
              <img src="{{ $setting->logo ? asset('public/storage/' . $setting->logo) : asset('assets/img/default-logo.png') }}" alt="Logo Preview" height="60" class="mb-3">
              <h4 class="fw-bold mb-1">{{ $setting->app_name ?? 'Your App Name' }}</h4>
              <p class="text-muted">{{ $setting->tagline ?? 'Your tagline here...' }}</p>
              <p class="text-muted"><strong>Referral Bonus:</strong> ${{ $setting->referral_bonus ?? 0 }}</p>
            </div>
          </div>

        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>
@endsection
