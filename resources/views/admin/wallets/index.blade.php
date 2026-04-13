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

      <div class="card shadow-sm mt-3" id="walletsTable">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h5 class="mb-0">All Wallets</h5>

          <!-- Search -->
          <form method="GET" action="{{ route('admin.wallets.index') }}" class="mt-2 mt-lg-0">
            <div class="input-group input-group-sm">
              <input type="search" name="search" class="form-control" placeholder="Search wallets..." value="{{ request('search') }}">
              <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>

          <a href="{{ route('admin.wallets.create') }}" class="btn btn-success btn-sm mt-2 mt-lg-0">
            <i class="fas fa-plus"></i> Add Wallet
          </a>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive scrollbar" style="max-height: 70vh; overflow-x: auto;">
            <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Coin Type</th>
                  <th>Wallet Address</th>
                  <th class="text-end">Action</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($wallets as $wallet)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $wallet->name }}</td>
                  <td>{{ $wallet->coin_type }}</td>
                  <td>{{ $wallet->wallet_address }}</td>
                  <td class="text-end">
                    <!-- Dropdown Actions -->
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="{{ route('admin.wallets.edit', $wallet->id) }}">
                            <i class="fas fa-edit me-1"></i> Edit
                          </a>
                        </li>
                        <li>
                          <form method="POST" action="{{ route('admin.wallets.destroy', $wallet->id) }}" onsubmit="return confirm('Delete this wallet?')">
                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item text-danger" type="submit">
                              <i class="fas fa-trash me-1"></i> Delete
                            </button>
                          </form>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">No wallets found.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-end">
          {{ $wallets->links() }}
        </div>
      </div>

      @include('partials.admin.footer')
    </div>
  </div>
</main>
@endsection
