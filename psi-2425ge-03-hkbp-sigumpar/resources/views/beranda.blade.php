<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKBP DR.I.L.Nommensen Sigumpar</title>
    <link rel="stylesheet" href="/css/beranda.css">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="page-home">

    @include('navbar')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo">
            <p>HKBP DR I.L.Nommensen Sigumpar</p>
            <p class="ayat">
                Lalu Ia berkata kepada mereka "Pergilah ke seluruh dunia, beritakanlah Injil kepada segala makhluk".<br>
                Markus 16:15
            </p>
            <h3>Jadilah bagian jemaat dalam gereja kami</h3>
        </div>
        <div class="hero-image">
            <img src="/images/yesus_chiby.jpeg" alt="Jesus Character">
        </div>
    </section>

    <!-- Upcoming Event -->
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
                    <img src="/images/pentakosta.jpeg" alt="Perayaan Pentakosta">
                    <div class="info">
                        <h3>Perayaan Pentakosta</h3>
                        <p>Hari raya Kristiani yang memperingati peristiwa dicurahkannya Roh Kudus kepada para rasul.</p>
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

    <!-- Documentation -->
    <section class="documentation">
        <h2>Documentation</h2>
        <div class="doc-gallery">
            <div class="doc-item">
                <img src="/images/Ina Kamis.png" alt="PHD Ina Kamis">
                <p>PHD Ina Kamis</p>
            </div>
            <div class="doc-item">
                <img src="/images/Kunjungan.jpeg" alt="Kunjungan Parguru">
                <p>Kunjungan Parguru Malua Resort Sauta</p>
            </div>
        </div>
    </section>

    <!-- Chart Section -->
    <section class="chart-container" style="padding: 2rem; height: 400px;">
        <h2 style="text-align: center;">Jumlah Jemaat Bulanan</h2>
        <canvas id="jemaatChart"></canvas>
    </section>

    <!-- Script Carousel -->
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

        window.addEventListener('load', () => {
            updateActiveCard();
        });
    </script>

    <!-- Script Ambil Data dan Tampilkan Grafik -->
    <script>
        function renderChart() {
            fetch('/chart-data')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('jemaatChart').getContext('2d');

                    if (window.jemaatChartInstance) {
                        window.jemaatChartInstance.destroy();
                    }

                    window.jemaatChartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [
                                { label: 'Bapak', data: data.bapak, backgroundColor: '#e74c3c' },
                                { label: 'Ibu', data: data.ibu, backgroundColor: '#3498db' },
                                { label: 'Anak', data: data.anak, backgroundColor: '#f1c40f' },
                                { label: 'Remaja', data: data.remaja, backgroundColor: '#2ecc71' },
                                { label: 'Lansia', data: data.lansia, backgroundColor: '#9b59b6' }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Jumlah Jemaat Per Bulan',
                                    font: { size: 18 }
                                },
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { precision: 0 }
                                }
                            }
                        }
                    });
                });
        }

        renderChart();
        setInterval(renderChart, 10000);
    </script>

</body>
</html>
