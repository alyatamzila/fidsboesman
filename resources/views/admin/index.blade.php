@extends('layouts.app')

@section('content')

{{-- Import Google Font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: transparent;
    }

    .fullscreen-container {
        min-height: 50vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
    }

    .transparent-card {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        padding: 2rem;
        color: #fff;
        width: 100%;
        max-width: 1100px;
    }

    .table {
        background-color: transparent;
    }

    .table thead {
        background-color: rgba(255, 255, 255, 0.15);
        text-align: center
    }

    .table th,
    .table td {
        color: #ffffff;
        background-color: transparent;
        vertical-align: middle;
    }

    .table tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-primary, .btn-warning, .btn-danger, .btn-secondary {
        border-radius: 25px;
        font-weight: 500;
    }

    .btn-rounded {
        border-radius: 25px;
    }

    .running-text-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.8);
        color: yellow;
        font-weight: bold;
        padding: 5px 0;
        z-index: 999;
    }

    .running-text-bar marquee {
        font-size: 1.1rem;
    }
</style>


<div class="fullscreen-container">
    <div class="transparent-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Admin List</h2>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">+ Add Admin</a>
        </div>

        {{-- @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-dark" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Admin Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr align="center">
                            <td class="fw-semibold">{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm me-1">✏️ Edit</a>
                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">🗑️Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $admins->links('pagination::bootstrap-5') }}
            </div>
        </div>
        {{-- Tombol Kembali --}}
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 ms-2 btn-rounded">Back</a>
        </div>
    </div>
</div>

<div class="running-text-bar d-flex justify-content-between align-items-center">
    <marquee behavior="scroll" direction="left" scrollamount="6" class="flex-grow-1">
        {{ DB::table('runningtexts')->where('key', 'running_text')->value('value') }}
    </marquee>
    <div class="text-white ms-3 d-flex align-items-center"
        style="white-space: nowrap; background-color: yellow; padding: 5px; border-radius: 5px;">
        <span id="realtime-date" class="fw-semibold me-2" style="font-size: 1rem; color: black;"></span>
        <span style="color: black;">|</span>
        <span id="realtime-clock" class="fw-semibold ms-2" style="font-size: 1rem; color: black;"></span>
    </div>
</div>


<script>
    function updateClock() {
        const now = new Date();

            const jam = now.getHours().toString().padStart(2, '0');
            const menit = now.getMinutes().toString().padStart(2, '0');
            const detik = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('realtime-clock').innerText = `${jam}:${menit}:${detik}`;

            const options = {
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            };
            const tanggal = now.toLocaleDateString('id-ID', options);
            document.getElementById('realtime-date').innerText = tanggal;
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>

@endsection
