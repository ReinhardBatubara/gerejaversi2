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
    }
  
    .see-more {
      margin-top: 20px;
      text-align: center;
    }
  
    .hidden-row {
      display: none;
    }
  </style>  
</head>
<body>


  {{-- NAVBAR --}}
  @include('navbar') {{-- Pastikan hanya ada satu navbar di sini --}}

  {{-- KONTEN UTAMA --}}
  <main class="warta-section" style="padding: 20px;">
    <h2>Warta Jemaat Minggu Ini</h2>

    {{-- Tampilkan Warta Terbaru --}}
    @if($latestWarta)
      <iframe id="pdfViewer" class="pdf-viewer" src="{{ asset('storage/' . $latestWarta->file_path) }}" type="application/pdf"></iframe>
    @else
      <p>Tidak ada warta terbaru.</p>
    @endif

@include('navbar')


    <h3>Daftar Warta Jemaat</h3>
    <table>
      <thead>
        <tr>
          <th>Judul</th>
          <th>Download</th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td>Warta 23 Maret 2025</td>
          <td>
            <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
              Download
            </a>
          </td>
        </tr>
        <tr>
          <td>Warta 16 Maret 2025</td>
          <td>
            <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
              Download
            </a>
          </td>
        </tr>
        <tr>
          <td>Warta 09 Maret 2025</td>
          <td>
            <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
              Download
            </a>
          </td>
        </tr>
        <tr>
          <td>Warta 02 Maret 2025</td>
          <td>
            <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
              Download
            </a>
          </td>
        </tr>
        <tr>
          <td>Warta 23 Februari 2025</td>
          <td>
            <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
              Download
            </a>
          </td>
        </tr>
        <tr>
          <td>Warta 16 Februari 2025</td>
          <td>
            <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
              Download
            </a>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Tombol untuk membuka popup "See More" -->
    <div class="see-more">
      <a href="#" onclick="openPopup()">See More..</a>
    </div>
  </main>

  <!-- Overlay dan Popup -->
  <div id="popup-overlay" onclick="closePopup()"></div>
  <div id="popup">
    <button class="close" onclick="closePopup()">X</button>
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
          <tr>
            <td>Warta 09 Februari 2025</td>
            <td>
              <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
                Download
              </a>
            </td>
          </tr>
          <tr>
            <td>Warta 02 Februari 2025</td>
            <td>
              <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
                Download
              </a>
            </td>
          </tr>
          <tr>
            <td>Warta 26 Januari 2025</td>
            <td>
              <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
                Download
              </a>
            </td>
          </tr>
          <tr>
            <td>Warta 19 Januari 2025</td>
            <td>
              <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
                Download
              </a>
            </td>
          </tr>
          <tr>
            <td>Warta 12 Januari 2025</td>
            <td>
              <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
                Download
              </a>
            </td>
          </tr>
          <tr>
            <td>Warta 05 Januari 2025</td>
            <td>
              <a href="{{ asset('pdf/23 MARET 2025 y (2).pdf') }}" class="btn-download" download>
                Download
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function openPopup() {
      document.getElementById("popup").style.display = "block";
      document.getElementById("popup-overlay").style.display = "block";
    }

    function closePopup() {
      document.getElementById("popup").style.display = "none";
      document.getElementById("popup-overlay").style.display = "none";

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

    <div class="see-more">
      <button onclick="showMore(this)">Lihat Lebih Banyak..</button>
    </div>
  </main>

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
  </script>

</body>
</html>
