<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jemaat Mingguan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-700">Data Jumlah Jemaat</h3>
                
            </div>

            {{-- Tabel data jemaat --}}
            <div class="overflow-x-auto mb-8">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Anak-anak</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Remaja</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Dewasa</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Lansia</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($dataJemaat as $item)
                            <tr>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_anak }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_remaja }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_dewasa }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_lansia }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Grafik Jemaat (Bar Chart) --}}
            <div class="mt-10">
                <h3 class="text-lg font-semibold mb-4">Statistik Data Jumlah Jemaat</h3>
                <canvas id="jemaatChart" height="150"></canvas>
            </div>

        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        const ctx = document.getElementById('jemaatChart').getContext('2d');

        // Data labels plugin registration
        Chart.register(ChartDataLabels);

        // Labels dan data diambil dari data yang difilter, hanya ambil 4 data terdekat
        const labels = {!! json_encode($dataJemaat->pluck('tanggal')->map(fn($t) => \Carbon\Carbon::parse($t)->format('d-m-Y'))) !!};
        const dataAnak = {!! json_encode($dataJemaat->pluck('jumlah_anak')) !!};
        const dataRemaja = {!! json_encode($dataJemaat->pluck('jumlah_remaja')) !!};
        const dataDewasa = {!! json_encode($dataJemaat->pluck('jumlah_dewasa')) !!};
        const dataLansia = {!! json_encode($dataJemaat->pluck('jumlah_lansia')) !!};

        // Fungsi untuk mentransformasikan data yang lebih besar dari 300 menjadi >300
        const transformData = (data) => {
            return data.map(value => {
                if (value <= 50) {
                    return 50;
                } else if (value <= 100) {
                    return 100;
                } else if (value <= 150) {
                    return 150;
                } else if (value <= 200) {
                    return 200;
                } else if (value <= 250) {
                    return 250;
                } else if (value <= 300) {
                    return 300;
                } else if (value > 300) {
                    return 350;
                }
                return value;
            });
        };

        // Chart hanya akan menampilkan 4 data terdekat
        const jemaatChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels.slice(0, 4),  // Ambil hanya 4 label pertama
        datasets: [
            {
                label: 'Anak-anak',
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                data: transformData(dataAnak).slice(0, 4),
                rawData: dataAnak.slice(0, 4),  // Menyimpan data asli
            },
            {
                label: 'Remaja',
                backgroundColor: 'rgba(255, 206, 86, 0.7)',
                data: transformData(dataRemaja).slice(0, 4),
                rawData: dataRemaja.slice(0, 4),  // Menyimpan data asli
            },
            {
                label: 'Dewasa',
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                data: transformData(dataDewasa).slice(0, 4),
                rawData: dataDewasa.slice(0, 4),  // Menyimpan data asli
            },
            {
                label: 'Lansia',
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                data: transformData(dataLansia).slice(0, 4),
                rawData: dataLansia.slice(0, 4),  // Menyimpan data asli
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            datalabels: {
                display: true,
                color: 'black', // Warna teks angka di dalam bar
                align: 'center',  // Menempatkan angka di dalam batang
                anchor: 'center', // Mengatur agar angka berada di tengah batang
                font: {
                    weight: 'bold',
                    size: 16 // Ukuran font
                },
                padding: {
                    top: 10, // Memberikan ruang di atas angka
                    bottom: 5  // Memberikan sedikit ruang di bawah angka
                },
                formatter: (value, context) => {
                    // Menampilkan angka asli (sebelum transformasi)
                    const originalData = context.dataset.rawData[context.dataIndex];
                    return originalData;  // Menampilkan angka asli sebelum transformasi
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 50,
                    callback: function(value) {
                                if (value === 0) return '0';
                                if (value === 50) return '1-50';
                                if (value === 100) return '51-100';
                                if (value === 150) return '101-150';
                                if (value === 200) return '151-200';
                                if (value === 250) return '201-250';
                                if (value === 300) return '251-300';
                                if (value === 350) return '>300';
                                return value;
                            }

                }
            }
        }
    }
});

    </script>

</x-app-layout>
