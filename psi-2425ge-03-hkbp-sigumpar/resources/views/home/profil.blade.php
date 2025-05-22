<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil</title>
    <link rel="stylesheet" href="/css/profil gereja.css">

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
    <section class="section">
        <div class="bg-circle-mid"></div> <!-- Tambahan lingkaran tengah bawah -->

        <div class="content-container">
            <div class="content">
                <h2>Sejarah Gereja</h2>
                <p>Dr. Ingwer Ludwig Nommensen adalah misionaris Jerman yang menyebarkan agama Kristen di Tanah Batak
                    dan menjadi ephorus pertama HKBP. Ia lahir pada 6 Februari 1834 di Nordstrand, Jerman, dan wafat di
                    Sigumpar, Toba Samosir, pada 23 Mei 1918. Napak tilas perjalanan Nommensen menjadi bagian dari
                    peringatan Jubileum 150 tahun HKBP. Rombongan napak tilas mengunjungi makam Nommensen di Sigumpar,
                    yang menjadi tujuan wisata rohani.</p>
                <p>Makamnya dilapisi marmer dengan latar belakang Danau Toba dan berada dalam kompleks bersama keluarga
                    dan rekan-rekan sepelayanan. Meski demikian, akses jalan menuju makam masih kurang memadai.
                    Pemerintah Kabupaten Toba Samosir dan HKBP terus mengelola serta mengembangkan kompleks ini sebagai
                    destinasi wisata rohani. Wisatawan, termasuk keturunan Nommensen dari Jerman, kerap berkunjung untuk
                    menghormati jasanya dalam membebaskan masyarakat Batak dari animisme dan keterbelakangan.</p>
            </div>

            <div class="image-wrapper text-center">
                <div class="circle-bg"></div>
                <img src="/images/gereja no background.png" alt="Gereja HKBP Sigumpar"
                    class="rounded shadow church-image">
            </div>
        </div>
    </section>

    <section class="wave-section">
        <div class="content-container">
            <img src="/images/yesus.jpeg" alt="Yesus" class="img-rounded">
            <div class="visi-misi">
                <h3>VISI</h3>
                <p>MENJADI BERKAT BAGI DUNIA</p>
                <h3>MISI</h3>
                <ul>
                    <li>1. Beribadah kepada Allah Tri Tunggal Bapa, Anak, dan Roh Kudus, dan bersekutu dengan
                        saudara-saudara seiman.</li>
                    <li>2. Mendidik jemaat supaya sungguh-sungguh menjadi anak Allah dan warga negara yang baik.</li>
                    <li>3. Mengabarkan Injil kepada yang belum mengenal Kristus dan yang sudah menjauh dari gereja.</li>
                    <li>4. Mendoakan dan menyampaikan pesan kenabian kepada masyarakat dan Negara.</li>
                    <li>5. Menggarami dan menerangi budaya Batak, Indonesia dan Global dengan Injil.</li>
                    <li>6. Memulihkan harkat dan martabat orang kecil dan tersisih melalui pendidikan, kesehatan, dan
                        pemberdayaan ekonomi masyarakat.</li>
                    <li>7. Membangun dan mengembangkan kerjasama antar gereja dan dialog lintas agama.</li>
                    <li>8. Mengembangkan penatalayanan (pelayan, organisasi, administrasi, keuangan, dan aset) dan
                        melaksanakan pembangunan gereja dan lingkungan hidup.</li>
                </ul>
            </div>
        </div>
    </section>


    <section class="nommensen-section">
        <div class="image-row">
            <img src="/images/makam 1.jpeg" alt="Gambar 1">
            <img src="/images/makam 2.jpeg" alt="Gambar 2">
            <img src="/images/makam3.jpeg" alt="Gambar 3">
        </div>

        <div class="content-box">
            <h2 class="grave-title">MAKAM MISIONARIS DR. I.L. NOMMENSEN</h2>
            <p> Makam misionaris agama Kristen asal Jerman, DR I.L Nommensen yang berada di Kompleks Gereja Huria
                Kristen Batak Protestan (HKBP) I.L Nommensen Sigumpar, Kecamatan Sigumpar, Kabupaten Toba, Provinsi
                Sumatra Utara kini sering dikunjungi wisatawan. Kunjungan ini sering disebut wsiata rohani. Salah
                seorang pengurus Gereja HKBP Nomensen Pdt. Giovani Siregar, Selasa (28/2/23) di sela-sela memandu
                wisatawan yang berkunjung, mengatakan DR I.L Nomensen adalah seorang misionaris yang membawa perubahan
                pola pikir dan kepercayaan yang mendasar bagi masyarakat Batak untuk melangkah keluar dari pola animisme
                ke arah Hakristenon (Agama Kristen) bagi orang Batak.</p>
            <p> Di masa hidupnya Nommensen mengamati bahwa daerah Sigumpar merupakan titik sentral wilayah Toba dalam
                rangka penyebaran Injil. Maka sejak Nommensen tinggal dan bermukim di Sigumpar ia mulai melaksanakan
                misinya yaitu menyebarkan Injil di daerah Sigumpar dan sekitarnya. DR I.L Nommensen menghembuskan nafas
                terakhirnya pada usia 84 tahun tepatnya pada tanggal 23 Mei 1918, kemudian beliau dimakamkan di belakang
                Gereja HKBP Nommensen Sigumpar. Ia dimakamkan satu lokasi dengan istri dan putrinya serta teman-teman
                seperjuangannya. Salah seorang pengunjung Virna Damadella mengatakan bahwa mereka sengaja berkunjung ke
                makam DR I.L Nommensen untuk memperluas wawasan sejarah tentang perjuangan Nommensen yang begitu gigih
                menyebarkan Injil agama kristen di daerah Kawasan Danau Toba.</p>
            <p> Ketika berkunjung ke makam DR I.L Nommensen dengan sendirinya kita dapat lebih memahami tentang begitu
                banyaknya halangan dan rintangan yang di lalui oleh Nomensen ketika itu dalam penyebaran Injil Agama
                Kristen," katanya. Namun halangan dan rintangan yang dilalui oleh DR I.L Nommensen selalu dapat
                dilaluinya dan berhasil merubah pola pikir dan kepercayaan Agama Kristen yang mendasar bagi mayoritas
                masyarakat Batak pada umunya. Nommensen dan misionaris lainnya memperkenalkan pendidikan dan kesehatan
                modern yang menjadi cikal bakal kemajuan dan pembaharuan hidup masyarakat Batak.(MC Toba gaol/rik) </p>
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
