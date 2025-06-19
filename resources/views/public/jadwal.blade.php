@extends('layouts.app')

@section('content')
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
        }

        .glass-card {
            min-height: 80vh; /* Biar menjangkau seluruh tinggi layar */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .table {
            background-color: transparent;
        }

        .table thead {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .table thead th {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .table th,
        .table td {
            color: #ffffff;
            background-color: transparent;
            vertical-align: middle;
            font-size: 1.2rem;
            padding: 12px 16px;
            min-height: 73px;
            height: 70px;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-rounded {
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
        }

        .form-title {
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #fff;
        }

        .sub-info {
            font-size: 1rem;
            font-weight: normal;
            color: #e0e0e0;
            display: block;
            margin-top: 0.2rem;
        }

        .table-wrapper {
            overflow-x: auto;
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

        .fixed-height-table {
            max-height: 120vh;
            overflow: hidden;
        }



    </style>

    <div class="container">
        <div id="flight-table-container" >
            {{-- Initial Load --}}
            <div class="glass-card fixed-height-table">
                <div class="table-wrapper">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Flight</th>
                                <th>Schedule</th>
                                <th>Destination</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($flights as $flight)
                                <tr>
                                    <td class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('storage/' . $flight->logo) }}" alt="Logo Airline"
                                            style="margin-right: 10px; max-width:100px; max-height:100px; object-fit:contain;">
                                        <span class="fw-semibold">{{ $flight->flight_no }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($flight->schedule)->format('H:i') }}</td>
                                    <td>{{ ucfirst($flight->destinasi) }}</td>
                                    <td>
                                        @php
                                            $colorClass = match ($flight->status) {
                                                'check-in' => 'bg-info text-white',
                                                'boarding' => 'bg-warning text-white',
                                                'cancel' => 'bg-danger text-white',
                                                'delayed' => 'bg-secondary text-white',
                                                'to-waiting-room' => 'bg-dark text-white',
                                                default => 'bg-success text-white',
                                            };
                                        @endphp

                                        <span class="px-3 py-1 rounded d-inline-block {{ $colorClass }}">
                                            {{ ucfirst($flight->status ?? 'On-schedule') }}
                                        </span>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    </div>

    <script>
        function updateClockAndDate() {
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
            document.getElementById('realtime-date').innerText = now.toLocaleDateString('id-ID', options);
        }

        setInterval(updateClockAndDate, 1000);
        updateClockAndDate();

        let currentPage = 1;
        const totalPages = {{ $flights->lastPage() }};
        const delayInSeconds = 10;

        function loadPage(page) {
            $.ajax({
                url: `{{ route('public.jadwal') }}?page=${page}`,
                type: 'GET',
                success: function(response) {
                    const html = $(response).find("#flight-table-container").html();
                    $("#flight-table-container").html(html);
                }
            });
        }

        if (totalPages > 1) {
            setInterval(() => {
                currentPage++;
                if (currentPage > totalPages) currentPage = 1;
                loadPage(currentPage);
            }, delayInSeconds * 1000);
        }

        // Fungsi untuk refresh data dari server
function refreshTable() {
    $.ajax({
        url: `{{ route('public.jadwal') }}?page=${currentPage}`,
        type: 'GET',
        success: function(response) {
            const html = $(response).find("#flight-table-container").html();
            $("#flight-table-container").html(html);
        }
    });
}

// Auto-refresh tiap 10 detik, selalu jalan
setInterval(() => {
    refreshTable();

    // Kalau lebih dari 1 halaman, ganti page juga
    if (totalPages > 1) {
        currentPage++;
        if (currentPage > totalPages) currentPage = 1;
    }
}, delayInSeconds * 500);

    </script>

@endsection
