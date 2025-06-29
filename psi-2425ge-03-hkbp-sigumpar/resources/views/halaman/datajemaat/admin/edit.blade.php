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
                <form method="POST" action="{{ route('datajemaat.update', $dataJemaat->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <x-input-label for="tanggal" :value="__('Tanggal')" />
                        <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal"
                            :value="old('tanggal', $dataJemaat->tanggal)" required onchange="updateWeek()" />
                        <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                    </div>

                    {{-- Minggu --}}
                    <div class="mb-4">
                        <x-input-label for="week" :value="__('Minggu')" />
                        <x-text-input id="week" class="block mt-1 w-full" type="number" name="week"
                            :value="old('week', $dataJemaat->week)" readonly required />
                        <x-input-error :messages="$errors->get('week')" class="mt-2" />
                    </div>

                    {{-- Jumlah Jemaat per Kategori Usia --}}
                    <div class="mb-4">
                        <x-input-label for="jumlah_anak" :value="__('Jumlah Anak-anak')" />
                        <x-text-input id="jumlah_anak" class="block mt-1 w-full" type="number" name="jumlah_anak"
                            :value="old('jumlah_anak', $dataJemaat->jumlah_anak)" required />
                        <x-input-error :messages="$errors->get('jumlah_anak')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="jumlah_remaja" :value="__('Jumlah Remaja')" />
                        <x-text-input id="jumlah_remaja" class="block mt-1 w-full" type="number" name="jumlah_remaja"
                            :value="old('jumlah_remaja', $dataJemaat->jumlah_remaja)" required />
                        <x-input-error :messages="$errors->get('jumlah_remaja')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="jumlah_dewasa" :value="__('Jumlah Dewasa')" />
                        <x-text-input id="jumlah_dewasa" class="block mt-1 w-full" type="number" name="jumlah_dewasa"
                            :value="old('jumlah_dewasa', $dataJemaat->jumlah_dewasa)" required />
                        <x-input-error :messages="$errors->get('jumlah_dewasa')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="jumlah_lansia" :value="__('Jumlah Lansia')" />
                        <x-text-input id="jumlah_lansia" class="block mt-1 w-full" type="number" name="jumlah_lansia"
                            :value="old('jumlah_lansia', $dataJemaat->jumlah_lansia)" required />
                        <x-input-error :messages="$errors->get('jumlah_lansia')" class="mt-2" />
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

    <script>
        // Function to update the week based on the selected date
        function updateWeek() {
            const dateInput = document.getElementById('tanggal').value;
            if (dateInput) {
                const date = new Date(dateInput);
                const weekNumber = getWeekNumber(date);
                document.getElementById('week').value = weekNumber;
            }
        }

        // Function to get the week number from a given date
        function getWeekNumber(date) {
            const startDate = new Date(date.getFullYear(), 0, 1);
            const days = Math.floor((date - startDate) / (24 * 60 * 60 * 1000));
            return Math.ceil((days + startDate.getDay() + 1) / 7);
        }
    </script>
</x-app-layout>
