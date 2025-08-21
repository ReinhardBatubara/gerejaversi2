<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\LokasiGereja;
use App\Models\ProfilePendeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Controller EventController bertanggung jawab untuk mengelola data acara atau event gereja.
 * Ini mencakup semua operasi CRUD (Create, Read, Update, Delete) untuk event.
 */
class EventController extends Controller
{
    /**
     * Metode utama yang dipanggil untuk resource 'events'.
     * Metode ini hanya meneruskan panggilan ke metode events().
     *
     * @return View
     */
    public function index(): View
    {
        return $this->events();
    }

    /**
     * Menampilkan halaman dashboard yang berisi daftar event.
     * Halaman yang ditampilkan (admin atau user) tergantung pada peran pengguna.
     *
     * @return View
     */
    public function events(): View
    {
        // Mengambil semua event, diurutkan dari yang terbaru.
        $events = Event::latest()->get();
        $user = auth()->user();

        // Mengambil data profil pendeta dan lokasi gereja untuk ditampilkan di dashboard.
        $profile = ProfilePendeta::first();
        $location = LokasiGereja::first();

        // Tentukan view berdasarkan peran pengguna.
        if ($user && $user->role === 'admin') {
            // View untuk admin.
            return view('halaman.berandagereja.admin.dashboard', compact('events', 'profile', 'location'));
        } else {
            // View untuk pengguna biasa.
            return view('halaman.berandagereja.user.dashboard', compact('events', 'profile', 'location'));
        }
    }

    /**
     * Menampilkan form untuk membuat event baru.
     *
     * @return View
     */
    public function create(): View
    {
        return view('halaman.berandagereja.admin.create');
    }

    /**
     * Menyimpan event baru ke dalam database.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data yang masuk.
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|max:2048', // Gambar wajib ada, maks 2MB.
        ]);

        // Simpan file gambar yang diunggah ke direktori 'events' di dalam 'storage/app/public'.
        $imagePath = $request->file('image')->store('events', 'public');

        // Buat record event baru di database.
        Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image_path'  => $imagePath,
        ]);

        // Arahkan kembali ke halaman index event admin dengan pesan sukses.
        return redirect()->route('admin.events.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Menampilkan form untuk mengedit event yang sudah ada.
     * Laravel secara otomatis melakukan route-model binding untuk menemukan $event.
     *
     * @param  Event  $event
     * @return View
     */
    public function edit(Event $event): View
    {
        return view('halaman.berandagereja.admin.edit', compact('event'));
    }

    /**
     * Memperbarui data event di dalam database.
     *
     * @param  Request  $request
     * @param  Event  $event
     * @return RedirectResponse
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        // Validasi data yang masuk. Gambar tidak wajib saat update.
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        // Jika ada file gambar baru yang diunggah.
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage untuk menghemat ruang.
            if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
                Storage::disk('public')->delete($event->image_path);
            }
            // Simpan gambar baru dan perbarui path di database.
            $event->image_path = $request->file('image')->store('events', 'public');
        }

        // Perbarui judul dan deskripsi.
        $event->title = $request->title;
        $event->description = $request->description;
        $event->save();

        // Arahkan kembali ke halaman index event admin dengan pesan sukses.
        return redirect()->route('admin.events.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Menghapus event dari database.
     *
     * @param  Event  $event
     * @return RedirectResponse
     */
    public function destroy(Event $event): RedirectResponse
    {
        // Hapus file gambar terkait dari storage sebelum menghapus record database.
        if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
            Storage::disk('public')->delete($event->image_path);
        }

        // Hapus record event dari database.
        $event->delete();

        // Arahkan kembali ke halaman index event admin dengan pesan sukses.
        return redirect()->route('admin.events.index')->with('success', 'Data berhasil dihapus.');
    }
}
