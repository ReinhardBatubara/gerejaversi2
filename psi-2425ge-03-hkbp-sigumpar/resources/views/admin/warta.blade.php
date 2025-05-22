<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Warta Jemaat</title>
  <link rel="stylesheet" href="/css/warta.css">
  <style>
    /* Styling khusus tombol Add Warta */
    .action-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }

    .btn-add {
      background-color: #ffffff; 
      background-color: #4CAF50; /* Warna hijau */
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-add:hover {
      background-color: #45a049;
      background-color: #45a049; /* Hijau lebih gelap saat hover */
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <ul>
      <li><a href="#">Beranda</a></li>
      <li><a href="#">Profil</a></li>
      <li><a href="#">Jadwal</a></li>
      <li><a href="#" class="active">Warta</a></li>
      <li><a href="#">Reservasi</a></li>
    </ul>
  </nav>

  <main class="warta-section">
    <!-- Judul dan Tombol di satu baris -->
    <div class="action-bar">
      <h2>List Warta Jemaat</h2>
      <button class="btn-add">+ Add Warta</button>
    </div>

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
          <td><button class="btn-download">Download</button></td>
        </tr>
        <tr>
          <td>Warta 16 Maret 2025</td>
          <td><button class="btn-download">Download</button></td>
        </tr>
        <tr>
          <td>Warta 09 Maret 2025</td>
          <td><button class="btn-download">Download</button></td>
        </tr>
        <tr>
          <td>Warta 02 Maret 2025</td>
          <td><button class="btn-download">Download</button></td>
        </tr>
        <tr>
          <td>Warta 23 Februari 2025</td>
          <td><button class="btn-download">Download</button></td>
        </tr>
        <tr>
          <td>Warta 16 Februari 2025</td>
          <td><button class="btn-download">Download</button></td>
        </tr>
      </tbody>
    </table>

    <div class="see-more">
      <a href="#">See More..</a>
    </div>
  </main>
</body>
</html>
