<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Ibadah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .navbar { padding: 1rem 2rem; }
        .nav-link { font-weight: bold; color: black !important; margin: 0 1rem; }
        .nav-link.active { background-color: black; color: white !important; border-radius: 20px; padding: 0.5rem 1rem; }
        .content-section { padding: 2rem 1rem; display: flex; justify-content: center; align-items: center; flex-direction: column; }
        .image-wrapper { width: 100%; max-width: 400px; aspect-ratio: 3 / 4; overflow: hidden; border-radius: 0.75rem; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); }
        .church-image { width: 100%; height: 100%; object-fit: cover; border-radius: inherit; }
        .schedule-box { border: 1px solid #ccc; padding: 2rem; border-radius: 0.5rem; }
        .schedule-title { text-align: center; font-weight: bold; font-size: 1.5rem; margin-bottom: 1.5rem; }
        .schedule-row { margin-bottom: 1rem; }
        .language-note { font-size: 0.9rem; color: gray; padding-left: 1rem; }
        @media (max-width: 768px) { .image-wrapper { max-width: 300px; margin-bottom: 1rem; } }
    </style>
</head>
<body>

<!-- Navigasi -->
<nav class="navbar d-flex justify-content-center">
    <a class="nav-link" href="#">Beranda</a>
    <a class="nav-link" href="#">Profil</a>
    <a class="nav-link active" href="#">Jadwal</a>
    <a class="nav-link" href="#">Warta</a>
    <a class="nav-link" href="#">Reservasi</a>
</nav>

<div class="container content-section">
    <div class="row justify-content-center align-items-start g-4">

        <!-- Gambar Gereja -->
        <div class="col-md-6 d-flex justify-content-center">
            <div class="image-wrapper">
                <img src="{{ asset('images/hkbp sigumpar.jpg') }}" alt="Gereja" class="church-image">
            </div>
        </div>

        <!-- Jadwal -->
        <div class="col-md-6">
            <div class="schedule-box">
                <div class="schedule-title">JADWAL IBADAH MINGGU</div>

                @php
                    $grouped = $jadwal->keyBy('nama');
                @endphp

                @foreach (['SEKOLAH MINGGU', 'MINGGU PAGI', 'MINGGU SIANG', 'MINGGU SORE'] as $jenis)
                    @php
                        $data = $grouped[$jenis] ?? null;
                    @endphp
                    <div class="row schedule-row">
                        <div class="col-6 fw-bold">{{ $jenis }}</div>
                        <div class="col-6 text-end">
                            {{ $data ? \Carbon\Carbon::parse($data->jam_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($data->jam_selesai)->format('H:i') . ' WIB' : '-' }}
                        </div>
                        <div class="col-12 language-note">{{ $data?->bahasa ?? '-' }}</div>
                    </div>
                @endforeach

                <!-- Tombol Edit -->
                <div class="text-center mt-4">
                    <button class="btn btn-warning" onclick="toggleForm()">Edit Jadwal</button>
                </div>

                <!-- Form Edit -->
                <div class="form-container mt-4" id="editForm" style="display: none;">
                    <div class="form-title fw-bold fs-5 mb-3">Edit Jadwal Ibadah</div>

                    <form action="{{ route('jadwal.update') }}" method="POST">
                        @csrf

                        @foreach (['SEKOLAH MINGGU', 'MINGGU PAGI', 'MINGGU SIANG', 'MINGGU SORE'] as $index => $jenis)
                            @php
                                $item = $grouped[$jenis] ?? null;
                            @endphp
                            <div class="mb-4">
                                <label class="form-label fw-bold">{{ $jenis }}</label>
                                <input type="hidden" name="jadwal[{{ $index }}][id]" value="{{ $item->id ?? '' }}">
                                <input type="hidden" name="jadwal[{{ $index }}][nama]" value="{{ $jenis }}">
                                <input type="hidden" name="jadwal[{{ $index }}][tanggal]" value="{{ $item?->tanggal ?? \Carbon\Carbon::now()->toDateString() }}">


                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label>Mulai</label>
                                        <input type="time" name="jadwal[{{ $index }}][jam_mulai]" class="form-control"
                                               value="{{ $item ? \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') : '' }}"
                                               step="60" min="00:00" max="23:59" required>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>Selesai</label>
                                        <input type="time" name="jadwal[{{ $index }}][jam_selesai]" class="form-control"
                                               value="{{ $item ? \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') : '' }}"
                                               step="60" min="00:00" max="23:59" required>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>Bahasa</label>
                                        <select name="jadwal[{{ $index }}][bahasa]" class="form-select" required>
                                            <option value="">Pilih Bahasa</option>
                                            <option value="Bahasa Indonesia" {{ $item && $item->bahasa == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                            <option value="Bahasa Batak Toba" {{ $item && $item->bahasa == 'Bahasa Batak Toba' ? 'selected' : '' }}>Bahasa Batak Toba</option>
                                            <option value="-" {{ $item && $item->bahasa == '-' ? 'selected' : '' }}>-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function toggleForm() {
        const form = document.getElementById('editForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>