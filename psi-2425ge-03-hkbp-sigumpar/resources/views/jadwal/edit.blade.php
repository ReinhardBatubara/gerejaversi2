@extends('layouts.app') {{-- kalau kamu pakai layout, atau bisa langsung HTML --}}
@section('content')
<div class="container">
    <h2>Edit Jadwal Ibadah</h2>
    <form action="{{ route('jadwal.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="sekolah_minggu" class="form-label">Sekolah Minggu</label>
            <input type="text" name="sekolah_minggu" class="form-control" value="08.00 - 09.30 WIB">
        </div>

        <div class="mb-3">
            <label for="minggu_pagi" class="form-label">Minggu Pagi</label>
            <input type="text" name="minggu_pagi" class="form-control" value="08.00 - 10.00 WIB">
        </div>

        <div class="mb-3">
            <label for="minggu_siang" class="form-label">Minggu Siang</label>
            <input type="text" name="minggu_siang" class="form-control" value="10.00 - 12.00 WIB">
        </div>

        <div class="mb-3">
            <label for="minggu_sore" class="form-label">Minggu Sore</label>
            <input type="text" name="minggu_sore" class="form-control" value="16.00 - 18.00 WIB">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
