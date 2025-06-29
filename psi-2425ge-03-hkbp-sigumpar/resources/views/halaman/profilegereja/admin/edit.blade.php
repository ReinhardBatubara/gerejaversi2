<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile Gereja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-10 shadow-xl sm:rounded-lg border border-gray-200 rounded-lg">

                {{-- Error Handling --}}
                @if ($errors->any())
                    <div class="mb-4">
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 mb-4 rounded-md bg-red-500 text-white text-sm">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('profilegereja.update', $profileGereja->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Sejarah --}}
                    <div class="mb-6">
                        <x-input-label for="sejarah" :value="__('Sejarah')" />
                        <textarea id="sejarah" class="block mt-1 w-full px-6 py-4 rounded-md shadow-md border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200" name="sejarah" required>{{ old('sejarah', $profileGereja->sejarah) }}</textarea>
                        <x-input-error :messages="$errors->get('sejarah')" class="mt-2 text-sm text-red-600" />
                    </div>

                    {{-- Visi --}}
                    <div class="mb-6">
                        <x-input-label for="visi" :value="__('Visi')" />
                        <textarea id="visi" class="block mt-1 w-full px-6 py-4 rounded-md shadow-md border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200" name="visi" required>{{ old('visi', $profileGereja->visi) }}</textarea>
                        <x-input-error :messages="$errors->get('visi')" class="mt-2 text-sm text-red-600" />
                    </div>

                    {{-- Misi --}}
                    <div class="mb-6">
                        <x-input-label for="misi" :value="__('Misi')" />
                        <textarea id="misi" class="block mt-1 w-full px-6 py-4 rounded-md shadow-md border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200" name="misi" required>{{ old('misi', $profileGereja->misi) }}</textarea>
                        <x-input-error :messages="$errors->get('misi')" class="mt-2 text-sm text-red-600" />
                    </div>

                    {{-- Makam --}}
                    <div class="mb-6">
                        <x-input-label for="makam" :value="__('Makam')" />
                        <textarea id="makam" class="block mt-1 w-full px-6 py-4 rounded-md shadow-md border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200" name="makam" required>{{ old('makam', $profileGereja->makam) }}</textarea>
                        <x-input-error :messages="$errors->get('makam')" class="mt-2 text-sm text-red-600" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center justify-center mt-8">
                        <button type="submit"
                            class="font-semibold py-4 px-8 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-500">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Display the submitted text (with new lines and spaces maintained) --}}
    <div class="mt-12 max-w-4xl mx-auto">
        <h3 class="text-xl font-semibold">Tampilan Profile Gereja:</h3>

        {{-- Sejarah --}}
        <div class="mb-6">
            <x-input-label for="display-sejarah" :value="__('Sejarah')" />
            <div style="white-space: pre-wrap; background-color: #f3f4f6; padding: 16px; border-radius: 8px; border: 1px solid #d1d5db;">
                {{ $profileGereja->sejarah }}
            </div>
        </div>

        {{-- Visi --}}
        <div class="mb-6">
            <x-input-label for="display-visi" :value="__('Visi')" />
            <div style="white-space: pre-wrap; background-color: #f3f4f6; padding: 16px; border-radius: 8px; border: 1px solid #d1d5db;">
                {{ $profileGereja->visi }}
            </div>
        </div>

        {{-- Misi --}}
        <div class="mb-6">
            <x-input-label for="display-misi" :value="__('Misi')" />
            <div style="white-space: pre-wrap; background-color: #f3f4f6; padding: 16px; border-radius: 8px; border: 1px solid #d1d5db;">
                {{ $profileGereja->misi }}
            </div>
        </div>

        {{-- Makam --}}
        <div class="mb-6">
            <x-input-label for="display-makam" :value="__('Makam')" />
            <div style="white-space: pre-wrap; background-color: #f3f4f6; padding: 16px; border-radius: 8px; border: 1px solid #d1d5db;">
                {{ $profileGereja->makam }}
            </div>
        </div>
    </div>
</x-app-layout>
