{{-- resources/views/admin/warta/store.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Warta Jemaat</title>
  <link rel="stylesheet" href="/css/warta.css">
  <style>
    form {
      max-width: 600px;
      margin: 0 auto;
    }

    input[type="text"], input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <main>
    <h2 style="text-align: center;">Tambah Warta Jemaat</h2>

    <form action="{{ route('admin.warta.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <label>Judul Warta:</label>
      <input type="text" name="judul" required>

      <label>Upload File Warta (PDF):</label>
      <input type="file" name="file" accept=".pdf" required>

      <button type="submit">Simpan</button>
    </form>
  </main>
</body>
</html>
