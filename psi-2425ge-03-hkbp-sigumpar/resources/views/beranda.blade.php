<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKBP DR.I.L.Nommensen Sigumpar</title>
    <link rel="stylesheet" href="/css/beranda.css">
</head>
@include('navbar')


<body class="page-home">




<body class="page-home">
    <section class="hero">
        <div class="hero-content">
            <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo">
            <p>HKBP DR I.L.Nommensen Sigumpar</p>
            <p class="ayat">Lalu Ia berkata kepada mereka "Pergilah ke seluruh dunia, beritakanlah Injil kepada segala makhluk".<br>Markus 16:15</p>
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
              <img src="/images/Jumat Agung.jpeg" alt="Jumat Agung">
              <div class="info">
                <h3>Jumat Agung</h3>
                <p>Ibadah Peringatan akan kematian Yesus Kristus dalam menebus dosa umatnya.</p>
                <button>Info Selengkapnya..</button>
              </div>
            </div>

            <div class="card">
              <img src="/images/pentakosta.jpeg" alt="Perayaan Natal">
              <div class="info">
                <h3>Perayaan Pentakosta</h3>
                <p>hari raya Kristiani yang memperingati peristiwa dicurahkannya Roh Kudus kepada para rasul di Yerusalem....</p>
                <button>Info Selengkapnya..</button>
              </div>
            </div>

            <div class="card">
              <img src="/images/Retreat.jpeg" alt="Retreat Remaja">
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

        // Inisialisasi awal
        window.addEventListener('load', () => {
          updateActiveCard();
        });
      </script>

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

</body>
</html>
