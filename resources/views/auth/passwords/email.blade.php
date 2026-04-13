@extends('layout.default')

@section('title') Forgot Password @endsection

@section('content')
<main class="main" id="top">
  <div class="container py-6">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h5 class="mb-3">Forgot Your Password?</h5>

            @if(session('status'))
              <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('user.password.email') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
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
