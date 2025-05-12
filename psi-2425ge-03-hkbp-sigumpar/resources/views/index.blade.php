<x-app-layout>
    <link rel="stylesheet" href="/css/beranda.css">

    {{-- Hero and Events Sections (unchanged) --}}
    <section class="hero">
        <div class="hero-content">
            <img src="/images/LOGO HKBP.png" alt="Logo HKBP" class="logo">
            <p>HKBP DR I.L.Nommensen Sigumpar</p>
            <p class="ayat">Lalu Ia berkata kepada mereka "Pergilah ke seluruh dunia, beritakanlah Injil kepada
                segala makhluk".<br>Markus 16:15</p>
            <h3>Jadilah bagian jemaat dalam gereja kami</h3>
        </div>
        <div class="hero-image">
            <img src="/images/yesus_chiby.jpeg" alt="Jesus Character">
        </div>
    </section>

    {{-- New Section: Congregation Data --}}
    <section class="upcoming-event">
        <h2>Data Jemaat</h2>

        <div class="data-jemaat-wrapper">
            <a href="{{ route('congregations.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">Tambah
                Data</a>

            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; background-color: white;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jumlah</th>
                        <th>Gender</th>
                        <th>Kategori Usia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($congregations as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->age_categories }}</td>
                            <td>
                                <a href="{{ route('congregations.edit', $item->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('congregations.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                        class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- Existing Documentation Section --}}
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
</x-app-layout>
