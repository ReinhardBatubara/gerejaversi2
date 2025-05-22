<x-app-layout>
    <x-slot name="header">
        <h2>Tambah Event</h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                @error('description')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label for="image">Gambar</label>
                <input type="file" name="image" id="image" class="form-control" required>
                @error('image')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</x-app-layout>
