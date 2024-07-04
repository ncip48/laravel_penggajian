<header class="main-header">
    <div class="d-flex align-items-center logo-box justify-content-start">
        <a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block push-btn"
            data-toggle="push-menu" role="button">
            <img src="{{ asset('images/svg-icon/collapse.svg') }}" class="img-fluid svg-icon" alt="" />
        </a>
        <!-- Logo -->
        <a href="index.html" class="logo">
            <div class="logo-lg fs-4 fw-bold">Penggajian</div>
        </a>
    </div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
            <ul class="header-megamenu nav">
                <li class="btn-group nav-item d-md-none">
                    <a href="#" class="waves-effect waves-light nav-link push-btn btn-outline no-border"
                        data-toggle="push-menu" role="button">
                        <img src="{{ asset('images/svg-icon/collapse.svg') }}" class="img-fluid svg-icon"
                            alt="" />
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen"
                        class="waves-effect waves-light nav-link btn-outline no-border full-screen" title="Full Screen">
                        <img src="{{ asset('images/svg-icon/fullscreen.svg') }}" class="img-fluid svg-icon"
                            alt="" />
                    </a>
                </li>
                <li class="btn-group d-lg-inline-flex d-none">
                    <div class="app-menu"></div>
                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <!-- Notifications -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="waves-effect waves-light dropdown-toggle btn-outline no-border"
                        data-bs-toggle="dropdown" title="Notifications">
                        <img src="{{ asset('images/svg-icon/notifications.svg') }}" class="img-fluid svg-icon"
                            alt="" />
                    </a>
                    <ul class="dropdown-menu animated bounceIn">
                        <li class="header">
                            <div class="p-20">
                                <div class="flexbox">
                                    <div>
                                        <h4 class="mb-0 mt-0">Notifikasi</h4>
                                    </div>
                                    <div>
                                        <a href="#" class="text-danger">Tandai Baca</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu sm-scrol">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-info"></i> Curabitur id eros quis
                                        nunc suscipit blandit.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-warning"></i> Duis malesuada
                                        justo eu sapien elementum, in semper diam posuere.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-danger"></i> Donec at nisi sit
                                        amet tortor commodo porttitor pretium a erat.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-success"></i> In gravida
                                        mauris et nisi
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-danger"></i> Praesent eu lacus in
                                        libero dictum fermentum.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-primary"></i> Nunc fringilla lorem
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-success"></i> Nullam euismod dolor
                                        ut quam interdum, at scelerisque ipsum imperdiet.
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">Lihat Semua</a>
                        </li>
                    </ul>
                </li>

                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light dropdown-toggle btn-outline no-border"
                        data-bs-toggle="dropdown" title="User">
                        <img src="{{ asset('images/svg-icon/user.svg') }}" class="rounded svg-icon" alt="" />
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="#"><i class="ti-user text-muted me-2"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="ti-wallet text-muted me-2"></i> My
                                Wallet</a>
                            <a class="dropdown-item" href="#"><i class="ti-settings text-muted me-2"></i>
                                Settings</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="post" id="logout">
                                @csrf
                                <a class="dropdown-item" href="#" onclick="logout.submit()">
                                    <i class="ti-lock text-muted me-2"></i> Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="dropdown d-flex align-items-center me-2 fw-bold">
                    {{ auth()->user()->name }}
                </li>
            </ul>
        </div>
    </nav>
</header>
