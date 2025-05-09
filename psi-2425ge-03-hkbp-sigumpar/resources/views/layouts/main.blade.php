<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gereja Kita')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- jika ada CSS inline untuk navbar, kamu bisa @include di sini --}}
</head>
<body>

    {{-- Include navbar partial --}}
    @include('navbar')

    <main class="container">
        {{-- Konten halaman akan disuntik di sini --}}
        @yield('content')
    </main>

    {{-- jika ada JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
