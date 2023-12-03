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
