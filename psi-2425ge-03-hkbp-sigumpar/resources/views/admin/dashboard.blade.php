<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>HKBP DR.I.L.Nommensen Sigumpar</title>

    <!-- Stylesheet dan Script -->
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="page-home">

    @include('navbaradmin')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo" />
            <p>HKBP DR I.L.Nommensen Sigumpar</p>
            <p class="ayat">
                Lalu Ia berkata kepada mereka "Pergilah ke seluruh dunia, beritakanlah Injil kepada segala makhluk".<br />
                Markus 16:15
            </p>
            <h3>Jadilah bagian jemaat dalam gereja kami</h3>
        </div>
        <div class="hero-image">
            <img src="/images/yesus_chiby.jpeg" alt="Jesus Character" />
        </div>
    </section>

    <!-- Upcoming Event -->
    <section class="upcoming-event">
        <h2>Upcoming Event</h2>
        <div class="carousel-wrapper">
            <button class="arrow left" onclick="moveSlide(-1)">&#10094;</button>
            <div class="carousel" id="carousel">
                <div class="card active">
                    <img src="/images/Jumat Agung.jpeg" alt="Jumat Agung" />
                    <div class="info">
                        <h3>Jumat Agung</h3>
                        <p>Ibadah Peringatan akan kematian Yesus Kristus dalam menebus dosa umatnya.</p>
                        <button>Info Selengkapnya..</button>
                    </div>
                </div>
                <div class="card">
                    <img src="/images/natal.jpeg" alt="Perayaan Natal" />
                    <div class="info">
                        <h3>Perayaan Natal</h3>
                        <p>Ibadah dan perayaan sukacita menyambut kelahiran Yesus Kristus.</p>
                        <button>Info Selengkapnya..</button>
                    </div>
                </div>
                <div class="card">
                    <img src="/images/Retreat.jpeg" alt="Retreat Remaja" />
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
                <img src="/images/Ina Kamis.png" alt="PHD Ina kamis">
                <p>PHD Ina kamis</p>
            </div>
            <div class="doc-item">
                <img src="/images/Kunjungan.jpeg" alt="Kunjungan Parguru Malua Resort Sauta">
                <p>Kunjungan Parguru Malua Resort Sauta</p>
            </div>
        </div>
    </section>

    <!-- Chart Section -->
    <section class="chart-container">
        <h2>Jumlah Jemaat Bulanan</h2>

        <!-- Tombol dan Pilihan -->
        <div class="form-controls">
            <button id="showFormButton">Tambah</button>

            <div class="form-item">
                <label for="tanggalHapus">Tanggal:</label>
                <select id="tanggalHapus">
                    <option value="">-- Pilih Tanggal --</option>
                    @foreach($dataJemaat->pluck('tanggal')->unique() as $tanggal)
                        <option value="{{ $tanggal }}">{{ $tanggal }}</option>
                    @endforeach
                </select>
            </div>

            <button type="button" id="hapusData">Hapus</button>
        </div>

        <!-- Form Tambah Data -->
        <form id="tambahForm" style="display: none; margin-top: 1em;">
            @csrf
            <div class="form-grid">
                <label>Tanggal: <input type="date" name="tanggal" required /></label>
                <label>Bapak: <input type="number" name="jumlah_bapak" min="0" required /></label>
                <label>Ibu: <input type="number" name="jumlah_ibu" min="0" required /></label>
                <label>Anak: <input type="number" name="jumlah_anak" min="0" required /></label>
                <label>Remaja: <input type="number" name="jumlah_remaja" min="0" required /></label>
                <label>Lansia: <input type="number" name="jumlah_lansia" min="0" required /></label>
            </div>
            <button type="submit" style="margin-top: 1em;">Simpan</button>
        </form>

        <br /><br />
        <canvas id="jemaatChart" width="400" height="200"></canvas>
    </section>

    <!-- Carousel Script -->
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

    <!-- Chart Script -->
    <script>
        let labels = {!! json_encode($labels) !!};

        let dataChart = {
            labels: labels,
            datasets: [
                { label: "Bapak", data: {!! json_encode($bapak) !!}, backgroundColor: "#ff4d6d" },
                { label: "Ibu", data: {!! json_encode($ibu) !!}, backgroundColor: "#4dabf7" },
                { label: "Anak", data: {!! json_encode($anak) !!}, backgroundColor: "#ffe066" },
                { label: "Remaja", data: {!! json_encode($remaja) !!}, backgroundColor: "#63e6be" },
                { label: "Lansia", data: {!! json_encode($lansia) !!}, backgroundColor: "#b197fc" },
            ],
        };

        const config = {
            type: "bar",
            data: dataChart,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Jemaat Per Bulan',
                        font: { size: 18 }
                    },
                    tooltip: { mode: 'index', intersect: false },
                    legend: { position: 'top' }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                },
                elements: {
                    bar: { borderRadius: 6, borderSkipped: false }
                }
            }
        };

        const jemaatChart = new Chart(document.getElementById("jemaatChart"), config);

        function updateChart(data) {
            jemaatChart.data.labels = data.labels;
            jemaatChart.data.datasets[0].data = data.bapak;
            jemaatChart.data.datasets[1].data = data.ibu;
            jemaatChart.data.datasets[2].data = data.anak;
            jemaatChart.data.datasets[3].data = data.remaja;
            jemaatChart.data.datasets[4].data = data.lansia;
            jemaatChart.update();
            populateTanggalSelect(data.labels);
        }

        function populateTanggalSelect(labels) {
            const select = $("#tanggalHapus");
            select.empty().append('<option value="">-- Pilih Tanggal --</option>');
            labels.forEach(tgl => {
                select.append(<option value="${tgl}">${tgl}</option>);
            });
        }

        $("#showFormButton").on("click", () => {
            $("#tambahForm").toggle();
        });

        $("#tambahForm").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                url: "/chart-jemaat",
                type: "POST",
                data: $(this).serialize(),
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (res) {
                    updateChart(res);
                    $("#tambahForm")[0].reset();
                    $("#tambahForm").hide();
                    alert("Data berhasil ditambahkan!");
                },
                error: function () {
                    alert("Gagal menyimpan data.");
                }
            });
        });

        $(document).ready(() => {
            populateTanggalSelect(labels);
        });

        document.getElementById('hapusData').addEventListener('click', function () {
            const tanggal = document.getElementById('tanggalHapus').value;
            if (!tanggal) {
                alert('Pilih tanggal dulu!');
                return;
            }

            if (confirm(Yakin mau hapus data tanggal ${tanggal}?)) {
                fetch('/hapus-jemaat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ tanggal: tanggal })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>
</html>
