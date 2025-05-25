@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Statistik Jemaat</h2>

    <canvas id="chartDate" height="100"></canvas>
    <canvas id="chartAge" height="100" class="mt-5"></canvas>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengakses data yang dikirim dari controller
        const dataByDate = {!! json_encode($byDate) !!};
        const dataByAge = {!! json_encode($byAge) !!};

        // Chart per Tanggal (Jumlah Jemaat per Tanggal)
        const ctxDate = document.getElementById('chartDate').getContext('2d');
        new Chart(ctxDate, {
            type: 'line',
            data: {
                labels: Object.keys(dataByDate),  // Label berdasarkan tanggal
                datasets: [{
                    label: 'Jumlah Jemaat per Tanggal',
                    data: Object.values(dataByDate),  // Jumlah jemaat per tanggal
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3
                }]
            }
        });

        // Chart per Kategori Usia (Jumlah Jemaat per Kategori Usia)
        const ctxAge = document.getElementById('chartAge').getContext('2d');
        new Chart(ctxAge, {
            type: 'bar',
            data: {
                labels: Object.keys(dataByAge),  // Label berdasarkan kategori usia
                datasets: [{
                    label: 'Jumlah Jemaat per Kategori Usia',
                    data: Object.values(dataByAge),  // Jumlah jemaat per kategori usia
                    backgroundColor: 'rgba(153, 102, 255, 0.6)'
                }]
            }
        });
    </script>
@endsection
