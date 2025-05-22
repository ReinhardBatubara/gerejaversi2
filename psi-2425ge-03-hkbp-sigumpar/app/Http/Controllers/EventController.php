<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return $this->events();
    }

    // Menampilkan semua event
    public function events()
    {
        $events = Event::latest()->get();
        // Pastikan mengirim ke view yang benar sesuai struktur folder kamu
        return view('halaman.berandagereja.admin.dashboard', compact('events'));
    }

    // Form tambah event
    public function create()
    {
        return view('halaman.berandagereja.admin.create');
    }

    // Simpan event baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('events', 'public');

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        // Gunakan route name dengan prefix admin.events.index
        return redirect()->route('admin.events.index')->with('success', 'Data berhasil disimpan.');
    }

    // Form edit event
    public function edit(Event $event)
    {
        return view('halaman.berandagereja.admin.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image_path && \Storage::disk('public')->exists($event->image_path)) {
                \Storage::disk('public')->delete($event->image_path);
            }
            $event->image_path = $request->file('image')->store('events', 'public');
        }

        $event->title = $request->title;
        $event->description = $request->description;
        $event->save();

        // Gunakan route name dengan prefix admin.events.index
        return redirect()->route('admin.events.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus event
    public function destroy(Event $event)
    {
        if ($event->image_path && \Storage::disk('public')->exists($event->image_path)) {
            \Storage::disk('public')->delete($event->image_path);
        }
        $event->delete();

        // Gunakan route name dengan prefix admin.events.index
        return redirect()->route('admin.events.index')->with('success', 'Data berhasil dihapus.');
    }
}
