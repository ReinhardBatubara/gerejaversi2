<style>
    .navbar nav {
        display: flex;
        justify-content: center;
        padding: 20px;
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
</style>

<header class="navbar">
    <nav>
        <ul>
            <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="/profil gereja" class="{{ Request::is('profil gereja') ? 'active' : '' }}">Profil</a></li>
            <li><a href="/AdminJadwal" class="{{ Request::is('jadwal') ? 'active' : '' }}">Jadwal</a></li>
            <li><a href="/wartaadmin" class="{{ Request::is('warta') ? 'active' : '' }}">Warta</a></li>
            <li><a href="/reservasi" class="{{ Request::is('reservasi') ? 'active' : '' }}">Reservasi</a></li>
        </ul>
    </nav>
</header>
