@extends('layout.default')

@section('title') Reset Password @endsection

@section('content')
<main class="main" id="top">
  <div class="container py-6">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h5 class="mb-3">Reset Your Password</h5>

            @if($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

           <form action="{{ route('user.password.update') }}" method="POST">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $email ?? old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
</form>


            <div class="mt-3 text-center">
              <a href="{{ route('user.login') }}">Back to Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
