<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pemberitahuan</h2>
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
                <div class="border p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 bg-white relative">
                    <div class="font-semibold text-xl text-blue-600">
                        {{ $layanan['jenis_layanan'] }}
                    </div>

                    <!-- Menampilkan pengirim (username) di samping jenis layanan -->
                    <div class="text-sm text-gray-600">
                        Dikirim oleh: 
                        @if ($layanan->user_id)
                            {{ $layanan->user->full_name}}
                        @else
                            Pengirim tidak ditemukan
                        @endif
                    </div>

                    <!-- Status, diposisikan di kanan atas (Hanya tampil jika bukan admin) -->
                    @if($layanan->user_id !== 1)
                        <p class="absolute top-4 right-4 text-gray-600">{{ $layanan['status'] }}</p>
                    @endif

                    <!-- Alasan penolakan (terlihat hanya jika status 'Ditolak' dan user bukan admin) -->
                    @if($layanan->user_id !== 1)
                        <div id="alasan_{{ $layanan->id }}" class="mt-4" style="display: {{ $layanan['status'] == 'Ditolak' ? 'block' : 'none' }}">
                            <!-- Menampilkan alasan penolakan jika ada -->
                            @if ($layanan->alasan)
                                <p class="text-gray-800">Alasan Penolakan:</p>
                                <p class="border p-4 rounded-lg bg-gray-100">{{ $layanan->alasan }}</p>
                            @else
                                <p class="text-gray-800">Tidak ada alasan penolakan yang tersedia.</p>
                            @endif
                        </div>
                    @endif

                    @if ($layanan->file_path && $layanan->status === 'Selesai')
                        <div class="flex items-center justify-between mt-4 absolute top-7 right-4">
                            <p class="border p-4 rounded-lg bg-gray-100">{{ $layanan->alasan }}</p>
                        </div>
                    @endif

                    <!-- Tampilkan File Sertifikat jika ada -->
                    @if ($layanan->file_path && $layanan->status === 'Selesai')
                        <div class="flex items-center justify-between mt-4 absolute bottom-4 right-4">
                            <a href="{{ Storage::url($layanan->file_path) }}" target="_blank" class="text-sm text-blue-600 hover:underline">Lihat File Disini</a>
                        </div>
                    @endif


                    <!-- Tombol Lihat Detail -->
                    <a href="{{ route('layanangereja.show', $layanan->id) }}" 
                       class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-all duration-300">
                        Lihat Detail
                    </a>

                    {{-- Tombol Hapus Notifikasi --}}
                    @if($layanan->user_id !== 1)
                        <form action="{{ route('pemberitahuan.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pemberitahuan ini?');" style="display:inline-block; margin-left:10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:underline">Hapus</button>
                        </form>
                    @endif

                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
