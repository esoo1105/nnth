@php
    $isAdmin = !auth()->check() || auth()->user()->quyen->ten_quyen === 'Admin';
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Quản trị viên<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Giao diện quản lý
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <div class="nav-link sidebar-heading">
            <span>DANH MỤC QUẢN LÝ</span>
        </div>
    </li>
    @if ($isAdmin)
        <li class="nav-item">
            <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('khoahoc') }}">
                <i class="fas fa-book"></i>
                <span>KHÓA HỌC</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('loaikhoahoc') }}">
                <i class="fas fa-certificate"></i>
                <span>LOẠI KHÓA HỌC</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('chitietkhoahoc') }}">
                <i class="fas fa-info-circle"></i>
                <span>CHI TIẾT KHÓA HỌC</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('user') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>TÀI KHOẢN NGƯỜI DÙNG</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('ketqua') }}">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>KẾT QUẢ</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('sinhvien') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>SINH VIÊN</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('danhsachlop') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>DANH SÁCH LỚP</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('sinhvienchuadangky') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>DANH SÁCH SINH VIÊN CHƯA ĐĂNG KÝ</span>
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ \Illuminate\Support\Facades\URL::to('lichdayhoc') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>LỊCH HỌC</span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>
                @php
                    $user = \Illuminate\Support\Facades\Auth::user()->id;
                    $data = \App\Models\User::all()->where('id', $user);
                @endphp
                <!-- Nav Item - User Information -->
                @foreach ($data as $item)
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span
                                class="mr-2 d-none d-lg-inline text-gray-600 small"><strong>{{ $item->name }}</strong></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" data-toggle="modal" data-target="#userInfoModal">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thông tin
                            </a>
                            <a class=dropdown-item data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Đăng xuất
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog"
                aria-labelledby="userInfoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userInfoModalLabel">Thông tin người dùng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @php
                                $id = \Illuminate\Support\Facades\Auth::user()->id;
                                $user = \App\Models\User::find($id);
                            @endphp
                            <div class="container d-flex justify-content-center">
                                <h5 class="card-title">Thông Tin Người Dùng</h5>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Tên Tài Khoản:</strong> {{ $user->name }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Email:</strong> {{ $user->email }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Chức vụ:</strong> {{ $user->quyen->ten_quyen }}
                                    </div>
                                    <!-- Thêm các thông tin khác nếu có -->

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('updateuser', $user->id) }}" class="btn btn-primary">Cập
                                nhật</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Đăng xuất tài khoản</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Bạn chắc chắn đăng xuất</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <a type="button" href="{{ \Illuminate\Support\Facades\URL::to('logout') }}"
                                class="btn btn-primary">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
