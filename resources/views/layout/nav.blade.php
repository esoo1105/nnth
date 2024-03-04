<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="http://127.0.0.1:8000/images/logo.jpg" alt="Logo" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}"
                        class="nav-link">Trang chủ</a></li>
                <li class="nav-item {{ request()->is('tracuudiem') || request()->is('verifyotp') ? 'active' : '' }}"><a
                        href="{{ url('/tracuudiem') }}" class="nav-link">Tra cứu điểm</a></li>
                <li class="nav-item {{ request()->is('lichhoc') ? 'active' : '' }}"><a href="{{ url('/lichhoc') }}"
                        class="nav-link">Lịch học</a></li>
                <li class="nav-item {{ request()->is('login') ? 'active' : '' }}"><a href="{{ url('/login') }}"
                        class="nav-link">Đăng nhập</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
