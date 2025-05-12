<x-app-layout>
    <link rel="stylesheet" href="/css/beranda.css">

    {{-- Hero and Events Sections (unchanged) --}}

    {{-- New Section: Data Jemaat --}}
    <section class="upcoming-event px-6 py-10 bg-gray-100">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Data Jemaat</h2>

        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-700">Daftar Jemaat</h3>
                <a href="{{ route('congregations.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    + Tambah Data
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Gender</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Kategori Usia</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($congregations as $item)
                            <tr>
                                <td class="px-4 py-2">{{ $item->jumlah }}</td>
                                <td class="px-4 py-2">{{ $item->gender }}</td>
                                <td class="px-4 py-2">{{ $item->age_categories }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('congregations.edit', $item->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Edit</a>
                                    <form action="{{ route('congregations.destroy', $item->id) }}" method="POST"
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
                        @endforeach

                        @if ($congregations->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data jemaat.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Existing Documentation Section --}}
    <script src="/public/js/script.js"></script>
</x-app-layout>
