<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananGereja;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth; // <-- wajib import ini

class LayananGerejaController extends Controller
{
    // Menampilkan daftar layanan yang tersedia dan tombol pilih layanan
    public function index()
    {
        $layanans = [
            ['kode' => 'martuppol', 'nama' => 'Martuppol', 'status' => true],
            ['kode' => 'naik_sidi', 'nama' => 'Pendaftaran Naik Sidi', 'status' => true],
            ['kode' => 'pernikahan', 'nama' => 'Pendaftaran Pernikahan', 'status' => true],
            ['kode' => 'baptis', 'nama' => 'Pendaftaran Baptis', 'status' => true],
            ['kode' => 'jemaat_sakit', 'nama' => 'Pemberitahuan Jemaat Sakit', 'status' => true],
            ['kode' => 'anak_lahir', 'nama' => 'Pemberitahuan Anak Lahir', 'status' => true],
            ['kode' => 'jemaat_meninggal', 'nama' => 'Pemberitahuan Jemaat Meninggal Dunia', 'status' => true],
            ['kode' => 'kunjungan_makam', 'nama' => 'Pemesanan Kunjungan Makam', 'status' => true],
            ['kode' => 'pemesanan_gedung', 'nama' => 'Pemesanan Gedung', 'status' => true],
        ];

        return view('halaman.layanangereja.admin.layanan', compact('layanans'));
    }

    // Tampilkan form sesuai layanan yang dipilih
    public function create(Request $request)
    {
        $jenis = $request->query('jenis');

        if (! $jenis) {
            return redirect()->route('layanangereja.index')->with('error', 'Pilih layanan terlebih dahulu.');
        }

        // Bisa buat validasi jenis layanan apakah valid

        return view('halaman.layanangereja.admin.layanan_form', compact('jenis'));
    }

    // Simpan data layanan dari form
    public function store(Request $request)
    {
        $jenis = $request->input('jenis_layanan');

        // Validasi umum
        $rules = [
            'nama_jemaat' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'tanggal_layanan' => 'nullable|date|after_or_equal:today',
        ];

        // Validasi dokumen dan ketentuan sesuai jenis layanan
        switch ($jenis) {
            case 'baptis':
                $rules['surat_keterangan_warga'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                $rules['surat_nikah'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048';
                break;
            case 'naik_sidi':
                $rules['surat_keterangan_warga'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                $rules['surat_baptis'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                $rules['akta'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                break;
            case 'martuppol':
                $rules['surat_keterangan_warga'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                $rules['surat_baptis'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                $rules['surat_naik_sidi'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                break;
            case 'pernikahan':
                $rules['surat_martuppol'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                $rules['surat_baptis'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                $rules['surat_naik_sidi'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
                break;
            case 'jemaat_sakit':
                $rules['wijk'] = 'required|string|max:255'; // ganti keterangan penyakit
                break;
            case 'jemaat_meninggal':
                $rules['lingkungan'] = 'required|string|max:255';
                $rules['tanggal_layanan'] = 'required|date|after_or_equal:today';
                break;
            default:
                // Aturan lain jika perlu
                break;
        }

        $validated = $request->validate($rules);

        $validated['jenis_layanan'] = $jenis;
        $validated['user_id'] = Auth::id(); // pastikan simpan user_id

        // Upload file jika ada
        $fileFields = [
            'surat_keterangan_warga',
            'surat_baptis',
            'surat_naik_sidi',
            'surat_martuppol',
            'akta',
            'dokumen_pranikah',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('dokumen_layanan', 'public');
            }
        }

        $layanan = LayananGereja::create($validated);

        // Kirim notifikasi ke admin (misalnya user_id 1 admin)
        Notification::create([
            'user_id' => 1, // id admin, sesuaikan
            'title' => 'Layanan Gereja Baru',
            'message' => "Layanan '{$jenis}' baru dari jemaat: " . $validated['nama_jemaat'],
            'is_read' => false,
        ]);

        return redirect()->route('layanangereja.index')->with('success', 'Form layanan berhasil disimpan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $layanan = LayananGereja::findOrFail($id);
        $layanan->status = $request->status;
        $layanan->save();

        // Kirim notifikasi ke user pemohon tentang status update
        Notification::create([
            'user_id' => $layanan->user_id, // Pastikan user_id pemohon tersimpan di layanan
            'title' => "Status Layanan Anda: " . ucfirst($request->status),
            'message' => "Pengajuan layanan Anda dengan jenis {$layanan->jenis_layanan} telah {$request->status}.",
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Status layanan berhasil diperbarui.');
    }
}
