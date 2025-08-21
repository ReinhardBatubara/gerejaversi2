<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller JadwalController bertanggung jawab untuk mengelola data jadwal ibadah.
 * Ini mencakup menampilkan, memperbarui secara massal, dan menghapus jadwal.
 */
class JadwalController extends Controller
{
    /**
     * Menampilkan halaman daftar jadwal ibadah.
     *
     * Mengambil semua jadwal dari database, memformatnya, dan menampilkannya
     * ke view yang sesuai (admin atau pengguna biasa).
     *
     * @return View
     */
    public function index(): View
    {
        // Mengambil semua data jadwal dari database.
        // Fungsi map() digunakan untuk mengubah koleksi data sebelum dikirim ke view.
        $jadwals = Jadwal::all()->map(function ($j) {
            return [
                'id'          => $j->id,
                'nama'        => $j->nama,
                // Format waktu ke Jam:Menit (HH:i) menggunakan Carbon, jika tidak null.
                'jam_mulai'   => $j->jam_mulai ? Carbon::parse($j->jam_mulai)->format('H:i') : '',
                'jam_selesai' => $j->jam_selesai ? Carbon::parse($j->jam_selesai)->format('H:i') : '',
                'bahasa'      => $j->bahasa,
                'enabled'     => true, // Properti ini digunakan di frontend.
            ];
        });

        // Memeriksa apakah pengguna telah login dan memiliki peran 'admin'.
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            // Jika admin, tampilkan view untuk admin.
            return view('halaman.jadwalgereja.admin.jadwal', compact('jadwals'));
        }

        // Jika bukan admin atau pengguna belum login, tampilkan view untuk pengguna biasa.
        return view('halaman.jadwalgereja.user.jadwal', compact('jadwals'));
    }

    /**
     * Memperbarui atau membuat jadwal secara massal berdasarkan data dari request.
     * Fungsi ini dirancang untuk dipanggil melalui AJAX dari halaman admin.
     *
     * @param  Request  $request  Data request yang berisi array jadwal.
     * @return JsonResponse
     */
    public function updateMassal(Request $request): JsonResponse
    {
        // Validasi data yang masuk dari request untuk memastikan integritas data.
        $request->validate([
            'jadwals'             => 'required|array',
            'jadwals.*.id'        => 'nullable|integer|exists:jadwals,id',
            'jadwals.*.nama'      => 'required|string|max:100',
            'jadwals.*.jam_mulai' => 'nullable|date_format:H:i',
            'jadwals.*.jam_selesai' => 'nullable|date_format:H:i',
            'jadwals.*.bahasa'    => 'nullable|string|max:50',
            'jadwals.*.enabled'   => 'boolean',
        ]);

        $inputJadwals = $request->input('jadwals');

        // Mengambil semua ID jadwal yang ada di database untuk perbandingan.
        $currentIds = Jadwal::pluck('id')->toArray();

        // Array ini akan menyimpan ID dari semua jadwal yang dikirim dari frontend.
        // Digunakan nanti untuk menentukan jadwal mana yang harus dihapus.
        $updatedIds = [];

        // Iterasi melalui setiap data jadwal yang dikirim dari frontend.
        foreach ($inputJadwals as $item) {
            // Cek apakah jadwal sudah ada di database (berdasarkan ID).
            if (! empty($item['id']) && in_array($item['id'], $currentIds)) {
                // Jika ada, lakukan UPDATE pada jadwal yang ada.
                $jadwal = Jadwal::find($item['id']);
                $jadwal->update([
                    'nama'        => $item['nama'],
                    'jam_mulai'   => $item['jam_mulai'],
                    'jam_selesai' => $item['jam_selesai'],
                    'bahasa'      => $item['bahasa'],
                    'enabled'     => $item['enabled'] ?? true,
                ]);
                $updatedIds[] = $jadwal->id; // Simpan ID yang diupdate.
            } else {
                // Jika tidak ada ID atau ID tidak valid, buat record BARU.
                $jadwal = Jadwal::create([
                    'nama'        => $item['nama'],
                    'jam_mulai'   => $item['jam_mulai'],
                    'jam_selesai' => $item['jam_selesai'],
                    'bahasa'      => $item['bahasa'],
                    'enabled'     => $item['enabled'] ?? true,
                ]);
                $updatedIds[] = $jadwal->id; // Simpan ID yang baru dibuat.
            }
        }

        // Hapus jadwal dari database yang tidak termasuk dalam request (jadwal yang dihapus di frontend).
        Jadwal::whereNotIn('id', $updatedIds)->delete();

        // Kirim response JSON sebagai konfirmasi bahwa operasi berhasil.
        return response()->json(['message' => 'Jadwal berhasil diperbarui']);
    }

    /**
     * Menghapus satu jadwal ibadah berdasarkan ID.
     * Fungsi ini dirancang untuk dipanggil melalui AJAX.
     *
     * @param  int  $id  ID dari jadwal yang akan dihapus.
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Mencari jadwal berdasarkan ID yang diberikan.
        $jadwal = Jadwal::find($id);

        // Jika jadwal tidak ditemukan, kirim response error 404 (Not Found).
        if (! $jadwal) {
            return response()->json(['message' => 'Jadwal tidak ditemukan.'], 404);
        }

        // Menghapus jadwal dari database.
        $jadwal->delete();

        // Kirim response JSON sebagai konfirmasi bahwa jadwal berhasil dihapus.
        return response()->json(['message' => 'Jadwal berhasil dihapus.'], 200);
    }
}
