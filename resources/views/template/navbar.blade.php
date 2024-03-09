<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('dist') }}/assets/images/logo/logo3.png"  style="width: 200px; height: 43px;"alt="Logo"
                            srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item">
                    <a href="/home" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role == 'admin')


                <li class="sidebar-item  ">
                    <a href="/maps" class='sidebar-link'>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Maps</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="/instansi" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Instansi</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="/teknisi" class='sidebar-link'>
                        <i class="bi bi-tools"></i>
                        <span>Teknisi</span>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role == 'teknisi' || auth()->user()->role == 'admin')

                <li class="sidebar-item  ">
                    <a href="/konfirmasi-pengaduan" class='sidebar-link'>
                        <i class="bi bi-exclamation-square-fill"></i>
                        <span>Pengaduan</span>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role == 'admin')
               
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="/laporan">Pengaduan Selesai</a>
                        </li>
                       
                    </ul>
                </li>
                <li class="sidebar-item  ">
                    <a href="/api" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>A P I</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="/mikrotik" class='sidebar-link'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-router-fill" viewBox="0 0 16 16">
                            <path d="M5.525 3.025a3.5 3.5 0 0 1 4.95 0 .5.5 0 1 0 .707-.707 4.5 4.5 0 0 0-6.364 0 .5.5 0 0 0 .707.707"/>
                            <path d="M6.94 4.44a1.5 1.5 0 0 1 2.12 0 .5.5 0 0 0 .708-.708 2.5 2.5 0 0 0-3.536 0 .5.5 0 0 0 .707.707Z"/>
                            <path d="M2.974 2.342a.5.5 0 1 0-.948.316L3.806 8H1.5A1.5 1.5 0 0 0 0 9.5v2A1.5 1.5 0 0 0 1.5 13H2a.5.5 0 0 0 .5.5h2A.5.5 0 0 0 5 13h6a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5h.5a1.5 1.5 0 0 0 1.5-1.5v-2A1.5 1.5 0 0 0 14.5 8h-2.306l1.78-5.342a.5.5 0 1 0-.948-.316L11.14 8H4.86zM2.5 11a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m4.5-.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2.5.5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m1.5-.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0"/>
                            <path d="M8.5 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                          </svg>                        <span>Mikrotik</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-item  ">
                    <a href="/login/logout" class='sidebar-link'>
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
