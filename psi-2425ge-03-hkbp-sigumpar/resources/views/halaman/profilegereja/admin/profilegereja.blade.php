<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Gereja') }}
        </h2>
    </x-slot>

    

    <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Gereja</title>
  <link rel="stylesheet" href="/css/profil gereja.css">
</head>
<body>
    <section class="section">
  <div class="bg-circle-mid"></div> <!-- Tambahan lingkaran tengah bawah -->

  <div class="content-container flex flex-col md:flex-row items-center md:items-start gap-8">
    <div class="content md:w-1/2">
      <h2 class="text-2xl font-semibold mb-4">Sejarah Gereja</h2>
      <p class="mb-4">{{ $profileGereja->sejarah }}</p>

    </div>

    <div class="image-wrapper text-center md:w-1/2 relative">
      <div class="circle-bg absolute inset-0 rounded-full bg-gray-100"></div>
      <img src="/images/hkbp sigumpar.jpg" alt="Gereja HKBP Sigumpar"
           class="relative rounded-full shadow-lg object-cover w-80 h-80 mx-auto border-4 border-gray-300" />
    </div>
  </div>
</section>
      <section class="wave-section">
        <div class="content-container">
          <img src="/images/yesus.jpeg" alt="Yesus" class="img-rounded">
          <div class="visi-misi w-full md:w-1/2">
                <h3 class="text-2xl font-semibold mb-4">VISI</h3>
                <p class="mb-4 text-lg" style="white-space: pre-wrap;">{{ $profileGereja->visi }}</p>

                <h3 class="text-2xl font-semibold mb-4">MISI</h3>
                <ul class="list-disc pl-5">
                    <li class="text-lg" style="white-space: pre-wrap;">{{ $profileGereja->misi }}</li>
                </ul>
            </div>
        </div>
      </section>


        <section class="nommensen-section">
            <div class="image-row">
              <img src="/images/makam 1.jpeg" alt="Gambar 1">
              <img src="/images/makam 2.jpeg" alt="Gambar 2">
              <img src="/images/makam3.jpeg" alt="Gambar 3">
            </div>

      <div class="content-box">
        <h2 class="grave-title">MAKAM MISIONARIS DR. I.L. NOMMENSEN</h2>
        <p>{{ $profileGereja->makam }}</p>
</div>
    </section>

            <!-- Tombol Edit di bawah -->
            <div class="mt-8 flex justify-center">
                <a href="{{ route('profilegereja.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    Edit Profile Gereja
                </a>
            </div>


</x-app-layout>
