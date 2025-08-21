<x-app-layout>
    {{--
    Catatan: File ini memiliki CSS dan JS inline. Untuk kerapian, sebaiknya dipindahkan
    ke file .css dan .js terpisah dan dipanggil melalui Vite.
    --}}
    <x-slot name="head">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            .content-section {
                padding: 2rem 1rem;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            .image-wrapper {
                width: 100%;
                max-width: 400px;
                aspect-ratio: 3 / 4;
                overflow: hidden;
                border-radius: 0.75rem;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
                margin-bottom: 2rem;
            }
            .church-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: inherit;
            }
            .schedule-box {
                border: 1px solid #ddd;
                padding: 2rem;
                border-radius: 0.5rem;
                max-width: 700px;
                width: 100%;
                background-color: #fff;
                box-shadow: 0 0 12px rgb(0 0 0 / 0.05);
            }
            .schedule-title {
                text-align: center;
                font-weight: 700;
                font-size: 1.8rem;
                margin-bottom: 2rem;
                color: #343a40;
            }
            .schedule-card {
                background: #fefefe;
                border-radius: 0.75rem;
                box-shadow: 0 2px 8px rgb(0 0 0 / 0.08);
                padding: 1rem 1.5rem;
                margin-bottom: 1.25rem;
                transition: box-shadow 0.3s ease;
                cursor: default;
            }
            .schedule-card:hover {
                box-shadow: 0 4px 14px rgb(0 0 0 / 0.15);
            }
            .schedule-name {
                font-weight: 600;
                font-size: 1.25rem;
                color: #212529;
                margin-bottom: 0.25rem;
            }
            .schedule-time {
                font-size: 1rem;
                font-weight: 500;
                color: #495057;
                margin-bottom: 0.25rem;
            }
            .schedule-language {
                font-size: 0.9rem;
                color: #6c757d;
                font-style: italic;
            }
            .welcome-title {
                font-weight: bold;
                color: #343a40;
            }
        </style>
    </x-slot>

    <div class="container content-section">
        <h1 class="welcome-title text-center mb-4">JADWAL IBADAH MINGGU</h1>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 mb-4 text-center">
                <div class="image-wrapper">
                    <img src="{{ asset('images/hkbp sigumpar.jpg') }}" alt="Gereja" class="church-image" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="schedule-box" id="viewBox">
                    <div class="schedule-title" id="viewTitle">JADWAL IBADAH MINGGU</div>
                    <div id="viewSchedulesContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let schedulesData = @json($jadwals);

            function renderViewSchedules() {
                const container = document.getElementById('viewSchedulesContainer');
                container.innerHTML = '';
                schedulesData.forEach((item, i) => {
                    // Di halaman user, item.enabled sepertinya tidak ada, jadi kita tampilkan semua.
                    const div = document.createElement('div');
                    div.className = 'schedule-card';
                    div.id = `view-${i}`;
                    div.innerHTML = `
                        <div class="schedule-name">${item.nama}</div>
                        <div class="schedule-time">⏰ ${item.jam_mulai} - ${item.jam_selesai} WIB</div>
                        <div class="schedule-language">🗣️ ${item.bahasa || '-'}</div>
                    `;
                    container.appendChild(div);
                });
            }

            // Render jadwal saat halaman dimuat
            renderViewSchedules();
        </script>
    </x-slot>
</x-app-layout>
