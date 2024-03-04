<!DOCTYPE html>
<html lang="en">
@include('.layout.header')

<body>
    @include('.layout.nav')
    <div class="hero-wrap" style="background-image: url('images/bg_ctump.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-center align-items-center">
                <div class="col-lg-9 col-md-5 ftco-animate d-flex align-items-end">
                    <div class="text text-center w-101">
                    </div>
                </div>
            </div>
        </div>
        <div class="mouse">
            <a href="#" class="mouse-icon">
                <div class="mouse-wheel"><span class="ion-ios-arrow-round-down"></span></div>
            </a>
        </div>
    </div>
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <form action="{{ route('searchLH') }}" method="GET" class="search-form">
                            <h2>Nhập từ khóa để tìm kiếm</h2>
                            <div class="input-group">
                                <input type="text" name="keyword" id="khoahoc"
                                    placeholder="Nhập lịch học bạn muốn tìm kiếm" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                        @if ($message = \Illuminate\Support\Facades\Session::get('message'))
                            <div class="alert alert-primary alert-block text-center" style="margin-top: 20px;"
                                id="primaryAlert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                    </div>
                    <div id="danhsach_khoahoc"></div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>
    <section class="ftco-section goto-here">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead style="color: #fff; background-color: #507CD1; font-weight: bold; "
                                class="text-center">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Danh sách lớp</th>
                                    <th scope="col">Ngày khai giảng</th>
                                    <th scope="col">Thời gian học</th>
                                    <th scope="col">Số tiết</th>
                                    <th scope="col">Địa điểm</th>
                                    <th scope="col">Thứ học</th>
                                    <th scope="col">Giảng viên</th>
                                    <th scope="col">Loại lớp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stt = 1; // Initialize counter variable
                                @endphp
                                @foreach ($chitietkhoahoc as $item)
                                    <tr
                                        style="color: #006699; background-color: #EFF3FB; font-size: 18px; height: 40px;">
                                        <td align="center">{{ $stt++ }}</td>
                                        <td align="center">
                                            <a href="{{ route('chitietdssv', $item->khoahoc_id) }}"
                                                style="color: #1e99f6; font-size: 17px;">
                                                {{ $item->khoahoc->ma_khoahoc }}
                                            </a>
                                        </td>
                                        <td align="center">
                                            {{ Carbon\Carbon::createFromFormat('Y-m-d', $item->khoahoc->ngay_khai_giang)->format('d-m-Y') }}
                                        </td>
                                        <td align="center">
                                            {{ $item->thoi_gian_hoc }}</td>
                                        <td align="center">{{ $item->so_tiet_hoc }}</td>
                                        <td align="center" style="font-size: 16px;">{{ $item->dia_diem_hoc }}</td>
                                        <td align="center">{{ $item->thu_hoc }}</td>
                                        <td align="center">{{ $item->giangvien->name }}</td>
                                        <td align="center">{{ $item->khoahoc->loaikhoahoc->ten_loaikhoahoc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>s
    </section>


    @include('.layout.footer')
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>
    @include('.layout.script')
    <script>
        // Tự đóng thông báo sau khi người dùng thực hiện hành động
        $(document).ready(function() {
            // Đặt sự kiện click cho bất kỳ phần tử nào trên trang
            $(document).on('click', function() {
                // Đóng cả hai thông báo
                $("#primaryAlert").alert('close');
            });
        });
    </script>
</body>

</html>
