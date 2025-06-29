<x-app-layout>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Jadwal Ibadah (Toggle Edit + Enable/Disable + Add/Remove)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; padding: 0; margin-top: 70px;
            background-color: #f9fafd;
        }
        .content-section {
            padding: 2rem 1rem;
            display: flex; justify-content: center; align-items: center; flex-direction: column;
        }
        .image-wrapper {
            width: 100%; max-width: 400px; aspect-ratio: 3 / 4;
            overflow: hidden; border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .church-image {
            width: 100%; height: 100%; object-fit: cover; border-radius: inherit;
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
        /* Style card jadwal di view */
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
        /* Edit form styling */
        .btn-remove {
            cursor: pointer;
            color: #dc3545;
            font-weight: bold;
            border: none;
            background: none;
            font-size: 1.2rem;
            padding: 0 0.5rem;
            user-select: none;
        }
        .btn-remove:hover {
            color: #a71d2a;
        }
        @media (max-width: 768px) {
            .image-wrapper {
                max-width: 300px; margin-bottom: 1rem;
            }
        }
        .welcome-title {
            font-weight: bold;
            color: #343a40;
        }
        .form-check-label {
            cursor: pointer;
            user-select: none;
        }
    </style>
</head>
<body class="page-jadwal">
    <div class="container content-section">
        <h1 class="welcome-title text-center mb-4">JADWAL IBADAH HKBP SIGUMPAR</h1>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 mb-4 text-center">
                <div class="image-wrapper">
                    <img src="{{ asset('images/hkbp sigumpar.jpg') }}" alt="Gereja" class="church-image" />
                </div>
            </div>
            <div class="col-md-6">

                {{-- VIEW NORMAL --}}
                <div class="schedule-box" id="viewBox">
                    <div class="schedule-title" id="viewTitle">JADWAL IBADAH MINGGU</div>
                    <div id="viewSchedulesContainer"></div>
                    <div class="text-center mt-4">
                        <button class="btn btn-warning px-4" onclick="toggleEdit()">Edit Jadwal & Nama Minggu</button>
                    </div>
                </div>

                {{-- FORM EDIT (default disembunyikan) --}}
                <div class="schedule-box" id="editBox" style="display:none;">
                    <div class="schedule-title">Edit Nama Minggu & Jadwal Ibadah</div>
                    <form id="editForm" onsubmit="event.preventDefault(); saveEdit();">
                        <div id="editSchedulesContainer"></div>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-success px-4" onclick="addSchedule()">+ Tambah Jadwal Baru</button>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5">Simpan Jadwal</button>
                            <button type="button" class="btn btn-secondary px-5 ms-3" onclick="toggleEdit()">Batal</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Data jadwal dari backend, sudah dalam format siap pakai
    let schedulesData = @json($jadwals);

    const languagesOptions = ['', 'Bahasa Indonesia', 'Bahasa Batak Toba'];

    // Render jadwal di tampilan view dengan card menarik
    function renderViewSchedules() {
        const container = document.getElementById('viewSchedulesContainer');
        container.innerHTML = '';
        schedulesData.forEach((item, i) => { // skip yg tidak aktif
            const div = document.createElement('div');
            div.className = 'schedule-card';
            div.id = `view-${i}`;
            div.innerHTML = `
                <div class="schedule-name">${item.nama}</div>
                <div class="schedule-time">⏰ ${item.jam_mulai} - ${item.jam_selesai} WIB</div>
                <div class="schedule-language">🗣️ ${item.bahasa || '-'}</div>
                <div class="text-end mt-2">
                    <button type="button" class="btn btn-danger btn-remove" onclick="removeSchedule(${i})">Hapus</button>
                </div>
            `;
            container.appendChild(div);
        });
    }

    // Render form edit jadwal
    function renderEditSchedules() {
        const container = document.getElementById('editSchedulesContainer');
        container.innerHTML = '';
        schedulesData.forEach((item, i) => {
            container.appendChild(createScheduleFormBlock(item, i));
        });
    }

    // Buat elemen form jadwal dengan tombol hapus (tombol hapus hanya di view)
    function createScheduleFormBlock(schedule, index) {
        const wrapper = document.createElement('div');
        wrapper.className = 'mb-4 border rounded p-3 position-relative';
        wrapper.dataset.index = index;

        wrapper.innerHTML += `
            <input type="hidden" id="id-${index}" value="${schedule.id || ''}" />
            <div class="mb-3">
                <label for="nama-${index}" class="form-label">Nama Jadwal</label>
                <input type="text" id="nama-${index}" class="form-control" value="${schedule.nama}" />
            </div>
            <h5>${schedule.nama}</h5>
            <div class="row g-3 align-items-center">
                <div class="col-auto"><label for="jam-mulai-${index}" class="col-form-label">Jam Mulai</label></div>
                <div class="col-auto"><input type="time" id="jam-mulai-${index}" class="form-control" value="${schedule.jam_mulai}" /></div>
                <div class="col-auto"><label for="jam-selesai-${index}" class="col-form-label">Jam Selesai</label></div>
                <div class="col-auto"><input type="time" id="jam-selesai-${index}" class="form-control" value="${schedule.jam_selesai}" /></div>
                <div class="col-auto"><label for="bahasa-${index}" class="col-form-label">Bahasa</label></div>
                <div class="col-auto">
                    <select id="bahasa-${index}" class="form-select">
                        ${languagesOptions.map(lang => `<option value="${lang}" ${lang === schedule.bahasa ? 'selected' : ''}>${lang || 'Pilih Bahasa'}</option>`).join('')}
                    </select>
                </div>
            </div>
        `;
        return wrapper;
    }

    // Toggle view/edit mode
    function toggleEdit() {
        const viewBox = document.getElementById('viewBox');
        const editBox = document.getElementById('editBox');
        if (editBox.style.display === 'none') {
            renderEditSchedules();
            editBox.style.display = 'block';
            viewBox.style.display = 'none';
        } else {
            editBox.style.display = 'none';
            viewBox.style.display = 'block';
            resetEditForm();
        }
    }

    // Tambah jadwal baru di form edit
    function addSchedule() {
        schedulesData.push({ id: null, nama: '', jam_mulai: '', jam_selesai: '', bahasa: '' });
        renderEditSchedules();
    }

    // Hapus jadwal di tampilan dengan AJAX ke backend
    function removeSchedule(index) {
        const schedule = schedulesData[index];
        if (schedule.id) {
            if (confirm(`Yakin hapus jadwal "${schedule.nama}"?`)) {
                deleteScheduleFromServer(schedule.id)
                    .then(() => {
                        schedulesData.splice(index, 1);
                        renderEditSchedules();
                        renderViewSchedules();
                        alert('Jadwal berhasil dihapus');
                    })
                    .catch(err => alert('Gagal menghapus jadwal: ' + err.message));
            }
        } else {
            // Jadwal baru, hapus langsung tanpa server call
            schedulesData.splice(index, 1);
            renderEditSchedules();
            renderViewSchedules();
        }
    }

    // Fungsi panggil API hapus jadwal
    function deleteScheduleFromServer(id) {
        return fetch(`/jadwal/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => { throw new Error(data.message || 'Error hapus jadwal'); });
            }
            return response.json();
        });
    }

    // Reset form edit ke nilai terakhir disimpan (saat batal)
    function resetEditForm() {
        renderEditSchedules();
    }

    // Simpan hasil edit, update view dan data array schedulesData, lalu kirim ke backend
    function saveEdit() {
    const count = schedulesData.length;
    let updatedSchedules = [];

    for (let i = 0; i < count; i++) {
        const id = document.getElementById(`id-${i}`).value || null;
        const nama = document.getElementById(`nama-${i}`).value.trim();
        if (!nama) {
            if(i==0){
            alert(`Nama jadwal tidak boleh kosong!`);
            document.getElementById(`nama-${i}`).focus();
            return;  
            }else {
            alert(`Nama jadwal ke-${i + 1} tidak boleh kosong!`);
            document.getElementById(`nama-${i}`).focus();
            return;
            }
        }

        const jamMulai = document.getElementById(`jam-mulai-${i}`).value;
        const jamSelesai = document.getElementById(`jam-selesai-${i}`).value;

        // Validasi jam mulai dan jam selesai
        if (jamMulai >= jamSelesai) {
            if(i==0){
            alert(`Jam mulai harus lebih kecil dari jam selesai!`);
            document.getElementById(`jam-mulai-${i}`).focus();
            return;   
            }else {
            alert(`Jam mulai harus lebih kecil dari jam selesai pada jadwal ke-${i + 1}!`);
            document.getElementById(`jam-mulai-${i}`).focus();
            return;
            }
        }

        const bahasa = document.getElementById(`bahasa-${i}`).value;

        updatedSchedules.push({ id, nama, jam_mulai: jamMulai, jam_selesai: jamSelesai, bahasa });
    }

    fetch("{{ route('jadwal.updateMassal') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ jadwals: updatedSchedules })
    })
    .then(response => {
        if (!response.ok) throw new Error('Gagal menyimpan jadwal');
        return response.json();
    })
    .then(data => {
        schedulesData = updatedSchedules;
        renderViewSchedules();
        toggleEdit();
        alert(data.message);
    })
    .catch(err => {
        alert(err.message);
    });
}


    // Render awal view schedules saat load halaman
    renderViewSchedules();
</script>


</body>
</html>
</x-app-layout>
