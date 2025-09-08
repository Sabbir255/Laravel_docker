
@php
    $route = Route::current()->getName();
@endphp
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-info pb-0">Banner</div>
                <a class="nav-link py-1 {{ $route=="banner_list" ? "text-danger" : "" }} " href="{{ route('banner_list') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Banner List
                </a>

                <a class="nav-link py-1  {{ $route=="banner_create" ? "text-danger" : "" }} " href="{{ route('banner_create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Banner Create
                </a>


                <div class="sb-sidenav-menu-heading text-info pb-0 ">Career Courses</div>
                <a class="nav-link py-1 {{ $route=="career_list" ? "text-danger" : "" }}  " href="{{ route('career_list') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                     Courses List
                </a>

                <a class="nav-link py-1 {{ $route=="career_create" ? "text-danger" : "" }}  " href="{{ route('career_create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                     Courses Create
                </a>



                <div class="sb-sidenav-menu-heading text-info pb-0 ">What We Do</div>
                <a class="nav-link py-1 {{ $route=='wedo_list' ? "text-danger" : "" }}  " href="{{ route('wedo_list') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                      List
                </a>

                <a class="nav-link py-1 {{ $route=='wedo_create' ? "text-danger" : "" }}  " href="{{ route('wedo_create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                      Create
                </a>

            </div>
        </div>
    </nav>
</div>