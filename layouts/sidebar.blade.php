<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Hotel.LuuL</div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list"> 
        <li>
            <a href="/home" class="a {{ ($title === "Home | Hotel.LuuL") ? 'open1' : '' }}">
                <i class='bx bx-home {{ ($title === "Home | Hotel.LuuL") ? 'open1' : '' }}'></i>
                <span class="links_name {{ ($title === "Home | Hotel.LuuL") ? 'open1' : '' }}">Home</span>
            </a>
            <span class="tooltip {{ ($title === "Home | Hotel.LuuL") ? 'open1' : '' }}">Home</span>
        </li>
        @if (auth()->user()->role === 'admin')
            <li>
                <a href="/kamar" class="a {{ ($title === "Kamar | Hotel.LuuL") ? 'open1' : '' }}">
                    <i class='bx bx-bed {{ ($title === "Kamar | Hotel.LuuL") ? 'open1' : '' }}'></i>
                    <span class="links_name {{ ($title === "Kamar | Hotel.LuuL") ? 'open1' : '' }}">Kamar</span>
                </a>
                <span class="tooltip {{ ($title === "Kamar | Hotel.LuuL") ? 'open1' : '' }}">Kamar</span>
            </li>
            <li>
                <a href="/fasilitas-kamar" class="a {{ ($title === "Fasilitas Kamar | Hotel.LuuL") ? 'open1' : '' }}">
                    <i class='bx bx-chalkboard {{ ($title === "Fasilitas Kamar | Hotel.LuuL") ? 'open1' : '' }}'></i>
                    <span class="links_name {{ ($title === "Fasilitas Kamar | Hotel.LuuL") ? 'open1' : '' }}">Fasilitas Kamar</span>
                </a>
                <span class="tooltip {{ ($title === "Fasilitas Kamar | Hotel.LuuL") ? 'open1' : '' }}">Fasilitas Kamar</span>
            </li>
            <li>
                <a href="/fasilitas-hotel" class="a {{ ($title === "Fasilitas Hotel | Hotel.LuuL") ? 'open1' : '' }}">
                    <i class='bx bx-hotel {{ ($title === "Fasilitas Hotel | Hotel.LuuL") ? 'open1' : '' }}'></i>
                    <span class="links_name {{ ($title === "Fasilitas Hotel | Hotel.LuuL") ? 'open1' : '' }}">Fasilitas Hotel</span>
                </a>
                <span class="tooltip {{ ($title === "Fasilitas Hotel | Hotel.LuuL") ? 'open1' : '' }}">Fasilitas Hotel</span>
            </li>
        @endif
        @if (auth()->user()->role === 'petugas' || auth()->user()->role === 'admin')
        @endif
        <li class="profile">
            <form action="/logout" method="POST">
                @csrf
                <button class="btn" type="submit">
                    <div class="profile-details">
                        <div class="name_job">
                            <div class="name"></div>
                        </div>
                    </div>
                    <div class="name"><p class="text-end me-3 mt-1">Logout<p></div>
                        <i class='bx bx-log-out' id="log_out" href="/logout"></i>
                </button>
            </form>
        </li>
    </ul>
</div>