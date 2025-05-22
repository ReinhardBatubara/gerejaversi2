<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gereja Kita')</title>
    <style>
        /* Reset some basic styles for consistency */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f7fc;
            color: #333;
        }

        /* Navbar Styling */
        nav {
            background-color: white; /* Warna biru yang kuat */
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            margin: 0 15px;
            font-size: 18px;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav a:hover {
            background-color: #2e59d9; /* Biru lebih gelap saat hover */
            color: #ffffff;
            border-radius: 5px;
        }

        nav a.active {
            background-color: #1f4f97; /* Biru sangat gelap untuk link aktif */
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Heading Styling */
        h1 {
            font-size: 36px;
            color: #2e59d9;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
        }

        /* Alert Styling */
        .alert {
            font-size: 18px;
            color: #004085;
            background-color: #cce5ff;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Grid Layout for Notifications */
        .row {
            display: flex;
            flex-direction: column;  /* Menyusun elemen secara vertikal */
            gap: 20px;  /* Memberikan jarak antar notifikasi */
        }

        .col {
            width: 100%; /* Kolom menjadi full-width */
            box-sizing: border-box;
        }

        /* Card Styling */
        .notification-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ddd;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .notification-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        /* Card Body */
        .notification-card .card-body {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
        }

        /* Card Footer (Button) */
        .notification-card .card-footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: right;
        }

        .notification-btn {
            background-color: transparent;
            color: #4e73df;
            border: 1px solid #4e73df;
            padding: 5px 15px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .notification-btn:hover {
            background-color: #4e73df;
            color: white;
        }

        /* Footer Styling */
        footer {
            background-color: #4e73df;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 576px) {
            nav {
                padding: 10px 0;
            }
            nav a {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>

    {{-- Include navbar partial --}}
    @include('navbaradmin')

    <main class="container">
        {{-- Konten halaman akan disuntik di sini --}}
        @yield('content')
    </main>

    {{-- jika ada JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
