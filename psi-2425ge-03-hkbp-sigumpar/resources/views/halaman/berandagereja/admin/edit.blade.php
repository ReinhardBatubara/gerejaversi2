<x-app-layout>
    <x-slot name="header">
        <h2>Edit Event</h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $event->title) }}">
                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $event->description) }}</textarea>
                @error('description')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" style="max-width:200px; border-radius:8px;">
            </div>

            <div class="mb-3">
                <label for="image">Ganti Gambar (opsional)</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</x-app-layout>
