<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pemberitahuan</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">

        @if($notifications->isEmpty())
            <p class="text-gray-600">Belum ada pemberitahuan.</p>
        @else
            <ul>
                @foreach($notifications as $notification)
                    <li class="mb-4 p-4 border rounded {{ $notification->is_read ? 'bg-gray-100' : 'bg-blue-100' }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <strong>{{ $notification->title }}</strong>
                                <p>{{ $notification->message }}</p>
                                <small class="text-gray-600">{{ $notification->created_at->diffForHumans() }}</small>

                                <!-- Jika ada file, tampilkan link download -->
                                @if ($notification->files)
                                    @php
                                        $files = json_decode($notification->files, true); 
                                    @endphp
                                    @foreach ($files as $key => $file)
                                        @if(strpos($key, 'surat_') !== false && $file)
                                            <div class="mt-2">
                                                <a href="{{ Storage::url($file) }}" target="_blank" class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                                                    Download {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div>
                                {{-- Status layanan --}}
                                <p>Status: 
                                    @php
                                        $status = $notification->status ?? 'menunggu'; // default menunggu kalau belum ada status
                                    @endphp

                                    @if ($status == 'menunggu')
                                        <span class="text-yellow-600 font-semibold">Menunggu</span>
                                    @elseif ($status == 'diterima')
                                        <span class="text-green-600 font-semibold">Diterima</span>
                                    @elseif ($status == 'ditolak')
                                        <span class="text-red-600 font-semibold">Ditolak</span>
                                    @else
                                        <span>{{ ucfirst($status) }}</span>
                                    @endif
                                </p>

                                @if ($status == 'menunggu')
                                    {{-- Tombol Terima --}}
                                    <form action="{{ route('layanan.updateStatus', $notification->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit" class="text-sm text-green-600 hover:underline">Terima</button>
                                    </form>

                                    {{-- Tombol Tolak --}}
                                    <form action="{{ route('layanan.updateStatus', $notification->id) }}" method="POST" style="display:inline-block; margin-left:10px;">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="text-sm text-red-600 hover:underline">Tolak</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
