<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Jemaat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                {{-- Error Handling --}}
                @if ($errors->any())
                    <div class="mb-4">
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 mb-2 rounded-xl bg-red-500 text-white">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('congregations.update', $congregation->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <x-input-label for="tanggal" :value="__('Tanggal')" />
                        <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal"
                            :value="old('tanggal', $congregation->tanggal)" required />
                        <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                    </div>

                    {{-- Jumlah --}}
                    <div class="mb-4">
                        <x-input-label for="jumlah" :value="__('Jumlah')" />
                        <x-text-input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah"
                            :value="old('jumlah', $congregation->jumlah)" required />
                        <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                    </div>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <x-input-label for="gender" :value="__('Gender')" />
                        <select id="gender" name="gender"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Pilih Gender</option>
                            <option value="Laki-laki"
                                {{ old('gender', $congregation->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan"
                                {{ old('gender', $congregation->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    {{-- Kategori Usia --}}
                    <div class="mb-4">
                        <x-input-label for="age_categories" :value="__('Kategori Usia')" />
                        <select id="age_categories" name="age_categories"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">Pilih Kategori Usia</option>
                            <option value="Anak-anak"
                                {{ old('age_categories', $congregation->age_categories) == 'Anak-anak' ? 'selected' : '' }}>
                                Anak-anak</option>
                            <option value="Remaja"
                                {{ old('age_categories', $congregation->age_categories) == 'Remaja' ? 'selected' : '' }}>
                                Remaja</option>
                            <option value="Dewasa"
                                {{ old('age_categories', $congregation->age_categories) == 'Dewasa' ? 'selected' : '' }}>
                                Dewasa</option>
                            <option value="Lansia"
                                {{ old('age_categories', $congregation->age_categories) == 'Lansia' ? 'selected' : '' }}>
                                Lansia</option>
                        </select>
                        <x-input-error :messages="$errors->get('age_categories')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center justify-end mt-6">
                        <button type="submit"
                            class="font-bold py-3 px-6 bg-indigo-700 hover:bg-indigo-800 text-white rounded-full transition">
                            Perbarui
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
