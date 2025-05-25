<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananGereja;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        if (! $jenis) {
            return redirect()->route('layanangereja.index')->with('error', 'Pilih layanan terlebih dahulu.');
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

        // Validasi umum, termasuk validasi jenis layanan wajib ada dan harus valid
        $rules = [
            'jenis_layanan' => 'required|string|in:martuppol,pernikahan,jemaat_sakit,jemaat_meninggal,pemesanan_gedung,naik_sidi,baptis,anak_lahir,kunjungan_makam',
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

            default:
                return back()->withErrors(['jenis_layanan' => 'Jenis layanan tidak valid']);
        }

        // Jalankan validasi
        $validated = $request->validate($rules);

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

        foreach ($users as $u) {
            Notification::create([
                'user_id' => $u->id,
                'layanan_id' => $layanan->id,
                'title' => 'Layanan Gereja Baru',
                'message' => "Layanan '{$jenis}' baru dari jemaat: " . ($validated['nama_jemaat'] ?? ($validated['nama_jemaat_laki'] ?? 'N/A')),
                'is_read' => false,
            ]);
        }

        return redirect()->route('layanangereja.index')->with('success', 'Form layanan berhasil disimpan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);

        $layanan = LayananGereja::findOrFail($id);
        $layanan->status = $request->status;
        $layanan->save();

        // Kirim notifikasi ke user pemohon tentang status update
        Notification::create([
            'user_id' => $layanan->user_id,
            'title' => "Status Layanan Anda: " . ucfirst($request->status),
            'message' => "Pengajuan layanan Anda dengan jenis {$layanan->jenis_layanan} telah {$request->status}.",
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Status layanan berhasil diperbarui.');
    }

    public function toggleStatus($kode)
    {
        // Data layanan bisa disimpan di session atau database
        $layanans = session('layanans_statuses', [
            'martuppol' => true,
            'naik_sidi' => true,
            'pernikahan' => true,
            'baptis' => true,
            'jemaat_sakit' => true,
            'jemaat_meninggal' => true,
            'anak_lahir' => true,
            'kunjungan_makam' => true,
            'pemesanan_gedung' => true,
        ]);

        if (!array_key_exists($kode, $layanans)) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan.');
        }

        // Toggle status layanan
        $layanans[$kode] = !$layanans[$kode];

        // Simpan kembali ke session
        session(['layanans_statuses' => $layanans]);

        return redirect()->back()->with('success', "Status layanan '{$kode}' berhasil diubah menjadi " . ($layanans[$kode] ? 'Tersedia' : 'Tidak Tersedia'));
    }
}
