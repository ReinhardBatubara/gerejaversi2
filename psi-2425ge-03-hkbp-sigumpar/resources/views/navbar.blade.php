<style>
    header.navbar {
    width: 100%;
    display: flex;
    justify-content: center;
    box-sizing: border-box;
    position: relative; 
    z-index: 10;
    background-color: white;
}
    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
    }

    .navbar nav {
        display: flex;
        justify-content: center;
        align-items: center;      /* agar ikon juga sejajar vertikal */
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

    /* styling untuk ikon lonceng */
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
    /* badge notifikasi (opsional) */
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
</style>

<header class="navbar">
    <div class="navbar-container">
        <nav>
            <ul>
                <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="/profil-gereja" class="{{ Request::is('profil-gereja') ? 'active' : '' }}">Profil</a></li>
                <li><a href="/jadwal" class="{{ Request::is('jadwal') ? 'active' : '' }}">Jadwal</a></li>
                <li><a href="/warta" class="{{ Request::is('warta') ? 'active' : '' }}">Warta</a></li>
                <li><a href="/reservasi" class="{{ Request::is('reservasi') ? 'active' : '' }}">Layanan Gereja</a></li>
            </ul>

            <!-- ikon notifikasi -->
            <a href="/notifications" class="notification">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2a7 7 0 00-7 7v4.586l-1.293 1.293A1 1 0 005 17h14a1 1 0 00.707-1.707L19 13.586V9a7 7 0 00-7-7zm0 20a2.5 2.5 0 002.45-2h-4.9A2.5 2.5 0 0012 22z"/>
                </svg>
                {{-- <span class="badge">3</span> --}}
            </a>
        </nav>
    </div>
</header>
