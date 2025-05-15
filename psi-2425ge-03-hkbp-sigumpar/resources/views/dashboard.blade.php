<x-app-layout>
    <link rel="stylesheet" href="/css/beranda.css">
    {{-- <body> --}}

    <section class="hero">
        <div class="hero-content">
            <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo">
            <p>HKBP DR I.L.Nommensen Sigumpar</p>
            <p class="ayat">Lalu Ia berkata kepada mereka "Pergilah ke seluruh dunia, beritakanlah Injil kepada
                segala
                makhluk".<br>Markus 16:15</p>
            <h3>Jadilah bagian jemaat dalam gereja kami</h3>
        </div>
        <div class="hero-image">
            <img src="/images/yesus_chiby.jpeg" alt="Jesus Character">
        </div>
    </section>


    <section class="upcoming-event">
        <h2>Upcoming Event</h2>

        <div class="carousel-wrapper">
            <button class="arrow left" onclick="moveSlide(-1)">&#10094;</button>

            <div class="carousel" id="carousel">
                <div class="card active">
                    <img src="/images/sekolah-minggu.jpg" alt="Sekolah Minggu">
                    <div class="info">
                        <h3>Sekolah Minggu</h3>
                        <p>Anak-anak berkumpul untuk mendengarkan cerita Alkitab yang disampaikan oleh guru sekolah
                            minggu..</p>
                        <button>Info Selengkapnya..</button>
                    </div>
                </div>

                <div class="card">
                    <img src="/images/natal.jpeg" alt="Perayaan Natal">
                    <div class="info">
                        <h3>Perayaan Natal</h3>
                        <p>Ibadah dan perayaan sukacita menyambut kelahiran Yesus Kristus.</p>
                        <button>Info Selengkapnya..</button>
                    </div>
                </div>

                <div class="card">
                    <img src="/images/event3.jpg" alt="Retreat Remaja">
                    <div class="info">
                        <h3>Retreat Remaja</h3>
                        <p>Kegiatan rohani bagi remaja untuk memperdalam iman dan persekutuan.</p>
                        <button>Info Selengkapnya..</button>
                    </div>
                </div>
            </div>

            <button class="arrow right" onclick="moveSlide(1)">&#10095;</button>
        </div>

        <div class="indicators" id="indicators">
            <span onclick="goToSlide(0)" class="dot active"></span>
            <span onclick="goToSlide(1)" class="dot"></span>
            <span onclick="goToSlide(2)" class="dot"></span>
        </div>
    </section>

    <section class="documentation">
        <h2>Documentation</h2>
        <div class="doc-gallery">
            <div class="doc-item">
                <img src="/images/Ina Kamis.png" alt="PHD Ina kamis">
                <p>PHD Ina kamis</p>
            </div>
            <div class="doc-item">
                <img src="/images/Kunjungan.jpeg" alt="Kunjungan Parguru Malua Resort Sauta">
                <p>Kunjungan Parguru Malua Resort Sauta</p>
            </div>
        </div>
    </section>

    <script src="/public/js/script.js"></script>
    {{-- </body> --}}


</x-app-layout>
