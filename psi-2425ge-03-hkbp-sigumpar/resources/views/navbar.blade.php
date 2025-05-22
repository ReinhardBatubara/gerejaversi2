<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navbar Example</title>

    <style>
        /* Navbar tetap di atas saat scroll */
.navbar {
    position: fixed;
    top: 0; /* Menempel langsung di atas */
    left: 0;
    right: 0;
    width: 100%;
    background-color: white;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    /* border-radius dan margin dihilangkan agar menempel */
}

/* Tambahkan padding vertikal agar navbar lebih tinggi */
.navbar nav {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 20px; /* Dulu: 20px, sekarang lebih tinggi */
    gap: 40px;
    flex-wrap: wrap;
}

        .navbar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .navbar nav ul li a {
            text-decoration: none;
            color: black;
            font-weight: 600;
            font-size: 18px;
            padding: 8px 16px;
            border-radius: 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar nav ul li a.active,
        .navbar nav ul li a:hover {
            background-color: black;
            color: white;
        }

        /* Styling untuk ikon lonceng */
        .navbar .notification {
            position: relative;
            display: inline-block;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .navbar .notification:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .navbar .notification svg {
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        .navbar .notification .badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background: red;
            color: white;
            font-size: 12px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Tambahkan margin agar konten tidak tertutup navbar */
        body {
            margin: 0;
            padding-top: 80px; /* Sesuaikan dengan tinggi navbar */
        }
    </style>
</head>

<body>
    <header class="navbar">
        <nav>
            <ul>
                <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="/profil" class="{{ Request::is('profil gereja') ? 'active' : '' }}">Profil</a></li>
                <li><a href="/jadwal" class="{{ Request::is('jadwal') ? 'active' : '' }}">Jadwal</a></li>
                <li><a href="/warta" class="{{ Request::is('warta') ? 'active' : '' }}">Warta</a></li>
                <li><a href="/reservasi" class="{{ Request::is('reservasi') ? 'active' : '' }}">Layanan Gereja</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
