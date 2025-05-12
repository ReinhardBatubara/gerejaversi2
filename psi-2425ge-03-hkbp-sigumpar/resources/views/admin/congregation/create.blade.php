<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Jemaat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                {{-- Error Handling --}}
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 px-4 mb-4 rounded-3xl bg-red-500 text-white">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('congregations.store') }}">
                    @csrf

                    {{-- Jumlah --}}
                    <div class="mb-4">
                        <x-input-label for="jumlah" :value="__('Jumlah')" />
                        <x-text-input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah"
                            :value="old('jumlah')" required autofocus />
                        <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                    </div>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <x-input-label for="gender" :value="__('Gender')" />
                        <select id="gender" name="gender"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Gender</option>
                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    {{-- Kategori Usia --}}
                    <div class="mb-4">
                        <x-input-label for="age_categories" :value="__('Kategori Usia')" />
                        <select id="age_categories" name="age_categories"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Kategori Usia</option>
                            <option value="Anak-anak" {{ old('age_categories') == 'Anak-anak' ? 'selected' : '' }}>
                                Anak-anak</option>
                            <option value="Remaja" {{ old('age_categories') == 'Remaja' ? 'selected' : '' }}>Remaja
                            </option>
                            <option value="Dewasa" {{ old('age_categories') == 'Dewasa' ? 'selected' : '' }}>Dewasa
                            </option>
                            <option value="Lansia" {{ old('age_categories') == 'Lansia' ? 'selected' : '' }}>Lansia
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('age_categories')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center justify-end mt-6">
                        <button type="submit"
                            class="font-bold py-3 px-6 bg-indigo-700 hover:bg-indigo-800 text-white rounded-full transition">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
