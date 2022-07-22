<div class="sticky" style="margin-bottom: -74px;">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar ps ps--active-y sidemenu-scroll">
        <div class="side-header"> <a class="header-brand1" href="{{route('main')}}"> <img
                    src="{{asset('assets/images/logo-stt.jpeg')}}" class="header-brand-img desktop-logo"
                    alt="logo"> <img src="{{asset('assets/images/logo.jpeg')}}"
                    class="header-brand-img toggle-logo" alt="logo"> <img
                    src="{{asset('assets/images/logo-stt.jpeg')}}" class="header-brand-img light-logo"
                    alt="logo"> <img src="{{asset('assets/images/logo-stt.jpeg')}}"
                    class="header-brand-img light-logo1" style="width: 100px" alt="logo"> </a> <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                    </path>
                </svg></div>
            <ul class="side-menu" style="margin-right: 0px; margin-left: 0px;">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide"> 
                    <a class="side-menu__item has-link {{Request::is('dashboard') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('dashboard.index')}}"><i class="side-menu__icon fe fe-home"></i><span
                            class="side-menu__label">Dashboard</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('anggota') ? 'active'  : '' }}" data-bs-toggle="slide"
                        href="{{route('anggota.index')}}"><i class="side-menu__icon fe fe-users"></i><span
                            class="side-menu__label">Anggota</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('kegiatan') ? 'active'  : '' }}" data-bs-toggle="slide"
                        href="{{route('kegiatan.index')}}"><i class="side-menu__icon fe fe-layers"></i><span
                            class="side-menu__label">Kegiatan</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('pengumuman') ? 'active'  : '' }}" data-bs-toggle="slide"
                        href="{{route('pengumuman.index')}}"><i class="side-menu__icon fe fe-bell"></i><span
                            class="side-menu__label">Pengumuman</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('rapat') ? 'active'  : '' }}" data-bs-toggle="slide"
                        href="{{route('rapat.index')}}"><i class="side-menu__icon fe fe-file-text"></i><span
                            class="side-menu__label">Rapat</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('keuangan') ? 'active'  : '' }}" data-bs-toggle="slide"
                        href="{{route('keuangan.index')}}"><i class="side-menu__icon fe fe-dollar-sign"></i><span
                            class="side-menu__label">Keuangan</span>
                    </a>
                    @can('admin')
                    <a class="side-menu__item has-link {{Request::is('pemilu') ? 'active'  : '' }}" data-bs-toggle="slide"
                        href="{{route('pemilu.index')}}"><i class="side-menu__icon fe fe-info"></i><span
                            class="side-menu__label">Pemilu</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('kandidat') ? 'active'  : '' }}" data-bs-toggle="slide"
                        href="{{route('kandidat.index')}}"><i class="side-menu__icon fe fe-user-plus"></i><span
                            class="side-menu__label">Kandidat</span>
                    </a>
                    @endcan
                    <a class="side-menu__item has-link {{Request::is('voting') ? 'active'  : '' }}" data-bs-toggle="slide"
                        href="{{route('voting.index')}}"><i class="side-menu__icon fe fe-user-check"></i><span
                            class="side-menu__label">Voting</span>
                    </a>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                    </path>
                </svg></div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: -558px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 558px; height: 969px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 314px; height: 544px;"></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>