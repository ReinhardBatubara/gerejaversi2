<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HKBP Nomensen</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind (assume via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#f5f7fa] text-[#4A3720] flex flex-col min-h-screen">
    <!-- Navbar -->
    <header class="bg-white shadow-md py-4 px-6 lg:px-20">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <!-- Logo / Brand -->
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#6B4F29]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                </svg>
                <span class="text-2xl font-bold text-[#6B4F29] tracking-wide">Profil HKBP Nomensen</span>
            </div>

            <!-- Navigation Links -->
            <nav class="flex items-center space-x-4 text-sm">
                <a href="{{ url('/') }}"
                    class="px-4 py-2 rounded-md text-[#6B4F29] hover:bg-[#f0eae3] hover:text-[#4a361e] transition duration-300 font-medium">
                    Home
                </a>
                <a href="{{ url('/profil') }}"
                    class="px-4 py-2 rounded-md text-[#6B4F29] hover:bg-[#f0eae3] hover:text-[#4a361e] transition duration-300 font-medium">
                    Profil
                </a>

                <a href="{{ url('/jadwals') }}"
                    class="px-4 py-2 rounded-md text-[#6B4F29] hover:bg-[#f0eae3] hover:text-[#4a361e] transition duration-300 font-medium">
                    Jadwal Ibadah
                </a>

                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-4 py-2 rounded-md text-[#6B4F29] hover:bg-[#f0eae3] hover:text-[#4a361e] transition duration-300 font-medium">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-md text-[#6B4F29] hover:bg-[#f0eae3] hover:text-[#4a361e] transition duration-300 font-medium">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-[#6B4F29] text-white px-4 py-2 rounded-full hover:bg-[#4a361e] transition duration-300 shadow font-medium">
                            Daftar
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>



    <!-- Hero Section -->
    <div class="page-wrapper">
        <!-- HERO -->
        <section class="hero">
            <div class="hero-content">
                <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo" />
                <p class="church-name">HKBP DR I.L.Nommensen Sigumpar</p>
                <p class="ayat">
                    Lalu Ia berkata kepada mereka<br />
                    <q>“Pergilah ke seluruh dunia, beritakanlah Injil kepada segala makhluk”.</q><br />
                    <em>Markus 16:15</em>
                </p>
                <h3 class="cta">Jadilah bagian jemaat dalam gereja kami</h3>
            </div>
            <div class="hero-image">
                <img src="/images/yesus_chiby.jpeg" alt="Jesus Character" />
            </div>
        </section>
        <!-- Profil Pendeta -->
        <section class="pastor-profile">
            <h2>Profil Pendeta</h2>
            <div class="profile-container">
                <div class="photo">
                    <img src="/images/Pendeta.jpg" alt="Foto Pendeta" />
                </div>
                <div class="info">
                    <h3>Pdt. Jonni D.S.Tambun, S.Th</h3>
                    <p><strong>Jabatan:</strong> Kepala Pendeta Gereja HKBP DR. IL. Nommensen Sigumpar</p>
                    <p>
                        Pdt. Jonni D.S.Tambun, S.Th adalah seorang pendeta berpengalaman yang memimpin komunitas dengan
                        penuh kasih dan dedikasi. Beliau aktif dalam pelayanan rohani dan pengembangan gereja serta
                        keterlibatan sosial masyarakat.
                    </p>
                </div>
            </div>

            <h2>Lokasi Gereja</h2>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.189042659229!2d99.15482971526766!3d2.3948522523934147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e0059f78cc793%3A0x37e26becd0b5a454!2sGereja%20HKBP%20DR.%20IL.%20Nommensen%20Sigumpar!5e0!3m2!1sid!2sid!4v1684417912345!5m2!1sid!2sid"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-[#6B4F29] text-white text-sm text-center py-4">
            &copy; {{ date('Y') }} HKBP DR I.L.Nommensen Sigumpar. All rights reserved.
        </footer>
</body>


<script>
    let currentIndex = 0;
    const cards = document.querySelectorAll('.carousel .card');
    const dots = document.querySelectorAll('.dot');

    function updateActiveCard() {
        cards.forEach((card, i) => {
            card.classList.toggle('active', i === currentIndex);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
            dot.setAttribute('aria-selected', i === currentIndex ? 'true' : 'false');
        });
    }

    function moveSlide(step) {
        currentIndex += step;
        if (currentIndex < 0) currentIndex = cards.length - 1;
        if (currentIndex >= cards.length) currentIndex = 0;
        updateActiveCard();
    }

    function goToSlide(index) {
        currentIndex = index;
        updateActiveCard();
    }

    window.addEventListener('load', () => {
        updateActiveCard();
    });
</script>

<style>
    /* Wrapper untuk background dan padding */
    .page-wrapper {
        background-color: #f5f7fa;
        padding: 2rem 1rem 4rem;
        font-family: Arial, sans-serif;
        color: #333;
        min-height: 100vh;
    }

    /* HERO */
    .hero {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto 3rem auto;
        padding: 2rem 0;
    }

    .hero-content {
        flex: 1 1 400px;
        max-width: 600px;
        text-align: left;
    }

    .logo {
        width: 140px;
        height: auto;
        margin-bottom: 1rem;
        display: block;
    }

    .church-name {
        font-size: 1.6rem;
        font-weight: 700;
        color: #003366;
        margin-bottom: 1rem;
    }

    .ayat {
        font-size: 1.1rem;
        font-style: normal;
        color: #555;
        line-height: 1.6;
        margin-bottom: 1.8rem;
    }

    .ayat q {
        quotes: "“" "”" "‘" "’";
        font-style: italic;
        color: #003366;
    }

    .ayat em {
        display: block;
        margin-top: 0.5rem;
        font-weight: 600;
        color: #666;
    }

    .cta {
        font-size: 1.3rem;
        font-weight: 700;
        color: #005bbb;
        cursor: default;
    }

    .hero-image {
        flex: 1 1 300px;
        max-width: 400px;
        text-align: center;
    }

    .hero-image img {
        max-width: 100%;
        height: auto;
        border-radius: 16px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* PROFILE PENDETA */
    .pastor-profile {
        max-width: 900px;
        margin: 0 auto 3rem auto;
    }

    .pastor-profile h2 {
        font-size: 2rem;
        color: #003366;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }

    .profile-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        align-items: center;
        margin-bottom: 2rem;
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }

    .photo {
        flex: 1 1 250px;
        max-width: 250px;
    }

    .photo img {
        width: 100%;
        border-radius: 8px;
        object-fit: cover;
        display: block;
    }

    .info {
        flex: 2 1 400px;
    }

    .info h3 {
        margin-bottom: 0.5rem;
        color: #003366;
    }

    .info p {
        line-height: 1.5;
        margin-bottom: 0.5rem;
        color: #444;
    }

    /* MAP */
    .map-container {
        width: 100%;
        height: 350px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 3rem;
    }

    /* CAROUSEL */
    .carousel-wrapper {
        max-width: 900px;
        margin: 0 auto 3rem auto;
        position: relative;
    }

    .carousel {
        display: flex;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .carousel .card {
        min-width: 100%;
        display: none;
        flex-shrink: 0;
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
        transition: opacity 0.3s ease;
        user-select: none;
    }

    .carousel .card.active {
        display: block;
    }

    .carousel .card img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .info h3 {
        margin-bottom: 0.5rem;
        font-weight: 700;
        color: #222;
    }

    .info p {
        color: #555;
        font-size: 1rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    /* Navigation arrows */
    .arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.3);
        border-radius: 8px;
        border: none;
        color: white;
        font-size: 2.5rem;
        padding: 0 0.8rem;
        cursor: pointer;
        user-select: none;
        z-index: 10;
        transition: background-color 0.3s ease;
    }

    .arrow:hover {
        background: rgba(0, 0, 0, 0.55);
    }

    .arrow.left {
        left: 1rem;
    }

    .arrow.right {
        right: 1rem;
    }

    /* Dots indicators */
    .indicators {
        text-align: center;
        margin-top: 1.25rem;
    }

    .dot {
        display: inline-block;
        width: 14px;
        height: 14px;
        margin: 0 8px;
        background: #bbb;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .dot.active {
        background: #333;
    }

    .dot:hover {
        background: #666;
    }

    /* Buttons */
    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        border: none;
        transition: background-color 0.25s ease;
        user-select: none;
    }

    .btn-primary {
        background-color: #005bbb;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #004080;
    }

    .btn-warning {
        background-color: #f0ad4e;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #d48806;
    }

    .btn-danger {
        background-color: #d9534f;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #a9322f;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .hero {
            flex-direction: column;
            padding: 2rem 1rem;
        }

        .hero-content,
        .hero-image {
            max-width: 100%;
            text-align: center;
        }

        .hero-content {
            order: 2;
        }

        .hero-image {
            order: 1;
            margin-bottom: 1.5rem;
        }

        .profile-container {
            flex-direction: column;
        }

        .photo,
        .info {
            max-width: 100%;
        }

        .carousel-wrapper {
            max-width: 100%;
            margin: 2rem auto;
        }
    }
</style>

</html>
