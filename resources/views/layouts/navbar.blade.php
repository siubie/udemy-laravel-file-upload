<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li>
            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
        </li>
        <li>
            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
        </li>
    </ul>
    <div class="search-element">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" />
        <button class="btn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
<ul class="navbar-nav navbar-right">
    @auth
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1" />
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                    <i class="fas fa-sign-out-alt"></i> Logout </a>
                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                </form>
            </div>
        </li>
    @endauth
</ul>
