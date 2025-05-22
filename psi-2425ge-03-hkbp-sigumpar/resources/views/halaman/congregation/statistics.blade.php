@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Statistik Jemaat</h2>

    <canvas id="chartDate" height="100"></canvas>
    <canvas id="chartAge" height="100" class="mt-5"></canvas>
    <canvas id="chartGender" height="100" class="mt-5"></canvas>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataByDate = {!! json_encode($byDate) !!};
        const dataByAge = {!! json_encode($byAge) !!};
        const dataByGender = {!! json_encode($byGender) !!};

        const ctxDate = document.getElementById('chartDate').getContext('2d');
        new Chart(ctxDate, {
            type: 'line',
            data: {
                labels: dataByDate.map(item => item.tanggal),
                datasets: [{
                    label: 'Jumlah Jemaat per Tanggal',
                    data: dataByDate.map(item => item.total),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3
                }]
            }
        });

        const ctxAge = document.getElementById('chartAge').getContext('2d');
        new Chart(ctxAge, {
            type: 'bar',
            data: {
                labels: dataByAge.map(item => item.age_categories),
                datasets: [{
                    label: 'Jumlah Jemaat per Kategori Usia',
                    data: dataByAge.map(item => item.total),
                    backgroundColor: 'rgba(153, 102, 255, 0.6)'
                }]
            }
        });

        const ctxGender = document.getElementById('chartGender').getContext('2d');
        new Chart(ctxGender, {
            type: 'pie',
            data: {
                labels: dataByGender.map(item => item.gender),
                datasets: [{
                    label: 'Jumlah Jemaat per Gender',
                    data: dataByGender.map(item => item.total),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)'
                    ]
                }]
            }
        });
    </script>
@endsection
