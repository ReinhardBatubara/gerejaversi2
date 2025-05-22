<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Reservasi {{ ucfirst(str_replace('-', ' ', $jenis)) }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CDN -->
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
            padding: 30px;
            background-color: white;
        }
        .reservasi-card h2 {
            margin-bottom: 30px;
        }
        .logo-hkbp {
            display: block;
            margin: 0 auto 20px auto;
            width: 120px;
            height: auto;
        }
    </style>
</head>
<body>
@include('navbar')

<div class="container">
    <div class="card reservasi-card">
        <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo-hkbp">
        <h2 class="text-center text-primary">Form Reservasi {{ ucfirst(str_replace('-', ' ', $jenis)) }}</h2>

        <div id="alertSuccess" class="alert alert-success d-none" role="alert">
            Pesan berhasil dibuka di WhatsApp!
        </div>

        <form id="formReservasi">
            @csrf

            @if ($jenis === 'jemaatbaru')
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" name="telepon" class="form-control" required>
                </div>

            @elseif ($jenis === 'anaklahir')
                <div class="mb-3">
                    <label class="form-label">Nama Anak</label>
                    <input type="text" name="nama_anak" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Orang Tua</label>
                    <input type="text" name="nama_ortu" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir Anak</label>
                    <input type="date" name="tanggal_lahir_anak" class="form-control" required>
                </div>

            @elseif ($jenis === 'baptisan')
                <div class="mb-3">
                    <label class="form-label">Nama Anak</label>
                    <input type="text" name="nama_anak" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Orang Tua</label>
                    <input type="text" name="nama_ortu" class="form-control" required>
                </div>

            @elseif ($jenis === 'sidi')
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Orang Tua</label>
                    <input type="text" name="nama_ortu" class="form-control" required>
                </div>

            @elseif ($jenis === 'pranikah')
                <div class="mb-3">
                    <label class="form-label">Nama Calon Pengantin Pria</label>
                    <input type="text" name="calon_suami" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Calon Pengantin Wanita</label>
                    <input type="text" name="calon_istri" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Pra-Nikah</label>
                    <input type="date" name="tanggal_pra_nikah" class="form-control" required>
                </div>

            @elseif ($jenis === 'pernikahan')
                <div class="mb-3">
                    <label class="form-label">Nama Pengantin Pria</label>
                    <input type="text" name="calon_suami" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pengantin Wanita</label>
                    <input type="text" name="calon_istri" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Pernikahan</label>
                    <input type="date" name="tanggal_pernikahan" class="form-control" required>
                </div>

            @elseif ($jenis === 'jemaatsakit')
                <div class="mb-3">
                    <label class="form-label">Nama Jemaat</label>
                    <input type="text" name="nama_jemaat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan Penyakit</label>
                    <textarea name="penyakit" rows="3" class="form-control"></textarea>
                </div>

            @elseif ($jenis === 'pindahjemaat')
                <div class="mb-3">
                    <label class="form-label">Nama Jemaat</label>
                    <input type="text" name="nama_jemaat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jemaat Asal</label>
                    <input type="text" name="jemaat_asal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jemaat Tujuan</label>
                    <input type="text" name="jemaat_tujuan" class="form-control" required>
                </div>

            @elseif ($jenis === 'meninggal')
                <div class="mb-3">
                    <label class="form-label">Nama Jemaat</label>
                    <input type="text" name="nama_jemaat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Meninggal</label>
                    <input type="date" name="tanggal_meninggal" class="form-control" required>
                </div>
            
                @elseif ($jenis === 'kunjunganmakam')
                <div class="mb-3">
                    <label class="form-label">Nama Penanggung Jawab</label>
                    <input type="text" name="penanggung_jawab" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Peserta</label>
                    <input type="number" name="jumlah_peserta" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal_kunjungan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keperluan Kunjungan</label>
                    <textarea name="keperluan" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tujuan</label>
                    <input type="text" class="form-control" value="Makam Nomensen" disabled>
                    <input type="hidden" name="tujuan" value="Makam Nomensen">
                </div>


            @else
                <p>Jenis Layanan tidak dikenali.</p>
            @endif

            <div class="d-grid mt-4">
                <button type="button" class="btn btn-success" onclick="kirimWhatsApp()">
                    <i class="bi bi-whatsapp"></i> Kirim via WhatsApp
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function kirimWhatsApp() {
        const form = document.forms['formReservasi'];
        const formData = new FormData(form);
        let isEmpty = false;

        for (const [key, value] of formData.entries()) {
            if (!value.trim()) {
                isEmpty = true;
                break;
            }
        }

        if (isEmpty) {
            alert("Harap lengkapi semua data terlebih dahulu.");
            return;
        }

        let pesan = "Shalom,\nSaya ingin melakukan reservasi untuk: {{ ucfirst(str_replace('-', ' ', $jenis)) }}\n\n";

        for (const [key, value] of formData.entries()) {
            const label = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            pesan += `${label}: ${value || '-'}\n`;
        }

        pesan += `\nTerima kasih atas perhatiannya. Tuhan memberkati`;

        const nomor = "6281377971480";
        const link = `https://wa.me/${nomor}?text=${encodeURIComponent(pesan)}`;

        window.open(link, "_blank");
        document.getElementById("alertSuccess").classList.remove("d-none");
    }
</script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
