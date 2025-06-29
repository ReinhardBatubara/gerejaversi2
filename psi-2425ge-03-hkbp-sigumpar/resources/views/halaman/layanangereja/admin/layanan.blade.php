<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Layanan Gereja</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-lg font-semibold mb-4">Pilih Layanan Jemaat:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ($layanans as $layanan)
                <div class="border p-4 rounded shadow">
                    <div class="font-semibold">{{ $layanan['nama'] }}</div> <!-- Menampilkan nama layanan -->
                    <div>Status: 
                        @if ($layanan['status_aktif'])
                            <span class="text-green-600 font-bold">Tersedia</span>
                        @else
                            <span class="text-red-600 font-bold">Tidak Tersedia</span>
                        @endif
                    </div>

                    @if ($layanan['status_aktif'])
                        <!-- Jika layanan aktif, beri tombol untuk memilih layanan -->
                        <a href="{{ route('layanangereja.create', ['jenis' => $layanan['kode']]) }}" class="mt-2 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Pilih Layanan</a>
                    @else
                        <!-- Jika layanan tidak aktif, tombol diblock -->
                        <button disabled class="mt-2 inline-block bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">Tidak Tersedia</button>
                    @endif

                    {{-- Tombol toggle status --}}
                    <form action="{{ route('layanan.toggleStatus', $layanan['kode']) }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="text-sm px-3 py-1 rounded border
                            {{ $layanan['status_aktif'] ? 'border-red-600 text-red-600 hover:bg-red-100' : 'border-green-600 text-green-600 hover:bg-green-100' }}">
                            {{ $layanan['status_aktif'] ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>  
    </div>
</x-app-layout>
