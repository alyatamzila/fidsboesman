@extends('layouts.app')

@section('content')

<!-- Import Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .login-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        color: #fff;
    }
    .login-header {
        background: linear-gradient(135deg, #007bff, #00bcd4);
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .form-label {
        color: #fff;
    }
    .form-control {
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        border-radius: 10px;
    }
    .btn-login {
        border-radius: 30px;
        font-weight: 600;
        background: linear-gradient(135deg, #007bff, #00bcd4);
        border: none;
    }
</style>

<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card login-card">
            <div class="card-header login-header text-white text-center p-3">
                <h4 class="mb-0">FIDS Oesman Sadik Airport</h4>
            </div>
            <div class="card-body p-4">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-login w-100 text-white mt-3">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
