<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Layanan: {{ ucfirst(str_replace('_', ' ', $jenis)) }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        {{-- Judul layanan di atas form --}}
        <h3 class="text-lg font-semibold mb-4">Layanan: {{ ucfirst(str_replace('_', ' ', $jenis)) }}</h3>

        <form action="{{ route('layanangereja.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf

            <input type="hidden" name="jenis_layanan" value="{{ $jenis }}">

            <div class="mb-4">
                <label for="nama_jemaat" class="block font-medium text-gray-700">
                    Nama Jemaat <span class="text-red-600">*</span>
                </label>
                <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat') }}" class="w-full border rounded p-2" required>
                @error('nama_jemaat') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="alamat" class="block font-medium text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" class="w-full border rounded p-2">
                @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="no_telepon" class="block font-medium text-gray-700">No Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" class="w-full border rounded p-2">
                @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            {{-- Form upload & isian dinamis sesuai jenis layanan --}}
            @if(in_array($jenis, ['baptis', 'naik_sidi', 'martuppol', 'pernikahan']))
                <h3 class="font-semibold mb-2">Upload Dokumen (Format PDF/JPG/PNG max 2MB)</h3>
            @endif

            @if($jenis == 'baptis')
                <div class="mb-4">
                    <label for="surat_keterangan_warga" class="block font-medium text-gray-700">
                        Surat Keterangan Warga Jemaat <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required>
                    @error('surat_keterangan_warga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_nikah" class="block font-medium text-gray-700">Surat Nikah (jika anak pertama)</label>
                    <input type="file" name="surat_nikah" id="surat_nikah">
                    @error('surat_nikah') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @elseif($jenis == 'naik_sidi')
                <div class="mb-4">
                    <label for="surat_keterangan_warga" class="block font-medium text-gray-700">
                        Surat Keterangan Warga Jemaat <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required>
                    @error('surat_keterangan_warga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_baptis" class="block font-medium text-gray-700">
                        Surat Baptis <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_baptis" id="surat_baptis" required>
                    @error('surat_baptis') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="akta" class="block font-medium text-gray-700">
                        Akta <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="akta" id="akta" required>
                    @error('akta') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @elseif($jenis == 'martuppol')
                <div class="mb-4">
                    <label for="surat_keterangan_warga" class="block font-medium text-gray-700">
                        Surat Keterangan Warga Jemaat <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required>
                    @error('surat_keterangan_warga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_baptis" class="block font-medium text-gray-700">
                        Surat Baptis <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_baptis" id="surat_baptis" required>
                    @error('surat_baptis') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_naik_sidi" class="block font-medium text-gray-700">
                        Surat Naik Sidi <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_naik_sidi" id="surat_naik_sidi" required>
                    @error('surat_naik_sidi') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @elseif($jenis == 'pernikahan')
                <div class="mb-4">
                    <label for="surat_martuppol" class="block font-medium text-gray-700">
                        Surat Martuppol <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_martuppol" id="surat_martuppol" required>
                    @error('surat_martuppol') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_baptis" class="block font-medium text-gray-700">
                        Surat Baptis <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_baptis" id="surat_baptis" required>
                    @error('surat_baptis') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_naik_sidi" class="block font-medium text-gray-700">
                        Surat Naik Sidi <span class="text-red-600">*</span>
                    </label>
                    <input type="file" name="surat_naik_sidi" id="surat_naik_sidi" required>
                    @error('surat_naik_sidi') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- Form khusus lain sesuai layanan --}}
            @if($jenis == 'jemaat_sakit')
                <div class="mb-4">
                    <label for="wijk" class="block font-medium text-gray-700">
                        Wijk (ganti keterangan penyakit) <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="wijk" id="wijk" value="{{ old('wijk') }}" required class="w-full border rounded p-2">
                    @error('wijk') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            @if($jenis == 'jemaat_meninggal')
                <div class="mb-4">
                    <label for="lingkungan" class="block font-medium text-gray-700">Lingkungan <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan') }}" required class="w-full border rounded p-2">
                    @error('lingkungan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">
                        Tanggal Layanan <span class="text-red-600">*</span>
                    </label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" required class="w-full border rounded p-2" max  ="{{ date('Y-m-d') }}">
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            @if($jenis == 'anak_lahir')
                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">
                        Tanggal Pendataan Anak Lahir <span class="text-red-600">*</span>
                    </label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" required class="w-full border rounded p-2" max="{{ date('Y-m-d') }}">
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                {{-- Bisa tambahkan kolom lain seperti nama anak dll jika ingin --}}
            @endif

            @if(in_array($jenis, ['kunjungan_makam', 'pemesanan_gedung']))
                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">Tanggal Pemesanan <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" required class="w-full border rounded p-2" min="{{ date('Y-m-d') }}">
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="keterangan" class="block font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="w-full border rounded p-2">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            <div class="flex items-center justify-start mt-4 space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim</button>
                <a href="{{ route('layanangereja.index') }}" class="text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
