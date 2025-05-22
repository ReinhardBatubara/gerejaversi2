<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Jenis Layanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f9ff;
        }
        .reservasi-card {
            max-width: 600px;
            margin: 60px auto;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .reservasi-card h2 {
            margin-bottom: 30px;
        }
        .btn-reservasi {
            margin-bottom: 12px;
            font-size: 1.05rem;
            padding: 12px;
        }
        .logo-hkbp {
            display: block;
            margin: 0 auto 20px auto;
            width: 120px;      /* Ubah ukuran sesuai kebutuhan */
            height: auto;      /* Biarkan auto agar proporsional */
        }
    </style>
</head>

<body>
@include('navbaradmin')

<div class="container">
    <div class="card reservasi-card p-4">
    <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo-hkbp">
        <h2 class="text-center text-primary">Pilih Jenis Layanan</h2>
        <div class="d-grid gap-2">
            <a href="/reservasi/jemaatbaru" class="btn btn-outline-primary btn-reservasi">
                <i class="bi bi-person-plus-fill"></i> Pendaftaran Jemaat Baru
            </a>
            <a href="/reservasi/anaklahir" class="btn btn-outline-info btn-reservasi">
                <i class="bi bi-baby"></i> Pemberitahuan Anak Lahir
            </a>
            <a href="/reservasi/baptisan" class="btn btn-outline-success btn-reservasi">
                <i class="bi bi-droplet-half"></i> Permohonan Baptisan
            </a>
            <a href="/reservasi/sidi" class="btn btn-outline-secondary btn-reservasi">
                <i class="bi bi-book-half"></i> Pendaftaran Sidi/Katekisasi
            </a>
            <a href="/reservasi/pranikah" class="btn btn-outline-warning btn-reservasi">
                <i class="bi bi-chat-left-heart"></i> Pendaftaran Pra-Nikah (Konseling/Martumpol)
            </a>
            <a href="/reservasi/pernikahan" class="btn btn-outline-danger btn-reservasi">
                <i class="bi bi-heart-fill"></i> Pendaftaran Pernikahan
            </a>
            <a href="/reservasi/jemaatsakit" class="btn btn-outline-dark btn-reservasi">
                <i class="bi bi-hospital"></i> Pemberitahuan Jemaat Sakit
            </a>
            <a href="/reservasi/pindahjemaat" class="btn btn-outline-primary btn-reservasi">
                <i class="bi bi-arrow-left-right"></i> Permohonan Pindah Jemaat/Wijk
            </a>
            <a href="/reservasi/meninggal" class="btn btn-outline-secondary btn-reservasi">
                <i class="bi bi-person-x-fill"></i> Pemberitahuan Jemaat Meninggal Dunia
            </a>
            <a href="/reservasi/kunjunganmakam" class="btn btn-outline-dark btn-reservasi">
                <i class="bi bi-person-x-fill"></i> kunjungan Makam
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
