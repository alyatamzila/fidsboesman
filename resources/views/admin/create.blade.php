@extends('layouts.app')

@section('content')

{{-- Import Font Modern --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

    body {
        font-family: 'Poppins', sans-serif;
    }
    .page-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        color: #fff;
        width: 100%;
        max-width: 70%;
        margin: auto;
    }

    label {
        font-weight: 500;
        color: #f8f9fa;
    }

    h3 {
        font-weight: 600;
        color: #ffffff;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.15);
        border: none;
        color: #fff;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.8);
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    .btn {
        border-radius: 5px;
        font-weight: 500;
    }

    .alert-danger {
        background-color: rgba(255, 0, 0, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>

<div class="container page-wrapper">
    <div class="glass-card p-4">
        {{-- <div class="card-transparent p-4"> --}}

        <h3 class="mb-4">Add New Admin</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠️ Ups!</strong> There was an error while inputting data:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Admin Name</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}" placeholder="Enter full name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Admin Email</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}" placeholder="example@gmail.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Minimum 6 characters">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Confirm Password">
            </div>

            <button type="submit" class="btn btn-success px-4 ms-2 btn-rounded">Save</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary px-4 ms-2 btn-rounded">Back</a>
        </form>
    </div>
</div>
@endsection
