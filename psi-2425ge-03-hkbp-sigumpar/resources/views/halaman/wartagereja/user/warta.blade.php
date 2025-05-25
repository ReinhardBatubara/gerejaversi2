<x-app-layout>
    <link rel="stylesheet" href="/css/beranda.css">

    <section class="upcoming-event px-6 py-10 bg-gray-100">
        <br>
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md">

            {{-- Tampilkan PDF viewer warta terbaru di bagian atas --}}
            @if ($latestWarta && $latestWarta->file_path)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Warta Terbaru: {{ $latestWarta->judul }}</h3>
                    <div style="width:100%; max-width:1000px; height:600px; border:1px solid #ccc;">
                        <iframe src="{{ asset('storage/' . $latestWarta->file_path) }}" 
                            width="100%" height="100%" style="border:none;">
                        </iframe>
                    </div>
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-700">Data Warta</h3>
            </div>

            {{-- Filter tanggal (opsional, jika ada field tanggal di tabel warta) --}}
            <form method="GET" action="{{ route('warta.index') }}" class="mb-4">
                <div class="flex items-center gap-4">
                    <label for="tanggal" class="text-gray-700 font-medium">Filter Tanggal:</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}"
                        class="border-gray-300 rounded-md shadow-sm">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
                        Cari
                    </button>
                    <a href="{{ route('warta.index') }}"
                        class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md shadow">
                        Reset
                    </a>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Judul</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">File</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($wartas as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->judul }}</td>
                            <td class="px-4 py-2">
                                @if ($item->file_path)
                                    {{-- Link Download --}}
                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="text-blue-600 underline mb-2 inline-block">
                                        Download
                                    </a>
                                    
                                @else
                                    <span class="text-gray-400">Tidak ada file</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data warta.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <script src="/public/js/script.js"></script>
</x-app-layout>
