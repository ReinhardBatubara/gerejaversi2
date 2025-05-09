<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Warta Jemaat</title>
  <link rel="stylesheet" href="/css/warta.css">
  <style>
    .pdf-viewer {
      width: 100%;
      height: 600px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }

    button {
      background-color: transparent;
      color: black;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 14px;
      padding: 6px 12px;
      border: 1px solid #999;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
    }

    button:hover {
      background-color: #0f85ce;
      color: white;
    }

    .see-more {
      margin-top: 20px;
      text-align: center;
    }

    .hidden-row {
      display: none;
    }

    /* Style untuk popup */
    #popup-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }

    #popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 20px;
      border-radius: 8px;
      z-index: 1000;
      width: 80%;
      max-width: 800px;
    }

    .popup-content {
      max-height: 400px;
      overflow-y: auto;
    }

    .close {
      position: absolute;
      top: 10px;
      right: 15px;
      background: none;
      border: none;
      font-size: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  {{-- NAVBAR --}}
  @include('navbar') {{-- Cukup satu navbar di sini --}}

  {{-- KONTEN UTAMA --}}
  <main class="warta-section" style="padding: 20px;">
    <h2>Warta Jemaat Minggu Ini</h2>

    {{-- Tampilkan Warta Terbaru --}}
    @if($latestWarta)
      <iframe id="pdfViewer" class="pdf-viewer" src="{{ asset('storage/' . $latestWarta->file_path) }}" type="application/pdf"></iframe>
    @else
      <p>Tidak ada warta terbaru.</p>
    @endif

    <h3>Daftar Warta Jemaat</h3>
    <table>
      <thead>
        <tr>
          <th>Judul</th>
          <th>Download</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($wartas as $index => $warta)
          <tr class="{{ $index >= 5 ? 'hidden-row' : '' }}">
            <td>{{ $warta->judul }}</td>
            <td>
              <a href="{{ asset('storage/' . $warta->file_path) }}" download>
                <button>Download</button>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Tombol Lihat Lebih Banyak --}}
    <div class="see-more">
      <button onclick="showMore(this)">Lihat Lebih Banyak..</button>
    </div>
  </main>

  {{-- POPUP untuk Warta Tambahan --}}
  <div id="popup-overlay" onclick="closePopup()"></div>
  <div id="popup">
    <button class="close" onclick="closePopup()">×</button>
    <div class="popup-content">
      <h3>Warta Jemaat</h3>
      <table>
        <thead>
          <tr>
            <th>Judul</th>
            <th>Download</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($wartas->slice(5) as $warta)
            <tr>
              <td>{{ $warta->judul }}</td>
              <td>
                <a href="{{ asset('storage/' . $warta->file_path) }}" download>
                  <button>Download</button>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- SCRIPT --}}
  <script>
    function showPDF(fileUrl) {
      const viewer = document.getElementById('pdfViewer');
      viewer.src = fileUrl;
    }

    function showMore(button) {
      const hiddenRows = document.querySelectorAll('.hidden-row');
      hiddenRows.forEach(row => row.style.display = 'table-row');
      button.style.display = 'none';
    }

    function openPopup() {
      document.getElementById('popup').style.display = 'block';
      document.getElementById('popup-overlay').style.display = 'block';
    }

    function closePopup() {
      document.getElementById('popup').style.display = 'none';
      document.getElementById('popup-overlay').style.display = 'none';
    }
  </script>

</body>
</html>
