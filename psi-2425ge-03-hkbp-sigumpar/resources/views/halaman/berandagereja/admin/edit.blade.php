<x-app-layout>
    {{--
    Filepath: resources/views/halaman/berandagereja/admin/edit.blade.php
    Halaman ini berisi form untuk admin mengedit event/dokumentasi kegiatan yang sudah ada.
    --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <form action="{{ route('admin.events.update', $event->id) }}" method="POST"
                    enctype="multipart/form-data">
                    {{-- Token CSRF dan Method Spoofing untuk request PUT --}}
                    @csrf
                    @method('PUT')

                    {{-- Input untuk Judul Event --}}
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required
                            value="{{ old('title', $event->title) }}">
                        @error('title')
                        <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Textarea untuk Deskripsi Event --}}
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                        <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Pratinjau Gambar Saat Ini --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
                        <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}"
                            class="mt-2" style="max-width:200px; border-radius:8px;">
                    </div>

                    {{-- Input untuk Mengganti Gambar --}}
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Ganti Gambar
                            (opsional)</label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full">
                        @error('image')
                        <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center gap-4 mt-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Update
                        </button>
                        <a href="{{ route('admin.events.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
