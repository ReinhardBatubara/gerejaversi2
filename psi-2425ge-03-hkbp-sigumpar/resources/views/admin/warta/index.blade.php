{{-- resources/views/admin/warta/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Warta Jemaat</title>
  <link rel="stylesheet" href="/css/warta.css"> <!-- Gunakan file CSS utama -->
  <style>
    /* Navbar disesuaikan dengan gaya warta.css */
    .navbar {
      display: flex;
      justify-content: center;
      padding: 20px;
      background-color: #fff;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      gap: 40px;
    }

    .navbar a {
      text-decoration: none;
      color: black;
      font-weight: 600;
      font-size: 18px;
      padding: 8px 16px;
      border-radius: 20px;
    }

    .navbar a:hover,
    .navbar a.active {
      background-color: black;
      color: white;
    }

    .action-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }


    /* Gaya Tombol + Add Warta */
    .btn-add {
      background-color: transparent;
      color: black;
      padding: 8px 16px;
      border: 1px solid #999;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s, color 0.3s;
    }

    .btn-add:hover {
      background-color: #0f85ce;
      color: white;
    }

    /* Gaya Tombol Download */
    .btn-download {
      background-color: transparent;
      color: black;
      padding: 6px 12px;
      border: 1px solid #999;

    .btn-add {
      background-color: #4CAF50;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-add:hover {
      background-color: #45a049;
    }

    .btn-download {
      background-color: #000;
      color: white;
      padding: 6px 12px;
      border: none;

      border-radius: 6px;
      cursor: pointer;
      font-size: 0.9rem;
      font-weight: bold;

      transition: background-color 0.3s, color 0.3s;
    }

    .btn-download:hover {
      background-color: #0f85ce;
      color: white;
    }

    /* Gaya Tombol Hapus */

    }

    .btn-download:hover {
      background-color: #555;
    }

    .btn-delete {
      background-color: #c0392b;
      color: white;
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.9rem;
      margin-left: 8px;
    }

    .btn-delete:hover {
      background-color: #a93226;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .see-more {
      margin-top: 20px;
      text-align: right;
    }


    /* Gaya Tombol "Lihat Lebih Banyak" */
    .see-more a {
      background-color: transparent;
      color: black;
      padding: 6px 12px;
      border: 1px solid #999;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s, color 0.3s;
    }

    .see-more a:hover {
      background-color: #0f85ce;
      color: white;

    .see-more a {
      background-color: green;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }

    .see-more a:hover {
      background-color: darkgreen;

    }

    .warta-section {
      max-width: 900px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 1px 5px rgba(0,0,0,0.1);
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
    <div class="action-bar">
      <h2>List Warta Jemaat</h2>
      <a href="{{ route('admin.warta.create') }}">
        <button class="btn-add">+ Add Warta</button>
      </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
      <div style="color: green; margin-bottom: 10px;">
        {{ session('success') }}
      </div>
    @elseif(session('error'))
      <div style="color: red; margin-bottom: 10px;">
        {{ session('error') }}
      </div>
    @endif

    <table>
      <thead>
        <tr>
          <th>Judul</th>
          <th>Download</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($warta as $item)
          <tr>
            <td>{{ $item->judul }}</td>
            <td>
              <a href="{{ route('admin.warta.download', $item->id) }}">
                <button class="btn-download">Download</button>
              </a>
            </td>
            <td>
              <form action="{{ route('admin.warta.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus warta ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="see-more">
      <a href="#">See More..</a>
    </div>
  </main>
</body>
</html>
