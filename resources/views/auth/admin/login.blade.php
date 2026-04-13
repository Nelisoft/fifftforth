@extends('layout.default')
@section('title')
Admin Login
    
@endsection
@section('content')
<main class="main" id="top">
  <div class="container" data-layout="container">
    <script>
      var isFluid = JSON.parse(localStorage.getItem('isFluid'));
      if (isFluid) {
        var container = document.querySelector('[data-layout]');
        container.classList.remove('container');
        container.classList.add('container-fluid');
      }
    </script>

    <div class="row flex-center min-vh-100 py-6">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <a class="d-flex flex-center mb-4" href="{{ route('home') }}">
          <img class="me-2"  src="{{ $settings && $settings->logo_dark ? asset('public/storage/' . $settings->logo_dark) : asset('assets/img/default-logo.png') }}" alt="" width="100">
          {{-- <span class="font-sans-serif text-primary fw-bolder fs-4 d-inline-block">falcon admin</span> --}}
        </a>

        <div class="card shadow">
          <div class="card-body p-4 p-sm-5">
            <div class="row flex-between-center mb-2">
              <div class="col-auto">
                <h5>Admin Login</h5>
              </div>
              <div class="col-auto fs-10 text-600">
                {{-- <span class="mb-0">or</span>  --}}
              </div>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="login" class="form-label">Email or Username</label>
                <input type="text" name="login" id="login" class="form-control" 
                       placeholder="Enter admin email or username" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" class="form-control password-field" placeholder="Enter your password" required>
                  <button class="btn btn-outline-secondary toggle-password" type="button">👁️</button>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Show/Hide Password
    const toggleButtons = document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.closest('.input-group').querySelector('.password-field');
            if (!input) return;
            if (input.type === 'password') {
                input.type = 'text';
                this.textContent = '🙈';
            } else {
                input.type = 'password';
                this.textContent = '👁️';
            }
        });
    });

    // Handle Access Denied
    @isset($access_denied)
    Swal.fire({
        icon: 'error',
        title: 'Access Denied',
        text: "{{ $access_denied }}",
        confirmButtonColor: '#d33'
    });
    @endisset

    // Handle Login Success
    @isset($login_success)
    let countdown = 3; // 3 seconds countdown
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        html: 'Redirecting to your dashboard in <b id="countdown">3</b> seconds...',
        timer: countdown * 1000,
        timerProgressBar: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            const b = Swal.getHtmlContainer().querySelector('#countdown')
            const timerInterval = setInterval(() => {
                countdown--;
                b.textContent = countdown;
            }, 1000)
        },
        willClose: () => {
            window.location.href = "{{ route('admin.dashboard') }}";
        }
    });
    @endisset

});
</script>
@endsection
