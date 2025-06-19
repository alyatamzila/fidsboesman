@extends('layouts.app')

@section('content')

{{-- Import Google Font --}}
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
        color: #f8f9fa;
        font-weight: 500;
    }
    h3 {
        font-weight: 600;
        color: #fff;
    }
    .form-control {
        background-color: rgba(255, 255, 255, 0.2);
        border: none;
        color: #fff;
    }
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.8);
    }
    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
    }
    .btn {
        border-radius: 5px;
        font-weight: 500;
    }
</style>

<div class="container page-wrapper">
    <div class="glass-card p-4">
        <h3 class="mb-4">Edit Admin Data</h3>

        <form method="POST" action="{{ route('admin.update', $admin->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Admin Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Admin Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password<small class="text-light">(Optional, fill in if you want to change)</small></label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Minimum 6 character">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Confirm Password">
            </div>

            <button type="submit" class="btn btn-success btn-rounded px-4 ms-2">Save Changes</button>
            <a href="{{ route('admin.manage') }}" class="btn btn-secondary btn-rounded px-4 ms-2">Cancel</a>
        </form>
    </div>
</div>
@endsection
