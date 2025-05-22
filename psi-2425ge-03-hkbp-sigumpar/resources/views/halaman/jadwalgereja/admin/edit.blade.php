<form action="{{ route('jadwal.massUpdate') }}" method="POST">
    @csrf
    @method('PUT')

    @foreach (['SEKOLAH MINGGU', 'MINGGU PAGI', 'MINGGU SIANG', 'MINGGU SORE'] as $index => $jenis)
        @php
            $item = $grouped[$jenis] ?? null;
        @endphp
        <input type="hidden" name="jadwal[{{ $index }}][id]" value="{{ $item->id ?? '' }}">
        <input type="hidden" name="jadwal[{{ $index }}][nama]" value="{{ $jenis }}">
        <input type="time" name="jadwal[{{ $index }}][jam_mulai]" value="{{ $item ? $item->jam_mulai : '' }}" required>
        <input type="time" name="jadwal[{{ $index }}][jam_selesai]" value="{{ $item ? $item->jam_selesai : '' }}" required>
        <select name="jadwal[{{ $index }}][bahasa]" required>
            <option value="">Pilih Bahasa</option>
            <option value="Bahasa Indonesia" {{ $item && $item->bahasa == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
            <option value="Bahasa Batak Toba" {{ $item && $item->bahasa == 'Bahasa Batak Toba' ? 'selected' : '' }}>Bahasa Batak Toba</option>
            <option value="-" {{ $item && $item->bahasa == '-' ? 'selected' : '' }}>-</option>
        </select>
    @endforeach

    <button type="submit">Simpan Perubahan</button>
</form>
