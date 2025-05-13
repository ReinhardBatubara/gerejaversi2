@extends('layouts.app')

@section('content')
    <h2>Statistik Jemaat</h2>

    <canvas id="genderChart" width="400" height="200"></canvas>
    <canvas id="ageChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const genderData = @json($byGender);
        const genderLabels = Object.keys(genderData);
        const genderValues = Object.values(genderData);

        const ageData = @json($byAgeCategory);
        const ageLabels = Object.keys(ageData);
        const ageValues = Object.values(ageData);

        new Chart(document.getElementById('genderChart'), {
            type: 'bar',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Jumlah Jemaat per Gender',
                    data: genderValues,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
                }]
            }
        });

        new Chart(document.getElementById('ageChart'), {
            type: 'pie',
            data: {
                labels: ageLabels,
                datasets: [{
                    label: 'Distribusi Usia Jemaat',
                    data: ageValues,
                    backgroundColor: ['#f6c23e', '#e74a3b', '#858796', '#1cc88a']
                }]
            }
        });
    </script>
@endsection
