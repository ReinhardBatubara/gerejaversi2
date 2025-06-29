<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">Detail Pemberitahuan</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
            <!-- Judul dan Pesan Pemberitahuan -->
            <div class="mb-4">
                <strong class="text-xl text-blue-600">{{ $layanan->judul }}</strong>
                <p class="mt-2 text-gray-700">{{ $layanan->pesan }}</p>
                <small class="block mt-2 text-gray-500">{{ $layanan->created_at->diffForHumans() }}</small>
            </div>

            <div class="mt-6">
                <strong class="text-lg text-gray-800">Layanan:</strong>
                @if ($layanan)
                    <!-- Menampilkan data berdasarkan jenis layanan -->
                    <p class="mt-2 text-gray-600">Jenis Layanan: {{ $layanan->jenis_layanan }}</p>

                    @switch($layanan->jenis_layanan)
                        @case('martuppol')
    <div class="mt-4 space-y-2">
        <p><span class="font-semibold">Nama Jemaat Laki-laki:</span> {{ $layanan->nama_jemaat_laki }}</p>
        <p><span class="font-semibold">Nama Jemaat Perempuan:</span> {{ $layanan->nama_jemaat_perempuan }}</p>
        <p><span class="font-semibold">Alamat Laki-laki:</span> {{ $layanan->alamat_laki }}</p>
        <p><span class="font-semibold">Alamat Perempuan:</span> {{ $layanan->alamat_perempuan }}</p>
        <p><span class="font-semibold">Nomor Telepon Laki-laki:</span> {{ $layanan->no_telepon_laki }}</p>
        <p><span class="font-semibold">Nomor Telepon Perempuan:</span> {{ $layanan->no_telepon_perempuan }}</p>
        <p><span class="font-semibold">Lingkungan Laki-laki:</span> {{ $layanan->lingkungan_laki }}</p>
        <p><span class="font-semibold">Lingkungan Perempuan:</span> {{ $layanan->lingkungan_perempuan }}</p>
        <p><span class="font-semibold">Tanggal Layanan:</span> {{ $layanan->tanggal_layanan }}</p>

        {{-- Surat Keterangan Warga --}}
        @if($layanan->surat_keterangan_warga)
            <p><span class="font-semibold">Surat Keterangan Warga:</span> 
                <a href="{{ asset('storage/' . $layanan->surat_keterangan_warga) }}" class="text-blue-600" download>Unduh Surat Keterangan Warga</a>
            </p>
        @endif

        {{-- Surat Baptis Laki-laki --}}
        @if($layanan->surat_baptis_laki)
            <p><span class="font-semibold">Surat Baptis Laki-laki:</span> 
                <a href="{{ asset('storage/' . $layanan->surat_baptis_laki) }}" class="text-blue-600" download>Unduh Surat Baptis Laki-laki</a>
            </p>
        @endif

        {{-- Surat Baptis Perempuan --}}
        @if($layanan->surat_baptis_perempuan)
            <p><span class="font-semibold">Surat Baptis Perempuan:</span> 
                <a href="{{ asset('storage/' . $layanan->surat_baptis_perempuan) }}" class="text-blue-600" download>Unduh Surat Baptis Perempuan</a>
            </p>
        @endif

        {{-- Surat Naik Sidi Laki-laki --}}
        @if($layanan->surat_naik_sidi_laki)
            <p><span class="font-semibold">Surat Naik Sidi Laki-laki:</span> 
                <a href="{{ asset('storage/' . $layanan->surat_naik_sidi_laki) }}" class="text-blue-600" download>Unduh Surat Naik Sidi Laki-laki</a>
            </p>
        @endif

        {{-- Surat Naik Sidi Perempuan --}}
        @if($layanan->surat_naik_sidi_perempuan)
            <p><span class="font-semibold">Surat Naik Sidi Perempuan:</span> 
                <a href="{{ asset('storage/' . $layanan->surat_naik_sidi_perempuan) }}" class="text-blue-600" download>Unduh Surat Naik Sidi Perempuan</a>
            </p>
        @endif
    </div>
@break


                        @case('pernikahan')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Jemaat Laki-laki:</span> {{ $layanan->nama_jemaat_laki }}</p>
                                <p><span class="font-semibold">Nama Jemaat Perempuan:</span> {{ $layanan->nama_jemaat_perempuan }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Nomor Telepon Laki-laki:</span> {{ $layanan->no_telepon_laki }}</p>
                                <p><span class="font-semibold">Nomor Telepon Perempuan:</span> {{ $layanan->no_telepon_perempuan }}</p>
                                <p><span class="font-semibold">Lingkungan Laki-laki:</span> {{ $layanan->lingkungan_laki }}</p>
                                <p><span class="font-semibold">Lingkungan Perempuan:</span> {{ $layanan->lingkungan_perempuan }}</p>
                                <p><span class="font-semibold">Tanggal Layanan:</span> {{ $layanan->tanggal_layanan }}</p>
                                <p><span class="font-semibold">Dokumen Pranikah:</span> 
                                    @if ($layanan->dokumen_pranikah)
                                        <a href="{{ Storage::url($layanan->dokumen_pranikah) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                            </div>
                            @break

                        @case('jemaat_sakit')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Jemaat:</span> {{ $layanan->nama_jemaat }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Nomor Telepon:</span> {{ $layanan->no_telepon }}</p>
                                <p><span class="font-semibold">Umur:</span> {{ $layanan->umur }}</p>
                                <p><span class="font-semibold">Lingkungan:</span> {{ $layanan->lingkungan }}</p>
                                <p><span class="font-semibold">Tanggal Layanan:</span> {{ $layanan->tanggal_layanan }}</p>
                            </div>
                            @break

                        @case('jemaat_meninggal')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Jemaat:</span> {{ $layanan->nama_jemaat }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Nomor Telepon:</span> {{ $layanan->no_telepon }}</p>
                                <p><span class="font-semibold">Umur:</span> {{ $layanan->umur }}</p>
                                <p><span class="font-semibold">Lingkungan:</span> {{ $layanan->lingkungan }}</p>
                                <p><span class="font-semibold">Tanggal Layanan:</span> {{ $layanan->tanggal_layanan }}</p>
                            </div>
                            @break

                        @case('pemesanan_gedung')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Jemaat:</span> {{ $layanan->nama_jemaat }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Nomor Telepon:</span> {{ $layanan->no_telepon }}</p>
                                <p><span class="font-semibold">Tanggal Layanan:</span> {{ $layanan->tanggal_layanan }}</p>
                                <p><span class="font-semibold">Keterangan:</span> {{ $layanan->keterangan }}</p>
                                <p><span class="font-semibold">Lingkungan:</span> {{ $layanan->lingkungan }}</p>
                            </div>
                            @break

                        @case('naik_sidi')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Jemaat:</span> {{ $layanan->nama_jemaat }}</p>
                                <p><span class="font-semibold">Nama Ayah:</span> {{ $layanan->nama_ayah }}</p>
                                <p><span class="font-semibold">Nama Ibu:</span> {{ $layanan->nama_ibu }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Nomor Telepon:</span> {{ $layanan->no_telepon }}</p>
                                <p><span class="font-semibold">Kartu Keluarga:</span> 
                                    @if ($layanan->kartu_keluarga)
                                        <a href="{{ Storage::url($layanan->kartu_keluarga) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                                <p><span class="font-semibold">Surat Baptis:</span> 
                                    @if ($layanan->surat_baptis)
                                        <a href="{{ Storage::url($layanan->surat_baptis) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                                <p><span class="font-semibold">Akta Lahir:</span> 
                                    @if ($layanan->akta_lahir)
                                        <a href="{{ Storage::url($layanan->akta_lahir) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                                <p><span class="font-semibold">Surat Keterangan Warga:</span> 
                                    @if ($layanan->surat_keterangan_warga)
                                        <a href="{{ Storage::url($layanan->surat_keterangan_warga) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                            </div>
                            @break

                        @case('baptis')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Jemaat:</span> {{ $layanan->nama_jemaat }}</p>
                                <p><span class="font-semibold">Nama Ayah:</span> {{ $layanan->nama_ayah }}</p>
                                <p><span class="font-semibold">Nama Ibu:</span> {{ $layanan->nama_ibu }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Nomor Telepon:</span> {{ $layanan->no_telepon }}</p>
                                <p><span class="font-semibold">Kartu Keluarga:</span> 
                                    @if ($layanan->kartu_keluarga)
                                        <a href="{{ Storage::url($layanan->kartu_keluarga) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                                <p><span class="font-semibold">Surat Keterangan Warga:</span> 
                                    @if ($layanan->surat_keterangan_warga)
                                        <a href="{{ Storage::url($layanan->surat_keterangan_warga) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                                <p><span class="font-semibold">Surat Nikah (jika anak pertama):</span> 
                                    @if ($layanan->surat_nikah)
                                        <a href="{{ Storage::url($layanan->surat_nikah) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                                <p><span class="font-semibold">Lingkungan:</span> {{ $layanan->lingkungan }}</p>
                            </div>
                            @break

                        @case('anak_lahir')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Anak:</span> {{ $layanan->nama_anak }}</p>
                                <p><span class="font-semibold">Nama Ayah:</span> {{ $layanan->nama_ayah }}</p>
                                <p><span class="font-semibold">Nama Ibu:</span> {{ $layanan->nama_ibu }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Nomor Telepon:</span> {{ $layanan->no_telepon }}</p>
                                <p><span class="font-semibold">Tanggal Lahir:</span> {{ $layanan->tanggal_lahir }}</p>
                                <p><span class="font-semibold">Lingkungan:</span> {{ $layanan->lingkungan }}</p>
                            </div>
                            @break

                        @case('kunjungan_makam')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Jemaat:</span> {{ $layanan->nama_jemaat }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Nomor Telepon:</span> {{ $layanan->no_telepon }}</p>
                                <p><span class="font-semibold">Tanggal Layanan:</span> {{ $layanan->tanggal_layanan }}</p>
                                <p><span class="font-semibold">Keterangan:</span> {{ $layanan->keterangan }}</p>
                                <p><span class="font-semibold">Lingkungan:</span> {{ $layanan->lingkungan }}</p>
                            </div>
                            @break

                        @case('kegiatan_mendatang')
                            <div class="mt-4 space-y-2">
                                <p><span class="font-semibold">Nama Kegiatan:</span> {{ $layanan->nama_kegiatan }}</p>
                                <p><span class="font-semibold">Detail Kegiatan:</span> {{ $layanan->detail_acara }}</p>
                                <p><span class="font-semibold">Tanggal Kegiatan:</span> {{ $layanan->tanggal_layanan }}</p>
                                <p><span class="font-semibold">Alamat:</span> {{ $layanan->alamat }}</p>
                                <p><span class="font-semibold">Dokumen Terkait:</span> 
                                    @if ($layanan->surat_keterangan_warga)
                                        <a href="{{ Storage::url($layanan->surat_keterangan_warga) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-600">Tidak ada dokumen</span>
                                    @endif
                                </p>
                                <p><span class="font-semibold">Nama Penanggung Jawab:</span> {{ $layanan->nama_jemaat }}</p>
                                <p><span class="font-semibold">No Telepon:</span> {{ $layanan->no_telepon }}</p>
                            </div>
                            @break

                    @endswitch
                @else
                    <span class="text-gray-600">Layanan tidak ditemukan.</span>
                @endif
            </div>

            <!-- Tampilkan file jika ada -->
            @if ($layanan->files)
                @php
                    $files = json_decode($layanan->files, true);
                @endphp
                @foreach ($files as $key => $file)
                    @if ($file)
                        <div class="mt-2">
                            <a href="{{ Storage::url($file) }}" target="_blank" class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                                Download {{ ucfirst(str_replace('_', ' ', $key)) }}
                            </a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        {{-- Tombol kembali ke daftar pemberitahuan --}}
        <a href="{{ route('pemberitahuan') }}" class="inline-block mt-4 text-sm text-blue-600 hover:underline">Kembali ke Pemberitahuan</a>
    </div>
</x-app-layout>
