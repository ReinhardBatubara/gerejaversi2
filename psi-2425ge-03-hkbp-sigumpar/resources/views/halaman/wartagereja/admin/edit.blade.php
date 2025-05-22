<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Warta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('warta.update', $warta->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="judul" :value="__('Name')" />
                        <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul"
                            value="{{ old('judul', $warta->judul) }}" required autofocus autocomplete="judul" />
                        <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="file_path" :value="__('File')" />
                        @if ($warta->file_path)
                            <a href="{{ asset('storage/wartas/' . $warta->file_path) }}" target="_blank"
                                class="block mb-2 text-blue-600 underline">
                                Lihat File Sebelumnya
                            </a>
                        @endif
                        <x-text-input id="file_path" class="block mt-1 w-full" type="file" name="file_path" autofocus
                            autocomplete="file_path" />
                        <x-input-error :messages="$errors->get('file_path')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Warta
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
