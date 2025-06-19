@extends('layouts.app')

@section('content')

{{-- Google Font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .page-wrapper {
            min-height: 50vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
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
        font-weight: 600;
        color: #f8f9fa;
    }
    .form-control {
        border-radius: 12px;
    }
    .btn {
        border-radius: 5px;
        font-weight: 500;
    }
    .form-title {
        font-weight: bold;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
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
    .form-control option {
        color: #000;
        background-color: #fff;
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

    @media (max-width: 768px) {
    .glass-card {
        padding: 1.5rem;
        max-width: 100%;
    }

    .form-title {
        font-size: 1.5rem;
    }

    .btn-rounded {
        padding: 8px 16px;
        font-size: 0.9rem;
    }

    .running-text-bar marquee {
        font-size: 0.9rem;
    }

    .running-text-bar .text-white span {
        font-size: 0.9rem !important;
    }

    .page-wrapper {
        padding-top: 100px;
        padding-bottom: 60px;
    }
}

</style>

<div class="container-fluid page-wrapper mt-5 d-flex justify-content-center px-3">
    <div class="col-lg-8 col-md-10 col-12">
        <div class="glass-card">
            {{-- Display success message --}}
            <h2 class="form-title text-center">Edit Running Text</h2>

            <form action="{{ route('admin.runningtexts.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="value" class="form-label">Running Text</label>
                    <input type="text" name="value" id="value" class="form-control"
                        placeholder="Masukkan teks berjalan..."
                        value="{{ old('value', $runningText) }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4 ">
                        Save
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-rounded px-4 ms-2">
                        Back
                    </a>
                </div>
            </form>
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
