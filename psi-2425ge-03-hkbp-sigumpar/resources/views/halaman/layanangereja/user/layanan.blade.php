<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Layanan Gereja</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded shadow-md animate-fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-2xl font-bold mb-6 text-gray-900 border-b pb-2">Pilih Layanan Jemaat:</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($layanans as $layanan)
                <div class="border rounded-lg p-5 shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white flex flex-col justify-between">
                    <div>
                        <h4 class="text-xl font-semibold text-blue-700 mb-2">{{ $layanan['nama'] }}</h4>
                        <p class="text-sm font-medium">
                            Status: 
                            @if ($layanan['status'])
                                <span class="text-green-600 font-bold">Tersedia</span>
                            @else
                                <span class="text-red-600 font-bold">Tidak Tersedia</span>
                            @endif
                        </p>
                    </div>

                    @if ($layanan['status'])
                        <a href="{{ route('layanangereja.create', ['jenis' => $layanan['kode']]) }}"
                           class="mt-6 inline-block bg-blue-600 text-white font-semibold px-5 py-3 rounded-lg text-center shadow-md hover:bg-blue-700 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 active:scale-95 transform transition duration-150"
                        >
                            Pilih Layanan
                        </a>
                    @else
                        <button disabled
                            class="mt-6 inline-block bg-gray-400 text-white font-semibold px-5 py-3 rounded-lg cursor-not-allowed select-none opacity-80"
                        >
                            Tidak Tersedia
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <style>
        /* Simple fade-in animation for success message */
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</x-app-layout>
