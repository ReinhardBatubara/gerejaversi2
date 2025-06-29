<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananGereja;
use Illuminate\Support\Facades\Storage;
use App\Models\Pemberitahuan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LayananGerejaController extends Controller
{
    // Menampilkan daftar layanan yang tersedia dan tombol pilih layanan
        public function index()
{
    // Ambil data layanan dari database
    $layanans = LayananGereja::whereNotNull('kode')->get();

    $user = auth()->user();

    if ($user && $user->role === 'admin') {
        return view('halaman.layanangereja.admin.layanan', compact('layanans'));
    } else {
        return view('halaman.layanangereja.user.layanan', compact('layanans'));
    }
}


    // Tampilkan form sesuai layanan yang dipilih
    public function create(Request $request)
{
    $jenis = $request->query('jenis');

    if (!$jenis) {
        return redirect()->route('layanangereja.index')->with('error', 'Pilih layanan terlebih dahulu.');
    }

    $layanan = LayananGereja::where('jenis_layanan', $jenis)->first();

    // Cek jika layanan aktif
    if ($layanan && !$layanan->status_aktif) {
        return redirect()->route('layanangereja.index')->with('error', 'Layanan ini tidak tersedia untuk pengisian.');
    }

    $user = auth()->user();

    if ($user && $user->role === 'admin') {
        return view('halaman.layanangereja.admin.layanan_form', compact('jenis'));
    } else {
        return view('halaman.layanangereja.user.layanan_form', compact('jenis'));
    }
}



    // Simpan data layanan dari form
    public function store(Request $request)
    {
        $jenis = $request->input('jenis_layanan');

        $user = auth()->user();
        // Cek apakah layanan aktif
    $layanan = LayananGereja::where('jenis_layanan', $jenis)->first();
    if ($layanan && !$layanan->status_aktif) {
        return redirect()->back()->with('error', 'Layanan ini tidak tersedia untuk pengisian.');
    }

        // Validasi umum, termasuk validasi jenis layanan wajib ada dan harus valid
        $rules = [
            'jenis_layanan' => 'required|string|in:martuppol,pernikahan,jemaat_sakit,jemaat_meninggal,pemesanan_gedung,naik_sidi,baptis,anak_lahir,kunjungan_makam,kegiatan_mendatang',
        ];

        // Validasi khusus berdasarkan jenis layanan
        switch ($jenis) {
            case 'martuppol':
                $rules = array_merge($rules, [
                    'nama_jemaat_laki' => 'required|string|max:255',
                    'nama_jemaat_perempuan' => 'required|string|max:255',
                    'alamat_laki' => 'required|string|max:255',
                    'alamat_perempuan' => 'required|string|max:255',
                    'no_telepon_laki' => 'required|string|max:20',
                    'no_telepon_perempuan' => 'required|string|max:20',
                    'surat_keterangan_warga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_baptis_laki' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_baptis_perempuan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_naik_sidi_laki' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_naik_sidi_perempuan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'lingkungan_laki' => 'required|string|max:255',
                    'lingkungan_perempuan' => 'required|string|max:255',
                    'tanggal_layanan' => 'required|date',
                ]);
                break;

            case 'pernikahan':
                $rules = array_merge($rules, [
                    'nama_jemaat_laki' => 'required|string|max:255',
                    'nama_jemaat_perempuan' => 'required|string|max:255',
                    'alamat' => 'required|string|max:255',
                    'no_telepon_laki' => 'required|string|max:20',
                    'no_telepon_perempuan' => 'required|string|max:20',
                    'surat_martuppol' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_baptis_laki' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_baptis_perempuan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_naik_sidi_laki' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_naik_sidi_perempuan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'lingkungan_laki' => 'required|string|max:255',
                    'lingkungan_perempuan' => 'required|string|max:255',
                    'tanggal_layanan' => 'required|date',
                    'dokumen_pranikah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                ]);
                break;

            case 'jemaat_sakit':
                $rules = array_merge($rules, [
                    'nama_jemaat' => 'required|string|max:255',
                    'alamat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:20',
                    'umur' => 'required|integer|min:0',
                    'lingkungan' => 'required|string|max:255',
                    'tanggal_layanan' => 'required|date',
                ]);
                break;

            case 'jemaat_meninggal':
                $rules = array_merge($rules, [
                    'nama_jemaat' => 'required|string|max:255',
                    'alamat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:20',
                    'umur' => 'required|integer|min:0',
                    'lingkungan' => 'required|string|max:255',
                    'tanggal_layanan' => 'required|date',
                ]);
                break;

            case 'pemesanan_gedung':
                $rules = array_merge($rules, [
                    'nama_jemaat' => 'required|string|max:255',
                    'alamat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:20',
                    'tanggal_layanan' => 'required|date',
                    'keterangan' => 'nullable|string',
                    'lingkungan' => 'nullable|string|max:255',
                ]);
                break;

            case 'naik_sidi':
                $rules = array_merge($rules, [
                    'nama_jemaat' => 'required|string|max:255',
                    'nama_ayah' => 'required|string|max:255',
                    'nama_ibu' => 'required|string|max:255',
                    'alamat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:20',
                    'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_baptis' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'akta_lahir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_keterangan_warga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'lingkungan' => 'required|string|max:255',
                ]);
                break;

            case 'baptis':
                $rules = array_merge($rules, [
                    'nama_jemaat' => 'required|string|max:255',
                    'nama_ayah' => 'required|string|max:255',
                    'nama_ibu' => 'required|string|max:255',
                    'alamat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:20',
                    'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_keterangan_warga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'surat_nikah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'lingkungan' => 'required|string|max:255',
                ]);
                break;

            case 'anak_lahir':
                $rules = array_merge($rules, [
                    'nama_anak' => 'required|string|max:255',
                    'nama_ayah' => 'required|string|max:255',
                    'nama_ibu' => 'required|string|max:255',
                    'alamat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:20',
                    'tanggal_lahir' => 'required|date',
                    'lingkungan' => 'required|string|max:255',
                ]);
                break;

            case 'kunjungan_makam':
                $rules = array_merge($rules, [
                    'nama_jemaat' => 'required|string|max:255',
                    'alamat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:20',
                    'tanggal_layanan' => 'required|date',
                    'keterangan' => 'nullable|string',
                    'lingkungan' => 'nullable|string|max:255',
                ]);
                break;

            case 'kegiatan_mendatang':
                $rules = array_merge($rules, [
                    'nama_kegiatan' => 'required|string|max:255',
                    'detail_acara' => 'required|string|max:1000',
                    'surat_keterangan_warga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'tanggal_layanan' => 'required|date',
                    'alamat' => 'required|string|max:255',
                    'nama_jemaat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:20',
                ]);
                break;

            default:
                return back()->withErrors(['jenis_layanan' => 'Jenis layanan tidak valid']);
        }

        // Jalankan validasi
        $validated = $request->validate($rules);

        // Menambahkan kolom 'kode' berdasarkan jenis layanan
            // Membuat kode layanan yang berbasis jenis layanan dan timestamp unik
        $validated['kode'] = strtoupper($jenis) . '-' . uniqid(); // Kode berupa jenis layanan + ID unik


        // Simpan user_id ke data validasi
        $validated['user_id'] = $user->id;

        // Upload file jika ada dan update path di $validated
        $fileFields = [
            'surat_keterangan_warga',
            'surat_baptis_laki', 'surat_baptis_perempuan',
            'surat_naik_sidi_laki', 'surat_naik_sidi_perempuan',
            'surat_martuppol', 'akta', 'dokumen_pranikah',
            'surat_nikah', 'kartu_keluarga', 'akta_lahir',
        ];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('dokumen_layanan', 'public');
            }
        }

        // Simpan ke database
        $layanan = LayananGereja::create($validated);

        // Tentukan target user untuk dikirimi notifikasi
        if ($user->role === 'admin') {
            // Jika admin yang submit, kirim ke semua user
            $users = User::all();
        } else {
            // Jika user biasa, kirim hanya ke admin
            $users = User::where('role', 'admin')->get();
        }

        return redirect()->route('pemberitahuan')->with('success', 'Form layanan berhasil disimpan.');
    }


    public function toggleStatus($kode)
{
    // Mengambil data layanan berdasarkan kode
    $layanan = LayananGereja::where('kode', $kode)->first();

    if ($layanan) {
        // Toggle status_aktif (ubah dari true ke false atau sebaliknya)
        $layanan->status_aktif = !$layanan->status_aktif;
        $layanan->save(); // Simpan perubahan status ke database

        return redirect()->back()->with('success', 'Status layanan berhasil diubah.');
    }

    return redirect()->back()->with('error', 'Layanan tidak ditemukan.');
}

public function show($id)
    {
        // Ambil data layanan berdasarkan ID
        $layanan = LayananGereja::findOrFail($id);

        // Kirim data layanan ke view detail
        return view('halaman.pemberitahuan.admin.detail', compact('layanan'));
    }

    public function removeFile($id)
{
    // Cari layanan berdasarkan ID
    $layanan = LayananGereja::findOrFail($id);

    // Pastikan hanya admin yang bisa menghapus file
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    // Cek jika file ada di storage
    if ($layanan->file_path) {
        // Hapus file dari storage
        Storage::disk('public')->delete($layanan->file_path);

        // Reset file_path di database menjadi null
        $layanan->file_path = null;
        $layanan->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Sertifikat berhasil dihapus.');
    }

    // Jika tidak ada file untuk dihapus
    return redirect()->back()->with('error', 'Tidak ada sertifikat untuk dihapus.');
}
}
