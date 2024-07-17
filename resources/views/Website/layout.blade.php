<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #fff" >
        <div class="sidebar-logo">
            <div class="logo-header"  style="background-color: #ddd"  >
                <a href="dashboard" class="logo">
                    <img src="assets/img/Auth/wallet.png" alt="navbar brand" class="navbar-brand"
                         height="50px"/>
                         <p class="ps-2 fs-4 fw-bold pt-4">My Wallet</p>
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner" >
            <div class="sidebar-content ">
                <ul class="nav nav-secondary ">
                    <li class="nav-item ">
                        <a href="dashboard">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>

                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="addWallet">
                            <i class="fas fa-th-list"></i>
                            <p>Add Wallet</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="walletShare">
                            <i class="fas fa-th-list"></i>
                            <p>Wallet Share</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header" style="background-color: #fff">
            <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" style="background-color: #fff" >
                    <a href="dasdhboard" class="logo">
                        <img src="assets/img/logo.jpg" alt="navbar brand" class="navbar-brand"
                            height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid" >
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        {{-- <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false" aria-haspopup="true">
                                <i class="fa fa-search"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-search animated fadeIn">
                                <form class="navbar-left navbar-form nav-search">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search ..." class="form-control" />
                                    </div>
                                </form>
                            </ul>
                        </li> --}}

                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    @if (Auth::user()->image != null)
                                        <img src="{{ asset('storage/UserImage/' . Auth::user()->image) }}"
                                            alt="..." class="avatar-img rounded-circle" />
                                    @else
                                        <img src="assets/img/user.png" alt="..."
                                            class="avatar-img rounded-circle" />
                                    @endif
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold">{{ Auth::user()->name }}</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                @if (Auth::user()->image != null)
                                                    <img src="{{ asset('storage/UserImage/' . Auth::user()->image) }}"
                                                        alt="image profile" class="avatar-img rounded" />
                                                @else
                                                    <img src="assets/img/user.png" alt="image profile"
                                                        class="avatar-img rounded" />
                                                @endif

                                            </div>
                                            <div class="u-text">
                                                <h4>{{ Auth::user()->name }}</h4>
                                                <p class="text-muted">{{ Auth::user()->email }}</p>

                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="profile">My Profile</a>
                                        <a class="dropdown-item" href="changePassword">Change Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="return confirm('Do You Really Want To Logout?')">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <div class="container bg-image">
            @yield('main')
        </div>

        <footer class="footer">
            <div class="container-fluid d-flex justify-content-center">
                <div class="copyright">
                    2024, made with <i class="fa fa-heart heart text-danger"></i> by
                    <a href="">Aprosoftech.com</a>
                </div>
            </div>
        </footer>
    </div>
</div>
