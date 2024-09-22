<div class="position-relative iq-banner">
    <!--Nav Start-->
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar" style="height: 72px">
        <div class="container-fluid navbar-inner">
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                    </svg>
                </i>
            </div>
            <h3 class="text-center">KARTU SENPI DIGITAL | {{ auth()->user()->role }}</h3>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span class="navbar-toggler-bar bar1 mt-2"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-center navbar-list mb-lg-0 mb-2 ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center py-0" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->personil->foto_pribadi ? asset(auth()->user()->personil->foto_pribadi) : asset("assets/images/user.png") }}"
                                alt="User-Profile"
                                class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                            <div class="caption d-none d-md-block ms-3">
                                <h6 class="caption-title mb-0">{{ auth()->user()->personil->nama }}</h6>
                                <p class="caption-sub-title mb-0">{{ auth()->user()->personil->jabatan }}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route("profile") }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route("logout") }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Nav Header Component Start -->
    <div class="iq-navbar-header">
    </div>
    <!-- Nav Header Component End -->
    <!--Nav End-->
</div>
