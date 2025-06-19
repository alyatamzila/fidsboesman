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
        padding-top: 30px;
        padding-bottom: 50px;
    }
    .card-transparent {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        color: #fff;
        width: 80%;
        max-width: 100%;
        margin: auto;
    }
    label {
        color: #e9ecef;
        font-weight: 500;
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
    h3 {
        font-weight: 600;
        color: #fff;
    }
    /* .btn-primary, .btn-rounded {
        border-radius: 30px;
        padding: 10px 30px;
        font-weight: 600;
    } */
    .btn {
        border-radius: 5px;
        font-weight: 500;
    }
</style>

<div class="container page-wrapper">
    <div class="card-transparent mt-3">
        <h3 class="mb-4">Edit Flight Data</h3>

        <form method="POST" action="{{ route('flights.update', $flight->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            {{-- Schedule --}}
            <div class="mb-3">
                <label for="schedule" class="form-label">Schedule</label>
                <input type="time" name="schedule" id="schedule" class="form-control" required
                    value="{{ old('schedule', \Carbon\Carbon::parse($flight->schedule)->format('H:i')) }}">
            </div>

            {{-- Logo --}}
            <div class="mb-3">
                <label for="logo" class="form-label">Airline</label><br>
                @if($flight->logo)
                    <img src="{{ asset('storage/' . $flight->logo) }}" width="100" class="mb-2 rounded shadow-sm">
                @endif
                <input type="file" name="logo" id="logo" class="form-control">
                <img id="preview-logo" class="mt-3 rounded" style="max-height: 100px; display: none;">
                @error('logo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Flight No --}}
            <div class="mb-3">
                <label for="flight_no" class="form-label">Flight No</label>
                <input type="text" name="flight_no" id="flight_no" class="form-control"
                       value="{{ $flight->flight_no }}" placeholder="Contoh: GA123" required>
                @error('flight_no')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label for="status" class="form-label" >Status</label>
                <select name="status" id="status" class="form-control" required>
                    @php
                        $currentStatus = old('status') ?? $flight->status;
                    @endphp
                    <option value="on-schedule" {{ $currentStatus == 'on-schedule' ? 'selected' : '' }}>On-Schedule</option>
                    <option value="check-in" {{ $currentStatus == 'check-in' ? 'selected' : '' }}>Check-In</option>
                    <option value="boarding" {{ $currentStatus == 'boarding' ? 'selected' : '' }}>Boarding</option>
                    <option value="cancel" {{ $currentStatus == 'cancel' ? 'selected' : '' }}>Cancel</option>
                    <option value="delayed" {{ $currentStatus == 'delayed' ? 'selected' : '' }}>Delayed</option>
                    <option value="to-waiting-room" {{ $currentStatus == 'to-waiting-room' ? 'selected' : '' }}>To Waiting Room</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Destinasi --}}
            <div class="mb-3">
                <label for="destinasi" class="form-label">Destination</label>
                <select name="destinasi" id="destinasi" class="form-control" required>
                    @php
                        $currentDestinasi = old('destinasi') ?? $flight->destinasi;
                    @endphp
                    <option value="ternate" {{ $currentDestinasi == 'ternate' ? 'selected' : '' }}>Ternate</option>
                    <option value="labuha" {{ $currentDestinasi == 'labuha' ? 'selected' : '' }}>Labuha</option>
                    <option value="manado" {{ $currentDestinasi == 'manado' ? 'selected' : '' }}>Manado</option>
                    <option value="jakarta" {{ $currentDestinasi == 'jakarta' ? 'selected' : '' }}>Jakarta</option>
                </select>
                @error('destinasi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <button type="submit" class="btn btn-success px-4">Save Changes</button>
            <a href="{{ route('manage.flights') }}" class="btn btn-secondary btn-rounded px-4 ms-2">Back</a>
        </form>
    </div>
</div>

<script>
    document.getElementById('logo').addEventListener('change', function (e) {
        const [file] = e.target.files;
        if (file) {
            const preview = document.getElementById('preview-logo');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
</script>

@endsection
