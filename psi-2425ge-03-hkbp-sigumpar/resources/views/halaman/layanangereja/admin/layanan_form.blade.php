<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Layanan: {{ ucfirst(str_replace('_', ' ', $jenis)) }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('layanangereja.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            <input type="hidden" name="jenis_layanan" value="{{ $jenis }}">

            {{-- MARTUPPOL --}}
            @if($jenis == 'martuppol')
                <p class="mb-4 text-gray-700 font-semibold">
                    Isi data lengkap pasangan martuppol berikut dengan dokumen yang diperlukan.
                </p>
                <div class="mb-4">
                    <label for="nama_jemaat_laki" class="block font-medium text-gray-700">Nama Jemaat Laki-laki <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat_laki" id="nama_jemaat_laki" value="{{ old('nama_jemaat_laki',auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->full_name : auth()->user()-> husband_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi." />
                    @error('nama_jemaat_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_jemaat_perempuan" class="block font-medium text-gray-700">Nama Jemaat Perempuan <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat_perempuan" id="nama_jemaat_perempuan" value="{{ old('nama_jemaat_perempuan'  ,auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->full_name : auth()->user()-> wife_name) }}" required class="w-full border rounded p-2"pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi." />
                    @error('nama_jemaat_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat_laki" class="block font-medium text-gray-700">Alamat Laki-laki <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat_laki" id="alamat_laki" value="{{ old('alamat_laki',  auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->address : auth()->user()-> husband_address) }}" required class="w-full border rounded p-2" />
                    @error('alamat_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat_perempuan" class="block font-medium text-gray-700">Alamat Perempuan <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat_perempuan" id="alamat_perempuan" value="{{ old('alamat_perempuan',auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->address : auth()->user()-> wife_address) }}" required class="w-full border rounded p-2" />
                    @error('alamat_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon_laki" class="block font-medium text-gray-700">Nomor WA Laki-laki <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon_laki" id="no_telepon_laki" value="{{ old('no_telepon_laki', auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->wa_number : auth()->user()-> husband_wa) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal." />
                    @error('no_telepon_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon_perempuan" class="block font-medium text-gray-700">Nomor WA Perempuan <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon_perempuan" id="no_telepon_perempuan" value="{{ old('no_telepon_perempuan', auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->wa_number : auth()->user()-> wife_wa)}}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal." />
                    @error('no_telepon_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_keterangan_warga" class="block font-medium text-gray-700">Surat Keterangan Warga Jemaat <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required />
                    @error('surat_keterangan_warga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_baptis_laki" class="block font-medium text-gray-700">Surat Baptis Laki-laki <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_baptis_laki" id="surat_baptis_laki" required />
                    @error('surat_baptis_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_baptis_perempuan" class="block font-medium text-gray-700">Surat Baptis Perempuan <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_baptis_perempuan" id="surat_baptis_perempuan" required />
                    @error('surat_baptis_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_naik_sidi_laki" class="block font-medium text-gray-700">Surat Naik Sidi Laki-laki <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_naik_sidi_laki" id="surat_naik_sidi_laki" required />
                    @error('surat_naik_sidi_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_naik_sidi_perempuan" class="block font-medium text-gray-700">Surat Naik Sidi Perempuan <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_naik_sidi_perempuan" id="surat_naik_sidi_perempuan" required />
                    @error('surat_naik_sidi_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan_laki" class="block font-medium text-gray-700">Lingkungan Laki-laki <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan_laki" id="lingkungan_laki" value="{{ old('lingkungan_laki',auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->location : auth()->user()-> husband_location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan_perempuan" class="block font-medium text-gray-700">Lingkungan Perempuan <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan_perempuan" id="lingkungan_perempuan" value="{{ old('lingkungan_perempuan',auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->location : auth()->user()-> wife_location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">Tanggal Martuppol <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full border rounded p-2" />
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- PERNIKAHAN --}}
            @if($jenis == 'pernikahan')
                <p class="mb-4 text-gray-700 font-semibold">
                    Form pendaftaran pernikahan. Mohon lengkapi data jemaat pria dan wanita beserta dokumen terkait.
                </p>
                <div class="mb-4">
                    <label for="nama_jemaat_laki" class="block font-medium text-gray-700">Nama Jemaat Laki-laki <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat_laki" id="nama_jemaat_laki" value="{{ old('nama_jemaat_laki',auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->full_name : auth()->user()-> husband_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi." />
                    @error('nama_jemaat_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_jemaat_perempuan" class="block font-medium text-gray-700">Nama Jemaat Perempuan <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat_perempuan" id="nama_jemaat_perempuan" value="{{ old('nama_jemaat_perempuan',auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->full_name : auth()->user()-> wife_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi." />
                    @error('nama_jemaat_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Lokasi Pernikahan<span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon_laki" class="block font-medium text-gray-700">Nomor Telepon Laki-laki <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon_laki" id="no_telepon_laki" value="{{ old('no_telepon_laki',auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->wa_number : auth()->user()-> husband_wa) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon_perempuan" class="block font-medium text-gray-700">Nomor Telepon Perempuan <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon_perempuan" id="no_telepon_perempuan" value="{{ old('no_telepon_perempuan',auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->wa_number : auth()->user()-> wife_wa) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="surat_martuppol" class="block font-medium text-gray-700">Surat Martuppol <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_martuppol" id="surat_martuppol" required />
                    @error('surat_martuppol') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="surat_baptis_laki" class="block font-medium text-gray-700">Surat Baptis Laki-laki <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_baptis_laki" id="surat_baptis_laki" required />
                    @error('surat_baptis_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="surat_baptis_perempuan" class="block font-medium text-gray-700">Surat Baptis Perempuan <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_baptis_perempuan" id="surat_baptis_perempuan" required />
                    @error('surat_baptis_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="surat_naik_sidi_laki" class="block font-medium text-gray-700">Surat Naik Sidi Laki-laki <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_naik_sidi_laki" id="surat_naik_sidi_laki" required />
                    @error('surat_naik_sidi_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="surat_naik_sidi_perempuan" class="block font-medium text-gray-700">Surat Naik Sidi Perempuan <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_naik_sidi_perempuan" id="surat_naik_sidi_perempuan" required />
                    @error('surat_naik_sidi_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="lingkungan_laki" class="block font-medium text-gray-700">Lingkungan Laki-laki <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan_laki" id="lingkungan_laki" value="{{ old('lingkungan_laki',auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->location : auth()->user()-> husband_location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan_laki') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="lingkungan_perempuan" class="block font-medium text-gray-700">Lingkungan Perempuan <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan_perempuan" id="lingkungan_perempuan" value="{{ old('lingkungan_perempuan',auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->location : auth()->user()-> wife_location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan_perempuan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">Tanggal Pernikahan <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full border rounded p-2" />
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="dokumen_pranikah" class="block font-medium text-gray-700">Konseling Pranikah (Upload Dokumen jika ada)</label>
                    <input type="file" name="dokumen_pranikah" id="dokumen_pranikah" />
                    @error('dokumen_pranikah') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- JEMAAT SAKIT --}}
            @if($jenis == 'jemaat_sakit')
                <p class="mb-4 text-gray-700 font-semibold">
                    Isi data jemaat sakit beserta informasi lingkungan dan tanggal sakit.
                </p>
                <div class="mb-4">
                    <label for="nama_jemaat" class="block font-medium text-gray-700">Nama Jemaat Yang Sakit <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat',auth()->user()->full_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_jemaat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Alamat <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat',auth()->user()->address) }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon" class="block font-medium text-gray-700">Nomor Telepon <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', auth()->user()->wa_number) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="umur" class="block font-medium text-gray-700">Umur <span class="text-red-600">*</span></label>
                    <input type="number" name="umur" id="umur" value="{{ old('umur', auth()->user()->age) }}" required class="w-full border rounded p-2" />
                    @error('umur') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan" class="block font-medium text-gray-700">Lingkungan <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan',auth()->user()->location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">Tanggal Sakit <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" max="{{ date('Y-m-d') }}" required class="w-full border rounded p-2" />
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- JEMAAT MENINGGAL --}}
            @if($jenis == 'jemaat_meninggal')
                <p class="mb-4 text-gray-700 font-semibold">
                    Form pemberitahuan jemaat meninggal.
                </p>
                <div class="mb-4">
                    <label for="nama_jemaat" class="block font-medium text-gray-700">Nama Jemaat Yang Meninggal<span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat') }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi." />
                    @error('nama_jemaat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Alamat <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon" class="block font-medium text-gray-700">Nomor Telepon yang Bisa Dihubungi <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon',auth()->user()->wa_number) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="umur" class="block font-medium text-gray-700">Umur <span class="text-red-600">*</span></label>
                    <input type="number" name="umur" id="umur" value="{{ old('umur', auth()->user()->age) }}" required class="w-full border rounded p-2" />
                    @error('umur') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan" class="block font-medium text-gray-700">Lingkungan <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan',auth()->user()->location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">Tanggal Meninggal <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" max="{{ date('Y-m-d') }}" required class="w-full border rounded p-2" />
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- PEMESANAN GEDUNG --}}
            @if($jenis == 'pemesanan_gedung')
                <p class="mb-4 text-gray-700 font-semibold">
                    Form pemesanan gedung gereja. Mohon lengkapi data pemesan dan keterangan tambahan jika ada.
                </p>
                <div class="mb-4">
                    <label for="nama_jemaat" class="block font-medium text-gray-700">Nama Jemaat Pemesan <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat',auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->full_name : '') }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_jemaat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Alamat Pemesan <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat',auth()->user()->address) }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon" class="block font-medium text-gray-700">Nomor Telepon Pemesan <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon',auth()->user()->wa_number) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">Tanggal Pemesanan <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full border rounded p-2" />
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="keterangan" class="block font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="w-full border rounded p-2">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan" class="block font-medium text-gray-700">Lingkungan</label>
                    <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan',auth()->user()->location) }}" class="w-full border rounded p-2" />
                    @error('lingkungan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- NAIK SIDI --}}
            @if($jenis == 'naik_sidi')
                <p class="mb-4 text-gray-700 font-semibold">
                    Isi data lengkap jemaat naik sidi termasuk data orang tua dan dokumen pendukung.
                </p>
                <div class="mb-4">
                    <label for="nama_jemaat" class="block font-medium text-gray-700">Nama Jemaat Yang Akan Naik Sidi <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat',auth()->user()->full_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_jemaat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_ayah" class="block font-medium text-gray-700">Nama Ayah Jemaat <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah',auth()->user()->father_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_ayah') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_ibu" class="block font-medium text-gray-700">Nama Ibu Jemaat <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu',auth()->user()->mother_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_ibu') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Alamat Jemaat <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat',auth()->user()->address) }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon" class="block font-medium text-gray-700">Nomor Telepon Jemaat <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon',auth()->user()->wa_number) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="kartu_keluarga" class="block font-medium text-gray-700">Kartu Keluarga Jemaat <span class="text-red-600">*</span></label>
                    <input type="file" name="kartu_keluarga" id="kartu_keluarga" required />
                    @error('kartu_keluarga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_baptis" class="block font-medium text-gray-700">Surat Baptis <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_baptis" id="surat_baptis" required />
                    @error('surat_baptis') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="akta_lahir" class="block font-medium text-gray-700">Akta Lahir <span class="text-red-600">*</span></label>
                    <input type="file" name="akta_lahir" id="akta_lahir" required />
                    @error('akta_lahir') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_keterangan_warga" class="block font-medium text-gray-700">Surat Keterangan Warga Jemaat <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required />
                    @error('surat_keterangan_warga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan" class="block font-medium text-gray-700">Lingkungan <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan',auth()->user()->location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- PENDAFTARAN BAPTIS --}}
            @if($jenis == 'baptis')
                <p class="mb-4 text-gray-700 font-semibold">
                    Form pendaftaran baptis anak. Lengkapi data anak dan orang tua beserta dokumen terkait.
                </p>
                <div class="mb-4">
                    <label for="nama_jemaat" class="block font-medium text-gray-700">Nama Jemaat Yang Akan Di Baptis <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat') }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_jemaat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_ayah" class="block font-medium text-gray-700">Nama Ayah Jemaat<span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah',auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->full_name : auth()->user()-> husband_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_ayah') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_ibu" class="block font-medium text-gray-700">Nama Ibu Jemaat<span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu',auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->full_name : auth()->user()-> wife_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_ibu') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Alamat <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat', auth()-> user()->address) }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon" class="block font-medium text-gray-700">Nomor Telepon Ayah/Ibu<span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', auth()->user()->wa_number) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="kartu_keluarga" class="block font-medium text-gray-700">Kartu Keluarga <span class="text-red-600">*</span></label>
                    <input type="file" name="kartu_keluarga" id="kartu_keluarga" required />
                    @error('kartu_keluarga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_keterangan_warga" class="block font-medium text-gray-700">Surat Keterangan Warga Jemaat <span class="text-red-600">*</span></label>
                    <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required />
                    @error('surat_keterangan_warga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_nikah" class="block font-medium text-gray-700">Surat Nikah (jika anak pertama)</label>
                    <input type="file" name="surat_nikah" id="surat_nikah" />
                    @error('surat_nikah') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan" class="block font-medium text-gray-700">Lingkungan <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan',auth()->user()->location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- ANAK LAHIR --}}
            @if($jenis == 'anak_lahir')
                <p class="mb-4 text-gray-700 font-semibold">
                    Form pemberitahuan anak lahir. Mohon isi data anak dan orang tua secara lengkap.
                </p>
                <div class="mb-4">
                    <label for="nama_anak" class="block font-medium text-gray-700">Nama Anak yang Baru Lahir <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_anak" id="nama_anak" value="{{ old('nama_anak') }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_anak') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_ayah" class="block font-medium text-gray-700">Nama Ayah Bayi<span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah',auth()->user()->jenis_kelamin === 'laki-laki' ? auth()->user()->full_name : auth()->user()-> husband_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_ayah') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_ibu" class="block font-medium text-gray-700">Nama Ibu Bayi<span class="text-red-600">*</span></label>
                    <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu',auth()->user()->jenis_kelamin === 'perempuan' ? auth()->user()->full_name : auth()->user()-> wife_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_ibu') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Alamat <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat', auth()->user()->address) }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon" class="block font-medium text-gray-700">Nomor Telepon Ayah/Ibu <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon',auth()->user()->wa_number) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="tanggal_lahir" class="block font-medium text-gray-700">Tanggal Lahir <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}" required class="w-full border rounded p-2" />
                    @error('tanggal_lahir') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan" class="block font-medium text-gray-700">Lingkungan <span class="text-red-600">*</span></label>
                    <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan',auth()->user()->location) }}" required class="w-full border rounded p-2" />
                    @error('lingkungan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- KUNJUNGAN MAKAM --}}
            @if($jenis == 'kunjungan_makam')
                <p class="mb-4 text-gray-700 font-semibold">
                    Form pemesanan kunjungan makam. Mohon lengkapi data jemaat dan keterangan pemesanan.
                </p>
                <div class="mb-4">
                    <label for="nama_jemaat" class="block font-medium text-gray-700">Nama Jemaat Pemesan <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat',auth()->user()->full_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_jemaat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Alamat <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat',auth()->user()->address) }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon" class="block font-medium text-gray-700">Nomor Telepon <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon',auth()->user()->wa_number) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">Tanggal Pemesanan <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full border rounded p-2" />
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="keterangan" class="block font-medium text-gray-700">Keterangan Pemesanan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="w-full border rounded p-2">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="lingkungan" class="block font-medium text-gray-700">Lingkungan</label>
                    <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan',auth()->user()->    location) }}" class="w-full border rounded p-2" />
                    @error('lingkungan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            {{-- KEGIATAN MENDATANG --}}
            @if($jenis == 'kegiatan_mendatang')
                <p class="mb-4 text-gray-700 font-semibold">
                    Form kegiatan mendatang. Mohon lengkapi data kegiatan dan informasi Penanggung Jawab.
                </p>
                <div class="mb-4">
                    <label for="nama_kegiatan" class="block font-medium text-gray-700">Nama Kegiatan <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required class="w-full border rounded p-2" />
                    @error('nama_kegiatan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="detail_acara" class="block font-medium text-gray-700">Detail Kegiatan <span class="text-red-600">*</span></label>
                    <input type="text" name="detail_acara" id="detail_acara" value="{{ old('detail_acara') }}" required class="w-full border rounded p-2" />
                    @error('detail_acara') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="surat_keterangan_warga" class="block font-medium text-gray-700">Dokumen Terkait </span></label>
                    <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga"/>
                    @error('surat_keterangan_warga') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="tanggal_layanan" class="block font-medium text-gray-700">Tanggal Kegiatan <span class="text-red-600">*</span></label>
                    <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full border rounded p-2" />
                    @error('tanggal_layanan') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block font-medium text-gray-700">Alamat <span class="text-red-600">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat',auth()->user()->address) }}" required class="w-full border rounded p-2" />
                    @error('alamat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nama_jemaat" class="block font-medium text-gray-700">Nama Penanggung Jawab <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat',auth()->user()->full_name) }}" required class="w-full border rounded p-2" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi."/>
                    @error('nama_jemaat') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="no_telepon" class="block font-medium text-gray-700">Nomor Telepon <span class="text-red-600">*</span></label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon',auth()->user()->wa_number) }}" required class="w-full border rounded p-2" pattern="^\+?[0-9]*$" title="Nomor telepon hanya boleh mengandung angka dan tanda '+' di awal."/>
                    @error('no_telepon') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                @endif

            <div class="flex items-center justify-start mt-6 space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Kirim</button>
                <a href="{{ route('layanangereja.index') }}" class="text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
