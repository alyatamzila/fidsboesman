@extends('layouts.app')

@section('content')

<!-- Import Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .dashboard-container {
        min-height: 80vh;
        padding-top: 80px;
        padding-bottom: 80px;
    }
    .dashboard-card {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        color: #fff;
        max-width: 80%;
        width: 100%;
    }
    .dashboard-title {
        font-weight: 700;
        font-size: 2.5rem;
    }
    .dashboard-info {
        font-size: 1.2rem;
        color: #e0e0e0;
    }
    .glowing-time {
        text-shadow: 0 0 10px rgba(8, 6, 1, 0.7), 0 0 20px rgba(86, 66, 7, 0.5);
        animation: pulse-glow 1.5s infinite alternate;
    }
    @keyframes pulse-glow {
        from {
            text-shadow: 0 0 5px rgba(255, 193, 7, 0.4);
        }
        to {
            text-shadow: 0 0 20px rgba(255, 193, 7, 0.8);
        }
    }
    .btn-custom {
        border-radius: 30px;
        padding: 10px 25px;
        font-weight: 600;
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

<div class="container text-center dashboard-container px-3 d-flex justify-content-center align-items-center" >
    <div class="card dashboard-card p-5">
        <div class="card-body">
            <h1 class="dashboard-title mb-3">Welcome, {{ $user->name ?? 'Unknown User' }}!</h1>
            <p class="dashboard-info">📧 {{ $user->email ?? '-' }}</p>
            <p class="dashboard-info">🛡️ Role: {{ $user->role ?? '-' }}</p>

            {{-- <!-- Waktu Real-Time -->
            <div class="mt-4">
                <h4 class="text-light fw-semibold">🕒 Waktu Saat Ini</h4>
                <h2 id="real-time-clock" class="display-4 text-warning fw-bold glowing-time"></h2>
            </div> --}}

            @if ($user->role === 'superadmin')
                <a href="{{ route('manage.flights') }}" class="btn btn-outline-light mt-4 btn-custom shadow">Manage Flights</a>
                <a href="{{ route('admin.manage') }}" class="btn btn-outline-info mt-3 btn-custom shadow">Manage Admin</a>
                <a href="{{ route('admin.runningtexts.edit') }}" class="btn btn-outline-warning mt-3 btn-custom shadow">Manage Running Text</a>
            @elseif ($user->role === 'admin')
                <a href="{{ route('manage.flights') }}" class="btn btn-outline-light mt-4 btn-custom shadow">Manage Flights</a>
                {{-- <a href="{{ route(name: 'flights.create') }}" class="btn btn-outline-light mt-4 btn-custom shadow">Kelola Penerbangan</a> --}}
            @endif

            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-custom shadow">Logout</button>
            </form>
        </div>
    </div>
</div>

<div class="running-text-bar d-flex justify-content-between align-items-center">
    <marquee behavior="scroll" direction="left" scrollamount="6" class="flex-grow-1">
        {{ DB::table('runningtexts')->where('key', 'running_text')->value('value') }}
    </marquee>
    <div class="text-white ms-3 d-flex align-items-center"
        style="white-space: nowrap; background-color: yellow ; padding: 5px; border-radius: 5px;">
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
