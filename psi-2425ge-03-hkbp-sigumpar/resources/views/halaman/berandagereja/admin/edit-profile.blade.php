<x-app-layout>
    <x-slot name="header">
        <h2>Edit Profil Pendeta</h2>
    </x-slot>

    <div class="container mx-auto p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.profile-pendeta.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama Pendeta</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $profile->nama) }}" required>
                @error('nama')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="posisi">Jabatan</label>
                <input type="text" id="posisi" name="posisi" value="{{ old('posisi', $profile->posisi) }}" required>
                @error('posisi')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $profile->deskripsi) }}</textarea>
                @error('deskripsi')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="photo_url">Foto Pendeta (biarkan kosong jika tidak diubah)</label>
                <input type="file" id="photo_url" name="photo_url" accept="image/*">
                @error('photo_url')<p class="error">{{ $message }}</p>@enderror

                @if($profile->photo_url)
                    <p>Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $profile->photo_url) }}" alt="Foto Pendeta" class="current-photo">
                @endif
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>

    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form.profile-form {
            background: #fff;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
        }

        .form-group {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #333;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            padding: 10px 12px;
            font-size: 1rem;
            border: 1.5px solid #ccc;
            border-radius: 5px;
            resize: vertical;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #005bbb;
            outline: none;
        }

        textarea {
            min-height: 120px;
            font-family: inherit;
        }

        .error {
            color: #d9534f;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .current-photo {
            margin-top: 10px;
            max-width: 150px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .btn-submit {
            background-color: #005bbb;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn-submit:hover {
            background-color: #003f7d;
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</x-app-layout>
