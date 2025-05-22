{{-- filepath: resources/views/halaman/wartagereja/admin/warta.blade.php --}}
<x-app-layout>
    <link rel="stylesheet" href="/css/beranda.css">

    <section class="upcoming-event px-6 py-10 bg-gray-100">
        <br>
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-700">Data Warta</h3>
                <a href="{{ route('warta.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    + Tambah Data
                </a>
            </div>

            {{-- Filter tanggal (opsional, jika ada field tanggal di tabel warta) --}}
            {{-- <form method="GET" action="{{ route('warta.index') }}" class="mb-4">
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
            </form> --}}

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Judul</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">File</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($warta as $item)
                            <tr>
                                <td class="px-4 py-2">{{ $item->judul }}</td>
                                <td class="px-4 py-2">
                                    @if ($item->file_path)
                                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                            class="text-blue-600 underline">Lihat/Download</a>
                                    @else
                                        <span class="text-gray-400">Tidak ada file</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('warta.edit', $item->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Edit</a>
                                    <form action="{{ route('warta.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm">
                                            Hapus
                                        </button>
                                    </form>
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
