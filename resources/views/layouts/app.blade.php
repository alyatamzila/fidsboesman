<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIDS Oesman Airport App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .container {
            padding: 0 !important;
            margin: 0 !important;
            max-width: 100% !important;
            width: 100% !important;
        }

        .header-video {
            margin: 0;
            padding: 0;
            width: 100%;
            position: relative;
        }

        .header-video video {
            display: block;
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
        }

        .custom-alert {
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.5s ease, transform 0.5s ease;

    position: relative;
    margin-top: 1rem;
    width: 100%;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;

    z-index: 999;
    border-radius: 8px;
    padding: 12px 20px;
    font-size: 1rem;
    text-align: center;
}


        .custom-alert.hide {
            opacity: 0;
            transform: translateY(-10px);
        }
    </style>
</head>

<body>
    <!-- Background Video -->
    <video autoplay muted loop class="video-bg">
        <source src="{{ asset('videos/cloud.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Optional dark overlay to increase text visibility -->
    <div class="overlay"></div>

    <!-- Main Content -->
    <div class="container">

        <div class="header-video position-relative">
            <video autoplay muted loop class="w-100">
                <source src="{{ asset('videos/animasi heading fids.mp4') }}" type="video/mp4">
            </video>
        </div>

        {{-- Alert message --}}
        @if (session('success'))
            <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert"">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                {{ $errors->first() }}
            </div>
        @endif



        {{-- Konten dinamis --}}
        @yield('content')
    </div>
    </div>

    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.custom-alert');
            alerts.forEach(alert => {
                alert.classList.add('hide');
                setTimeout(() => alert.remove(), 500);
            });
        }, 1000);
    </script>


</body>

</html>
