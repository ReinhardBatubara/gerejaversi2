<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            Form Layanan: {{ ucfirst(str_replace('_', ' ', $jenis)) }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-8 lg:px-12">
        <form action="{{ route('layanangereja.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg p-8 space-y-10">
            @csrf
            <input type="hidden" name="jenis_layanan" value="{{ $jenis }}">

            {{-- MARTUPPOL --}}
            @if($jenis == 'martuppol')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-blue-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-blue-800 border-b border-blue-300 pb-2">Data Pasangan Martuppol</h3>
                    <p class="mb-6 text-blue-700 font-medium italic">Isi data lengkap pasangan martuppol berikut dengan dokumen yang diperlukan.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Jemaat Laki --}}
                        <div>
                            <label for="nama_jemaat_laki" class="block mb-2 font-semibold text-gray-800">Nama Jemaat Laki-laki <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat_laki" id="nama_jemaat_laki" value="{{ old('nama_jemaat_laki') }}" required
                                placeholder="Masukkan nama jemaat laki-laki" 
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('nama_jemaat_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nama Jemaat Perempuan --}}
                        <div>
                            <label for="nama_jemaat_perempuan" class="block mb-2 font-semibold text-gray-800">Nama Jemaat Perempuan <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat_perempuan" id="nama_jemaat_perempuan" value="{{ old('nama_jemaat_perempuan') }}" required
                                placeholder="Masukkan nama jemaat perempuan"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('nama_jemaat_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Alamat Laki --}}
                        <div>
                            <label for="alamat_laki" class="block mb-2 font-semibold text-gray-800">Alamat Laki-laki <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat_laki" id="alamat_laki" value="{{ old('alamat_laki') }}" required
                                placeholder="Masukkan alamat laki-laki"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('alamat_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Alamat Perempuan --}}
                        <div>
                            <label for="alamat_perempuan" class="block mb-2 font-semibold text-gray-800">Alamat Perempuan <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat_perempuan" id="alamat_perempuan" value="{{ old('alamat_perempuan') }}" required
                                placeholder="Masukkan alamat perempuan"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('alamat_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nomor WA Laki-laki --}}
                        <div>
                            <label for="no_telepon_laki" class="block mb-2 font-semibold text-gray-800">Nomor WA Laki-laki <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon_laki" id="no_telepon_laki" value="{{ old('no_telepon_laki') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('no_telepon_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nomor WA Perempuan --}}
                        <div>
                            <label for="no_telepon_perempuan" class="block mb-2 font-semibold text-gray-800">Nomor WA Perempuan <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon_perempuan" id="no_telepon_perempuan" value="{{ old('no_telepon_perempuan') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('no_telepon_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Keterangan Warga Jemaat --}}
                        <div>
                            <label for="surat_keterangan_warga" class="block mb-2 font-semibold text-gray-800">Surat Keterangan Warga Jemaat <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-blue-50 file:text-blue-700 cursor-pointer hover:file:bg-blue-100" />
                            @error('surat_keterangan_warga') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Baptis Laki-laki --}}
                        <div>
                            <label for="surat_baptis_laki" class="block mb-2 font-semibold text-gray-800">Surat Baptis Laki-laki <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_baptis_laki" id="surat_baptis_laki" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-blue-50 file:text-blue-700 cursor-pointer hover:file:bg-blue-100" />
                            @error('surat_baptis_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Baptis Perempuan --}}
                        <div>
                            <label for="surat_baptis_perempuan" class="block mb-2 font-semibold text-gray-800">Surat Baptis Perempuan <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_baptis_perempuan" id="surat_baptis_perempuan" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-blue-50 file:text-blue-700 cursor-pointer hover:file:bg-blue-100" />
                            @error('surat_baptis_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Naik Sidi Laki-laki --}}
                        <div>
                            <label for="surat_naik_sidi_laki" class="block mb-2 font-semibold text-gray-800">Surat Naik Sidi Laki-laki <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_naik_sidi_laki" id="surat_naik_sidi_laki" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-blue-50 file:text-blue-700 cursor-pointer hover:file:bg-blue-100" />
                            @error('surat_naik_sidi_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Naik Sidi Perempuan --}}
                        <div>
                            <label for="surat_naik_sidi_perempuan" class="block mb-2 font-semibold text-gray-800">Surat Naik Sidi Perempuan <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_naik_sidi_perempuan" id="surat_naik_sidi_perempuan" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-blue-50 file:text-blue-700 cursor-pointer hover:file:bg-blue-100" />
                            @error('surat_naik_sidi_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Lingkungan Laki --}}
                        <div>
                            <label for="lingkungan_laki" class="block mb-2 font-semibold text-gray-800">Lingkungan Laki-laki <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan_laki" id="lingkungan_laki" value="{{ old('lingkungan_laki') }}" required
                                placeholder="Masukkan lingkungan laki-laki"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('lingkungan_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Lingkungan Perempuan --}}
                        <div>
                            <label for="lingkungan_perempuan" class="block mb-2 font-semibold text-gray-800">Lingkungan Perempuan <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan_perempuan" id="lingkungan_perempuan" value="{{ old('lingkungan_perempuan') }}" required
                                placeholder="Masukkan lingkungan perempuan"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('lingkungan_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tanggal Martuppol --}}
                        <div class="md:col-span-2">
                            <label for="tanggal_layanan" class="block mb-2 font-semibold text-gray-800">Tanggal Martuppol <span class="text-red-600">*</span></label>
                            <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                            @error('tanggal_layanan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- PERNIKAHAN --}}
            @if($jenis == 'pernikahan')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-pink-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-pink-700 border-b border-pink-300 pb-2">Form Pendaftaran Pernikahan</h3>
                    <p class="mb-6 text-pink-600 font-medium italic">Mohon lengkapi data jemaat pria dan wanita beserta dokumen terkait.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Similar structured inputs as MARTUPPOL but adjusted labels and placeholders --}}
                        {{-- Nama Jemaat Laki-laki --}}
                        <div>
                            <label for="nama_jemaat_laki" class="block mb-2 font-semibold text-gray-800">Nama Jemaat Laki-laki <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat_laki" id="nama_jemaat_laki" value="{{ old('nama_jemaat_laki') }}" required
                                placeholder="Masukkan nama jemaat laki-laki"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-200" />
                            @error('nama_jemaat_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nama Jemaat Perempuan --}}
                        <div>
                            <label for="nama_jemaat_perempuan" class="block mb-2 font-semibold text-gray-800">Nama Jemaat Perempuan <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat_perempuan" id="nama_jemaat_perempuan" value="{{ old('nama_jemaat_perempuan') }}" required
                                placeholder="Masukkan nama jemaat perempuan"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-200" />
                            @error('nama_jemaat_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="md:col-span-2">
                            <label for="alamat" class="block mb-2 font-semibold text-gray-800">Alamat <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
                                placeholder="Masukkan alamat lengkap"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-200" />
                            @error('alamat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nomor Telepon Laki-laki --}}
                        <div>
                            <label for="no_telepon_laki" class="block mb-2 font-semibold text-gray-800">Nomor Telepon Laki-laki <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon_laki" id="no_telepon_laki" value="{{ old('no_telepon_laki') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-200" />
                            @error('no_telepon_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nomor Telepon Perempuan --}}
                        <div>
                            <label for="no_telepon_perempuan" class="block mb-2 font-semibold text-gray-800">Nomor Telepon Perempuan <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon_perempuan" id="no_telepon_perempuan" value="{{ old('no_telepon_perempuan') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-200" />
                            @error('no_telepon_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Martuppol --}}
                        <div>
                            <label for="surat_martuppol" class="block mb-2 font-semibold text-gray-800">Surat Martuppol <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_martuppol" id="surat_martuppol" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-pink-50 file:text-pink-700 cursor-pointer hover:file:bg-pink-100" />
                            @error('surat_martuppol') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Baptis Laki-laki --}}
                        <div>
                            <label for="surat_baptis_laki" class="block mb-2 font-semibold text-gray-800">Surat Baptis Laki-laki <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_baptis_laki" id="surat_baptis_laki" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-pink-50 file:text-pink-700 cursor-pointer hover:file:bg-pink-100" />
                            @error('surat_baptis_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Baptis Perempuan --}}
                        <div>
                            <label for="surat_baptis_perempuan" class="block mb-2 font-semibold text-gray-800">Surat Baptis Perempuan <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_baptis_perempuan" id="surat_baptis_perempuan" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-pink-50 file:text-pink-700 cursor-pointer hover:file:bg-pink-100" />
                            @error('surat_baptis_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Naik Sidi Laki-laki --}}
                        <div>
                            <label for="surat_naik_sidi_laki" class="block mb-2 font-semibold text-gray-800">Surat Naik Sidi Laki-laki <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_naik_sidi_laki" id="surat_naik_sidi_laki" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-pink-50 file:text-pink-700 cursor-pointer hover:file:bg-pink-100" />
                            @error('surat_naik_sidi_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Surat Naik Sidi Perempuan --}}
                        <div>
                            <label for="surat_naik_sidi_perempuan" class="block mb-2 font-semibold text-gray-800">Surat Naik Sidi Perempuan <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_naik_sidi_perempuan" id="surat_naik_sidi_perempuan" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-pink-50 file:text-pink-700 cursor-pointer hover:file:bg-pink-100" />
                            @error('surat_naik_sidi_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Lingkungan Laki-laki --}}
                        <div>
                            <label for="lingkungan_laki" class="block mb-2 font-semibold text-gray-800">Lingkungan Laki-laki <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan_laki" id="lingkungan_laki" value="{{ old('lingkungan_laki') }}" required
                                placeholder="Masukkan lingkungan laki-laki"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-200" />
                            @error('lingkungan_laki') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Lingkungan Perempuan --}}
                        <div>
                            <label for="lingkungan_perempuan" class="block mb-2 font-semibold text-gray-800">Lingkungan Perempuan <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan_perempuan" id="lingkungan_perempuan" value="{{ old('lingkungan_perempuan') }}" required
                                placeholder="Masukkan lingkungan perempuan"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-200" />
                            @error('lingkungan_perempuan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tanggal Pernikahan --}}
                        <div class="md:col-span-2">
                            <label for="tanggal_layanan" class="block mb-2 font-semibold text-gray-800">Tanggal Pernikahan <span class="text-red-600">*</span></label>
                            <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-200" />
                            @error('tanggal_layanan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Konseling Pranikah --}}
                        <div class="md:col-span-2">
                            <label for="dokumen_pranikah" class="block mb-2 font-semibold text-gray-800">Konseling Pranikah (Upload Dokumen jika ada)</label>
                            <input type="file" name="dokumen_pranikah" id="dokumen_pranikah"
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-pink-50 file:text-pink-700 cursor-pointer hover:file:bg-pink-100" />
                            @error('dokumen_pranikah') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- JEMAAT SAKIT --}}
            @if($jenis == 'jemaat_sakit')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-yellow-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-yellow-800 border-b border-yellow-300 pb-2">Form Jemaat Sakit</h3>
                    <p class="mb-6 text-yellow-700 font-medium italic">Isi data jemaat sakit beserta informasi lingkungan dan tanggal sakit.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_jemaat" class="block mb-2 font-semibold text-gray-800">Nama Jemaat <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat') }}" required
                                placeholder="Masukkan nama jemaat sakit"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200" />
                            @error('nama_jemaat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block mb-2 font-semibold text-gray-800">Alamat <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
                                placeholder="Masukkan alamat jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200" />
                            @error('alamat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="no_telepon" class="block mb-2 font-semibold text-gray-800">Nomor Telepon <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200" />
                            @error('no_telepon') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="umur" class="block mb-2 font-semibold text-gray-800">Umur <span class="text-red-600">*</span></label>
                            <input type="number" name="umur" id="umur" value="{{ old('umur') }}" required min="0"
                                placeholder="Masukkan umur jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200" />
                            @error('umur') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="lingkungan" class="block mb-2 font-semibold text-gray-800">Lingkungan <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan') }}" required
                                placeholder="Masukkan lingkungan jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200" />
                            @error('lingkungan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="tanggal_layanan" class="block mb-2 font-semibold text-gray-800">Tanggal Sakit <span class="text-red-600">*</span></label>
                            <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}"
                                max="{{ date('Y-m-d') }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200" />
                            @error('tanggal_layanan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- JEMAAT MENINGGAL --}}
            @if($jenis == 'jemaat_meninggal')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-red-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-red-800 border-b border-red-300 pb-2">Form Pemberitahuan Jemaat Meninggal</h3>
                    <p class="mb-6 text-red-700 font-medium italic">Isi data jemaat meninggal dengan lengkap.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_jemaat" class="block mb-2 font-semibold text-gray-800">Nama Jemaat <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat') }}" required
                                placeholder="Masukkan nama jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200" />
                            @error('nama_jemaat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block mb-2 font-semibold text-gray-800">Alamat <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
                                placeholder="Masukkan alamat jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200" />
                            @error('alamat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="no_telepon" class="block mb-2 font-semibold text-gray-800">Nomor Telepon yang Bisa Dihubungi <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200" />
                            @error('no_telepon') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="umur" class="block mb-2 font-semibold text-gray-800">Umur <span class="text-red-600">*</span></label>
                            <input type="number" name="umur" id="umur" value="{{ old('umur') }}" required min="0"
                                placeholder="Masukkan umur jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200" />
                            @error('umur') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="lingkungan" class="block mb-2 font-semibold text-gray-800">Lingkungan <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan') }}" required
                                placeholder="Masukkan lingkungan jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200" />
                            @error('lingkungan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="tanggal_layanan" class="block mb-2 font-semibold text-gray-800">Tanggal Meninggal <span class="text-red-600">*</span></label>
                            <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}"
                                max="{{ date('Y-m-d') }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200" />
                            @error('tanggal_layanan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- PEMESANAN GEDUNG --}}
            @if($jenis == 'pemesanan_gedung')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-green-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-green-800 border-b border-green-300 pb-2">Form Pemesanan Gedung Gereja</h3>
                    <p class="mb-6 text-green-700 font-medium italic">Mohon lengkapi data pemesan dan keterangan tambahan jika ada.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_jemaat_pemesan" class="block mb-2 font-semibold text-gray-800">Nama Jemaat Pemesan <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat_pemesan" id="nama_jemaat_pemesan" value="{{ old('nama_jemaat_pemesan') }}" required
                                placeholder="Masukkan nama pemesan"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200" />
                            @error('nama_jemaat_pemesan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="alamat_pemesan" class="block mb-2 font-semibold text-gray-800">Alamat Pemesan <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat_pemesan" id="alamat_pemesan" value="{{ old('alamat_pemesan') }}" required
                                placeholder="Masukkan alamat pemesan"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200" />
                            @error('alamat_pemesan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="no_telepon_pemesan" class="block mb-2 font-semibold text-gray-800">Nomor Telepon Pemesan <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon_pemesan" id="no_telepon_pemesan" value="{{ old('no_telepon_pemesan') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200" />
                            @error('no_telepon_pemesan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="tanggal_layanan" class="block mb-2 font-semibold text-gray-800">Tanggal Pemesanan <span class="text-red-600">*</span></label>
                            <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200" />
                            @error('tanggal_layanan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="keterangan" class="block mb-2 font-semibold text-gray-800">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="4" placeholder="Tambahkan keterangan tambahan jika ada"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">{{ old('keterangan') }}</textarea>
                            @error('keterangan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="lingkungan" class="block mb-2 font-semibold text-gray-800">Lingkungan</label>
                            <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan') }}"
                                placeholder="Masukkan lingkungan (opsional)"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200" />
                            @error('lingkungan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- NAIK SIDI --}}
            @if($jenis == 'naik_sidi')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-purple-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-purple-800 border-b border-purple-300 pb-2">Form Jemaat Naik Sidi</h3>
                    <p class="mb-6 text-purple-700 font-medium italic">Isi data lengkap jemaat naik sidi termasuk data orang tua dan dokumen pendukung.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_jemaat" class="block mb-2 font-semibold text-gray-800">Nama Jemaat <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat') }}" required
                                placeholder="Masukkan nama jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
                            @error('nama_jemaat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nama_ayah" class="block mb-2 font-semibold text-gray-800">Nama Ayah Jemaat <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" required
                                placeholder="Masukkan nama ayah"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
                            @error('nama_ayah') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nama_ibu" class="block mb-2 font-semibold text-gray-800">Nama Ibu Jemaat <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" required
                                placeholder="Masukkan nama ibu"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
                            @error('nama_ibu') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="alamat" class="block mb-2 font-semibold text-gray-800">Alamat Jemaat <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
                                placeholder="Masukkan alamat jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
                            @error('alamat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="no_telepon" class="block mb-2 font-semibold text-gray-800">Nomor Telepon Jemaat <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
                            @error('no_telepon') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="kartu_keluarga" class="block mb-2 font-semibold text-gray-800">Kartu Keluarga Jemaat <span class="text-red-600">*</span></label>
                            <input type="file" name="kartu_keluarga" id="kartu_keluarga" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-purple-50 file:text-purple-700 cursor-pointer hover:file:bg-purple-100" />
                            @error('kartu_keluarga') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="surat_baptis" class="block mb-2 font-semibold text-gray-800">Surat Baptis <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_baptis" id="surat_baptis" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-purple-50 file:text-purple-700 cursor-pointer hover:file:bg-purple-100" />
                            @error('surat_baptis') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="akta_lahir" class="block mb-2 font-semibold text-gray-800">Akta Lahir <span class="text-red-600">*</span></label>
                            <input type="file" name="akta_lahir" id="akta_lahir" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-purple-50 file:text-purple-700 cursor-pointer hover:file:bg-purple-100" />
                            @error('akta_lahir') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="surat_keterangan_warga" class="block mb-2 font-semibold text-gray-800">Surat Keterangan Warga Jemaat <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-purple-50 file:text-purple-700 cursor-pointer hover:file:bg-purple-100" />
                            @error('surat_keterangan_warga') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="lingkungan" class="block mb-2 font-semibold text-gray-800">Lingkungan <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan') }}" required
                                placeholder="Masukkan lingkungan jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
                            @error('lingkungan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- PENDAFTARAN BAPTIS --}}
            @if($jenis == 'baptis')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-indigo-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-indigo-800 border-b border-indigo-300 pb-2">Form Pendaftaran Baptis Anak</h3>
                    <p class="mb-6 text-indigo-700 font-medium italic">Lengkapi data anak dan orang tua beserta dokumen terkait.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_jemaat" class="block mb-2 font-semibold text-gray-800">Nama Jemaat <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat') }}" required
                                placeholder="Masukkan nama jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200" />
                            @error('nama_jemaat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nama_ayah" class="block mb-2 font-semibold text-gray-800">Nama Ayah <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" required
                                placeholder="Masukkan nama ayah"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200" />
                            @error('nama_ayah') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nama_ibu" class="block mb-2 font-semibold text-gray-800">Nama Ibu <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" required
                                placeholder="Masukkan nama ibu"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200" />
                            @error('nama_ibu') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="alamat" class="block mb-2 font-semibold text-gray-800">Alamat <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
                                placeholder="Masukkan alamat lengkap"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200" />
                            @error('alamat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="no_telepon" class="block mb-2 font-semibold text-gray-800">Nomor Telepon Ayah/Ibu <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200" />
                            @error('no_telepon') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="kartu_keluarga" class="block mb-2 font-semibold text-gray-800">Kartu Keluarga <span class="text-red-600">*</span></label>
                            <input type="file" name="kartu_keluarga" id="kartu_keluarga" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-indigo-50 file:text-indigo-700 cursor-pointer hover:file:bg-indigo-100" />
                            @error('kartu_keluarga') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="surat_keterangan_warga" class="block mb-2 font-semibold text-gray-800">Surat Keterangan Warga Jemaat <span class="text-red-600">*</span></label>
                            <input type="file" name="surat_keterangan_warga" id="surat_keterangan_warga" required
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-indigo-50 file:text-indigo-700 cursor-pointer hover:file:bg-indigo-100" />
                            @error('surat_keterangan_warga') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="surat_nikah" class="block mb-2 font-semibold text-gray-800">Surat Nikah (jika anak pertama)</label>
                            <input type="file" name="surat_nikah" id="surat_nikah"
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full file:border file:border-gray-300 file:rounded-lg file:px-4 file:py-2 file:bg-indigo-50 file:text-indigo-700 cursor-pointer hover:file:bg-indigo-100" />
                            @error('surat_nikah') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="lingkungan" class="block mb-2 font-semibold text-gray-800">Lingkungan <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan') }}" required
                                placeholder="Masukkan lingkungan jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200" />
                            @error('lingkungan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- ANAK LAHIR --}}
            @if($jenis == 'anak_lahir')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-teal-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-teal-800 border-b border-teal-300 pb-2">Form Pemberitahuan Anak Lahir</h3>
                    <p class="mb-6 text-teal-700 font-medium italic">Mohon isi data anak dan orang tua secara lengkap.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_anak" class="block mb-2 font-semibold text-gray-800">Nama Anak yang Baru Lahir <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_anak" id="nama_anak" value="{{ old('nama_anak') }}" required
                                placeholder="Masukkan nama anak baru lahir"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200" />
                            @error('nama_anak') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nama_ayah" class="block mb-2 font-semibold text-gray-800">Nama Ayah <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" required
                                placeholder="Masukkan nama ayah"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200" />
                            @error('nama_ayah') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nama_ibu" class="block mb-2 font-semibold text-gray-800">Nama Ibu <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" required
                                placeholder="Masukkan nama ibu"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200" />
                            @error('nama_ibu') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="alamat" class="block mb-2 font-semibold text-gray-800">Alamat <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
                                placeholder="Masukkan alamat lengkap"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200" />
                            @error('alamat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="no_telepon" class="block mb-2 font-semibold text-gray-800">Nomor Telepon Ayah/Ibu <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200" />
                            @error('no_telepon') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="tanggal_lahir" class="block mb-2 font-semibold text-gray-800">Tanggal Lahir <span class="text-red-600">*</span></label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200" />
                            @error('tanggal_lahir') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="lingkungan" class="block mb-2 font-semibold text-gray-800">Lingkungan <span class="text-red-600">*</span></label>
                            <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan') }}" required
                                placeholder="Masukkan lingkungan jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200" />
                            @error('lingkungan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- KUNJUNGAN MAKAM --}}
            @if($jenis == 'kunjungan_makam')
                <section class="border border-gray-300 rounded-lg p-6 bg-gradient-to-tr from-gray-50 to-white shadow-md">
                    <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b border-gray-300 pb-2">Form Pemesanan Kunjungan Makam</h3>
                    <p class="mb-6 text-gray-700 font-medium italic">Mohon lengkapi data jemaat dan keterangan pemesanan.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_jemaat" class="block mb-2 font-semibold text-gray-800">Nama Jemaat <span class="text-red-600">*</span></label>
                            <input type="text" name="nama_jemaat" id="nama_jemaat" value="{{ old('nama_jemaat') }}" required
                                placeholder="Masukkan nama jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200" />
                            @error('nama_jemaat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block mb-2 font-semibold text-gray-800">Alamat <span class="text-red-600">*</span></label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
                                placeholder="Masukkan alamat jemaat"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200" />
                            @error('alamat') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="no_telepon" class="block mb-2 font-semibold text-gray-800">Nomor Telepon <span class="text-red-600">*</span></label>
                            <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200" />
                            @error('no_telepon') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="tanggal_layanan" class="block mb-2 font-semibold text-gray-800">Tanggal Pemesanan <span class="text-red-600">*</span></label>
                            <input type="date" name="tanggal_layanan" id="tanggal_layanan" value="{{ old('tanggal_layanan') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200" />
                            @error('tanggal_layanan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="keterangan" class="block mb-2 font-semibold text-gray-800">Keterangan Pemesanan</label>
                            <textarea name="keterangan" id="keterangan" rows="4" placeholder="Tambahkan keterangan jika ada"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">{{ old('keterangan') }}</textarea>
                            @error('keterangan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="lingkungan" class="block mb-2 font-semibold text-gray-800">Lingkungan</label>
                            <input type="text" name="lingkungan" id="lingkungan" value="{{ old('lingkungan') }}"
                                placeholder="Masukkan lingkungan (opsional)"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200" />
                            @error('lingkungan') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            <div class="flex items-center justify-start space-x-6 pt-4 border-t border-gray-300">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold px-8 py-3 rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-200">
                    Kirim
                </button>
                <a href="{{ route('layanangereja.index') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-150 underline">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
