<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-wrapper">
        <!-- HERO -->
        <section class="hero" aria-label="Hero Section">
            <div class="hero-content">
                <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo" />
                <p class="church-name">HKBP DR I.L.Nommensen Sigumpar</p>
                <p class="ayat">
                    <span class="intro">Lalu Ia berkata kepada mereka</span><br />
                    <q>Pergilah ke seluruh dunia, beritakanlah Injil kepada segala makhluk</q><br />
                    <em>Markus 16:15</em>
                </p>
                <h3 class="cta">Jadilah bagian jemaat dalam gereja kami</h3>
            </div>
            <div class="hero-image">
                <img src="/images/Yesus_2.jpg" alt="Jesus Character" />
            </div>
        </section>

       <!-- PROFIL PENDETA -->
<section class="pastor-profile" aria-label="Profil Pendeta">
    <h2>Profil Pendeta</h2>
    @if ($profile)
    <div class="profile-container">
        <div class="photo">
            <img src="{{ asset('storage/' . $profile->photo_url) }}" alt="Foto Pendeta {{ $profile->nama }}">
        </div>
        <div class="info">
            <h3>{{ $profile->nama }}</h3>
            <p><strong>Jabatan:</strong> {{ $profile->posisi }}</p>
            <p>{{ $profile->deskripsi }}</p>

            <!-- Tombol Edit -->
            <a href="{{ route('admin.profile-pendeta.edit') }}" 
               class="btn btn-secondary mt-4"
               style="display: inline-block; padding: 0.5rem 1rem; background-color: #6c757d; color: white; border-radius: 6px; text-decoration: none;">
                Edit Profil Pendeta
            </a>
        </div>
    </div>
    @else
        <p>Profil pendeta belum tersedia.</p>
    @endif
</section>


        <!-- LOKASI GEREJA -->
        <section class="lokasi-gereja" aria-label="Lokasi Gereja">
            <h2>Lokasi Gereja</h2>
            @if ($location)
            <div class="map-container">
                <iframe
                    src="{{ $location->embed_url }}"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" title="Peta Lokasi Gereja"></iframe>
            </div>
            @else
                <p>Lokasi gereja belum tersedia.</p>
            @endif
        </section>

        <!-- DOKUMENTASI KEGIATAN -->
        <section class="upcoming-event" aria-label="Dokumentasi Kegiatan">
            <div class="upcoming-header">
                <h2 class="upcoming-title">Dokumentasi Kegiatan</h2>
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-4">Tambah Event Baru</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="center-container">
                <div class="carousel-wrapper">
                    <button class="arrow left" onclick="moveSlide(-1)" aria-label="Previous">&#10094;</button>

                    <div class="carousel" id="carousel">
                        @foreach ($events as $index => $event)
                            <article class="card @if ($index == 0) active @endif" role="group"
                                aria-roledescription="slide" aria-label="Slide {{ $index + 1 }}">
                                <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}">
                                <div class="info">
                                    <h3>{{ $event->title }}</h3>
                                    <p>{{ Str::limit($event->description, 150) }}</p>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm" aria-label="Edit {{ $event->title }}">Edit</a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
                                            style="display:inline-block;" onsubmit="return confirm('Yakin hapus event ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" aria-label="Hapus {{ $event->title }}">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <button class="arrow right" onclick="moveSlide(1)" aria-label="Next">&#10095;</button>
                </div>
            </div>
        </section>

    </div>

    <script>
        let currentIndex = 0;
        const cards = document.querySelectorAll('.carousel .card');

        function updateActiveCard() {
            cards.forEach((card, i) => {
                card.classList.toggle('active', i === currentIndex);
            });
        }

        function moveSlide(step) {
            currentIndex += step;
            if (currentIndex < 0) currentIndex = cards.length - 1;
            if (currentIndex >= cards.length) currentIndex = 0;
            updateActiveCard();
        }

        window.addEventListener('load', () => {
            updateActiveCard();
        });
    </script>


    <style>
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
            margin: 0 auto 1rem auto; /* atas 0, kanan auto, bawah 1rem, kiri auto */
            display: block;
        }


        .church-name {
           font-size: 1.6rem;
           font-weight: 700;
           color: #003366;
           margin-bottom: 1rem;
           display: block;
           text-align: center;
           transform: translateX(20px); /* geser ke kanan 20px */
        }


        .ayat {
            font-size: 1.1rem;
            font-style: normal;
            color: #555;
            line-height: 1.6;
            margin-bottom: 1.8rem;
            margin-left: 20px;
        }
        
        .ayat .intro {
            display: block;
            margin-left: 180px; /* Geser ke kanan */
        }

        .ayat q {
            quotes: "“" "”" "‘" "’";
            font-style: italic;
            color: #003366;
        }

.ayat em {
    display: block;
    margin-left: 220px; /* Geser ke kanan */
    margin-top: 0.5rem;
    font-weight: 600;
    color: #666;
}

.cta {
    font-size: 1.5rem;
    font-weight: 600;
    background: linear-gradient(to right, #003366, #0055aa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-align: center;
    margin: 30px auto;
    display: block;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    transition: transform 0.4s ease-in-out;
}

.cta:hover {
    transform: scale(1.05);
    text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
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
            max-width: 1040px;
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
           transform: translateX(-20px); /* geser ke kiri 20px */
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

         .upcoming-header {
                text-align: center;
                margin-bottom: 2rem;
            }

        .upcoming-header h2 {
                font-size: 2rem;
                font-weight: bold;
                color: #003366;
                margin-bottom: 1rem;
            }

        .upcoming-header .btn {
                display: inline-block;
                margin-top: 0.5rem;
            }


        /* CAROUSEL */
        .carousel-wrapper {
            max-width: 900px;
            width : 100%;
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

        /* Buttons inside carousel cards */
        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            border: none;
            transition: background-color 0.25s ease;
            user-select: none;
            white-space: nowrap;
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
</x-app-layout>