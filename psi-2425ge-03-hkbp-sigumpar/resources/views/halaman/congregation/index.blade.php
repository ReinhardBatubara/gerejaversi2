<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jemaat Mingguan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-700">Data Jemaat</h3>
                <a href="{{ route('congregations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    + Tambah Data
                </a>
            </div>

            {{-- Filter tanggal --}}
            <form method="GET" action="{{ route('congregations.index') }}" class="mb-4">
                <div class="flex items-center gap-4">
                    <label for="tanggal" class="text-gray-700 font-medium">Filter Tanggal:</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" class="border-gray-300 rounded-md shadow-sm">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
                        Cari
                    </button>
                    <a href="{{ route('congregations.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-md shadow">
                        Reset
                    </a>
                </div>
            </form>

            <div class="overflow-x-auto mb-8">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Anak-anak</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Remaja</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Dewasa</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Lansia</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($congregations as $item)
                            <tr>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_anak }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_remaja }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_dewasa }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_lansia }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('congregations.edit', $item->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Edit</a>
                                    <form action="{{ route('congregations.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data jemaat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Statistik Chart --}}
            <h2 class="text-xl font-semibold text-gray-700 mb-6">Statistik Jemaat</h2>
            <canvas id="chartAge" height="100" class="mt-8"></canvas>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengakses data yang dikirim dari controller
        const dataByWeek = {!! json_encode($byWeek) !!};

        // Chart for Weekly Data Grouped by Age Categories (Bar Chart)
        const ctxAge = document.getElementById('chartAge').getContext('2d');
        new Chart(ctxAge, {
            type: 'bar',  // Bar chart type
            data: {
                labels: Object.keys(dataByWeek),  // Labels for weeks
                datasets: [
                    {
                        label: 'Anak-anak',  // First category
                        data: dataByWeek['Anak-anak'] || [],  // Data for Anak-anak category
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',  // Color for Anak-anak
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Remaja',  // Second category
                        data: dataByWeek['Remaja'] || [],  // Data for Remaja category
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',  // Color for Remaja
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Dewasa',  // Third category
                        data: dataByWeek['Dewasa'] || [],  // Data for Dewasa category
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',  // Color for Dewasa
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Lansia',  // Fourth category
                        data: dataByWeek['Lansia'] || [],  // Data for Lansia category
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',  // Color for Lansia
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Minggu'
                        },
                        stacked: true,  // Stacked bars
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Jemaat'
                        },
                        beginAtZero: true,
                        stacked: true  // Stacked bars
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
</x-app-layout>
