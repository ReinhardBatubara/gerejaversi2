<?php

namespace App\Http\Controllers;

use App\Models\Warta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Controller WartaController mengelola semua aksi terkait warta gereja.
 * Termasuk menampilkan, membuat, mengubah, dan menghapus warta.
 */
class WartaController extends Controller
{
    /**
     * Menampilkan halaman utama warta gereja.
     * Menampilkan daftar semua warta dan warta terbaru.
     *
     * @return View
     */
    public function index(): View
    {
        // Mengambil semua data warta, diurutkan dari yang terbaru.
        $wartas = Warta::orderBy('created_at', 'desc')->get();

        // Mengambil satu warta terbaru untuk ditampilkan secara khusus.
        $latestWarta = $wartas->first();

        // Memeriksa apakah pengguna adalah admin untuk menentukan view yang akan ditampilkan.
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            // Jika admin, tampilkan view admin.
            return view('halaman.wartagereja.admin.warta', [
                'warta' => $wartas, // Menggunakan nama variabel yang konsisten
                'latestWarta' => $latestWarta,
            ]);
        }

        // Jika bukan admin, tampilkan view untuk pengguna biasa.
        return view('halaman.wartagereja.user.warta', compact('wartas', 'latestWarta'));
    }

    /**
     * Menampilkan form untuk membuat warta baru.
     * Hanya bisa diakses oleh admin.
     *
     * @return View
     */
    public function create(): View
    {
        return view('halaman.wartagereja.admin.create');
    }

    /**
     * Menyimpan warta baru ke dalam database.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dari form.
        $request->validate([
            'judul'     => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Hanya menerima PDF & Word, maks 10MB.
        ]);

        // Menggunakan transaksi database untuk memastikan semua operasi berhasil atau tidak sama sekali.
        DB::transaction(function () use ($request) {
            $data = [
                'judul' => $request->input('judul'),
                'file_path' => null,
            ];

            // Jika ada file yang diunggah, simpan file tersebut dan catat path-nya.
            if ($request->hasFile('file_path')) {
                $filePath = $request->file('file_path')->store('wartas', 'public');
                $data['file_path'] = $filePath;
            }

            // Membuat record baru di tabel warta.
            Warta::create($data);
        });

        // Arahkan kembali ke halaman index warta setelah berhasil.
        return redirect()->route('warta.index')->with('success', 'Warta berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit warta yang sudah ada.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id)
    {
        // Mengambil data warta berdasarkan ID, atau gagal jika tidak ditemukan.
        $warta = Warta::findOrFail($id);

        // TODO: Periksa kembali logika ini. Seharusnya hanya admin yang bisa mengakses.
        // Saat ini, jika pengguna memiliki role 'user', mereka akan diarahkan kembali.
        // Sebaiknya menggunakan middleware untuk proteksi route ini.
        if (Auth::user()->hasRole('user')) {
            return redirect()->route('warta.index');
        }

        // Tampilkan halaman edit dengan data warta yang akan diubah.
        return view('halaman.wartagereja.admin.edit', compact('warta'));
    }

    /**
     * Memperbarui data warta di dalam database.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input dari form.
        $request->validate([
            'judul'     => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048', // Memperbolehkan gambar dan pdf
        ]);

        // Cari warta yang akan diupdate.
        $warta = Warta::findOrFail($id);

        // Update judul warta.
        $warta->judul = $request->input('judul');

        // Jika ada file baru yang diunggah, ganti file lama.
        if ($request->hasFile('file_path')) {
            // Sebaiknya ada logika untuk menghapus file lama dari storage.
            $filePath = $request->file('file_path')->store('wartas', 'public');
            $warta->file_path = $filePath;
        }

        // Simpan perubahan ke database.
        $warta->save();

        // Arahkan kembali ke halaman index warta.
        return redirect()->route('warta.index')->with('success', 'Warta berhasil diperbarui.');
    }

    /**
     * Menghapus warta dari database.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Cari warta yang akan dihapus.
        $warta = Warta::findOrFail($id);

        // Hapus record dari database.
        // TODO: Tambahkan logika untuk menghapus file terkait dari storage.
        $warta->delete();

        // Arahkan kembali ke halaman index warta.
        return redirect()->route('warta.index')->with('success', 'Warta berhasil dihapus.');
    }
}
