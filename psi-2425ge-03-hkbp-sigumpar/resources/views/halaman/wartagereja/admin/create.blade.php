<x-app-layout>
    {{--
    Filepath: resources/views/halaman/wartagereja/admin/create.blade.php
    Halaman ini berisi form untuk membuat warta gereja baru.
    --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Menggunakan helper __() untuk terjemahan --}}
            {{ __('Tambah Warta Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                {{-- Bagian untuk menampilkan error validasi jika ada --}}
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="py-3 mb-4 w-full rounded-3xl bg-red-500 text-white">
                    {{ $error }}
                </div>
                @endforeach
                @endif

                {{-- Form untuk mengirim data warta baru --}}
                <form method="POST" action="{{ route('warta.store') }}" enctype="multipart/form-data">
                    @csrf {{-- Token keamanan untuk melindungi dari serangan CSRF --}}

                    {{-- Input untuk Judul Warta --}}
                    <div>
                        <x-input-label for="judul" :value="__('Judul')" />
                        <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul"
                            placeholder="Masukkan judul warta" :value="old('judul')" required autofocus
                            autocomplete="judul" />
                        <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                    </div>

                    {{-- Input untuk File Warta (PDF/Word) --}}
                    <div class="mt-4">
                        <x-input-label for="file_path" :value="__('File Warta (PDF/DOCX)')" />
                        <x-text-input id="file_path" class="block mt-1 w-full" type="file" name="file_path"
                            required autofocus autocomplete="file_path" />
                        <x-input-error :messages="$errors->get('file_path')" class="mt-2" />
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Tambah Warta
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
