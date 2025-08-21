<x-app-layout>
    {{--
    Filepath: resources/views/halaman/berandagereja/admin/create.blade.php
    Halaman ini berisi form untuk admin menambahkan event/dokumentasi kegiatan baru.
    --}}
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-indigo-600">Tambah Event Baru</h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-6">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            {{-- Token CSRF untuk keamanan form --}}
            @csrf

            {{-- Input untuk Judul Event --}}
            <div>
                <label for="title" class="block mb-2 font-semibold text-gray-700">Judul</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    placeholder="Masukkan judul event" required
                    class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                {{-- Menampilkan error validasi untuk 'title' --}}
                @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Textarea untuk Deskripsi Event --}}
            <div>
                <label for="description" class="block mb-2 font-semibold text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" rows="5" placeholder="Deskripsikan event secara singkat"
                    class="w-full rounded-md border border-gray-300 px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('description') }}</textarea>
                {{-- Menampilkan error validasi untuk 'description' --}}
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input untuk Upload Gambar --}}
            <div>
                <label for="image" class="block mb-2 font-semibold text-gray-700">Gambar</label>
                <input type="file" id="image" name="image" accept="image/*" required class="block w-full text-gray-700 file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-indigo-100 file:text-indigo-700
                           hover:file:bg-indigo-200
                           cursor-pointer
                           transition">
                {{-- Menampilkan error validasi untuk 'image' --}}
                @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi (Simpan dan Batal) --}}
            <div class="flex gap-4">
                <button type="submit"
                    class="flex-1 bg-indigo-600 text-white py-2 rounded-md font-semibold hover:bg-indigo-700 transition">
                    Simpan
                </button>
                <a href="{{ route('admin.events.index') }}"
                    class="flex-1 text-center border border-gray-300 rounded-md py-2 text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
