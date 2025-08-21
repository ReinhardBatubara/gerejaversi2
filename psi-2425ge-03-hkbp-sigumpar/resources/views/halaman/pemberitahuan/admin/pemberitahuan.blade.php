<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pemberitahuan
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-lg font-semibold mb-4">Pemberitahuan</h3>

        <div class="grid grid-cols-1 gap-6">
            @foreach ($layanans as $layanan)
                <div class="border p-6 rounded-lg shadow-md bg-white space-y-4">
                    
                    <!-- Jenis Layanan -->
                    <div class="font-semibold text-xl text-blue-600">{{ $layanan['jenis_layanan'] }}</div>

                    <!-- Pengirim -->
                    <div class="text-sm text-gray-600">
                        Dikirim oleh:
                        @if ($layanan->user_id)
                            {{ $layanan->user->full_name }}
                        @else
                            Pengirim tidak ditemukan
                        @endif
                    </div>

                    <!-- Form Status & Alasan -->
                    <form action="{{ route('pemberitahuan.updateStatus', $layanan->id) }}" method="POST" class="space-y-3" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-wrap gap-4 items-center mb-4">
                            <div class="flex items-center gap-3">
                                <label for="status_{{ $layanan->id }}" class="text-sm font-medium text-gray-700">Status:</label>
                                <select name="status" id="status_{{ $layanan->id }}" onchange="toggleAlasan('{{ $layanan->id }}'); toggleFileUpload('{{ $layanan->id }}');" class="border rounded-lg px-3 py-2 text-sm bg-white text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <option value="Diterima" {{ $layanan['status'] == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="Ditolak" {{ $layanan['status'] == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="Sedang Proses" {{ $layanan['status'] == 'Sedang Proses' ? 'selected' : '' }}>Sedang Proses</option>
                                    <option value="Selesai" {{ $layanan['status'] == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <button type="submit" class="text-sm text-blue-600 hover:underline">Update Status</button>
                        </div>

                        <div id="alasan_{{ $layanan->id }}" style="display: {{ $layanan['status'] == 'Ditolak' ? 'block' : 'none' }};">
                            <textarea name="alasan" rows="3" class="border p-2 w-full rounded-lg text-sm mt-1" placeholder="Masukkan alasan penolakan...">{{ old('alasan', $layanan->alasan) }}</textarea>
                            @error('alasan')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="alasan_{{ $layanan->id }}" style="display: {{ $layanan['status'] == 'Selesai' ? 'block' : 'none' }};">
                            <textarea name="alasan" rows="3" class="border p-2 w-full rounded-lg text-sm mt-1" placeholder="Masukkan Pemberitahuan">{{ old('alasan', $layanan->alasan) }}</textarea>
                            @error('alasan')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Upload hanya jika status Selesai -->
                        <div id="fileUpload_{{ $layanan->id }}" style="display: {{ $layanan['status'] == 'Selesai' ? 'block' : 'none' }};">
                            <label for="file_{{ $layanan->id }}" class="text-sm font-medium text-gray-700">Unggah File (File PDF):</label>
                            <input type="file" name="file" id="file_{{ $layanan->id }}" class="form-control" accept="application/pdf">
                        </div>
                    </form>

                    {{-- Tampilkan file dan tombol hapus hanya jika status 'Selesai' dan ada file --}}
                    @if ($layanan->status == 'Selesai' && $layanan->file_path)
                        <div class="flex items-center justify-between mt-4 p-3 bg-gray-50 rounded-lg">
                            {{-- Link untuk melihat file --}}
                            <a href="{{ Storage::url($layanan->file_path) }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                                Lihat File Sertifikat
                            </a>

                            {{-- Tombol Hapus File --}}
                            <form action="{{ route('layanangereja.removeFile', $layanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file sertifikat ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 text-xs">
                                    Hapus File
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Tombol Aksi -->
                    <div class="flex items-center gap-4 mt-4">
                        <a href="{{ route('layanangereja.show', $layanan->id) }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm transition-all">
                            Lihat Detail
                        </a>

                        <form action="{{ route('pemberitahuan.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pemberitahuan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Script Toggle Alasan and File Upload -->
    <script>
        function toggleAlasan(id) {
            const status = document.getElementById(`status_${id}`).value;
            const alasanDiv = document.getElementById(`alasan_${id}`);
            alasanDiv.style.display = (status === 'Ditolak') ? 'block' : 'none';
        }

        function toggleFileUpload(id) {
            const status = document.getElementById(`status_${id}`).value;
            const fileUploadDiv = document.getElementById(`fileUpload_${id}`);
            fileUploadDiv.style.display = (status === 'Selesai') ? 'block' : 'none';
        }

        // Jalankan sekali saat load halaman untuk sync tampilan
        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('select[name="status"]').forEach(select => {
                toggleAlasan(select.id.split('_')[1]);
                toggleFileUpload(select.id.split('_')[1]);
            });
        });
    </script>
</x-app-layout>
