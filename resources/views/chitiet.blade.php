<!DOCTYPE html>
<html lang="en">
@include('.layout.header')

<body>
    @include('.layout.nav')
    <div class="hero-wrap" style="background-image: url('images/bg_ctump.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
                    <h1 class="mb-3 bread">{{ $chitietkhoahoc->khoahoc->ma_khoahoc }} -
                        {{ $chitietkhoahoc->khoahoc->ten_khoahoc }}</h1>
                    <p class="breadcrumbs"><span class="mr-2">
                            <a href="{{ \Illuminate\Support\Facades\URL::to('/') }}">Trang chủ
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Chi tiết khóa học<i
                                class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-property-details">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="property-details">
                        @if ($message = \Illuminate\Support\Facades\Session::get('message'))
                            <div class="alert alert-primary alert-block text-center" style="margin-top: 20px;"
                                id="primaryAlert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @php
                            $files = explode(',', $chitietkhoahoc->khoahoc->hinh_anh);
                        @endphp
                        @foreach ($files as $img => $val)
                            <div class="img rounded" style="background-image: url({{ $val }});"></div>
                        @endforeach
                        <div class="text">
                            <h2>Thông tin chi tiết khóa học</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pills">
                    <div class="bd-example bd-example-tabs">
                        <div class="d-flex">
                            <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill"
                                        href="#pills-description" role="tab" aria-controls="pills-description"
                                        aria-expanded="true">Tổng quan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill"
                                        href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer"
                                        aria-expanded="true">Lịch học</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                                aria-labelledby="pills-description-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="features">
                                            <li class="check"><span class="ion-ios-checkmark-circle"></span>Đợt học :
                                                {{ $chitietkhoahoc->khoahoc->dot_hoc }}</li>
                                            <li class="check"><span class="ion-ios-checkmark-circle"></span>Tên
                                                khóa học : {{ $chitietkhoahoc->khoahoc->ten_khoahoc }}</li>
                                            <li class="check"><span class="ion-ios-checkmark-circle"></span>Thời gian
                                                bắt đầu :
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $chitietkhoahoc->thoi_gian_bat_dau)->format('d-m-Y') }}
                                            </li>
                                            <li class="check"><span class="ion-ios-checkmark-circle"></span>Thời gian
                                                kết thúc
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $chitietkhoahoc->thoi_gian_ket_thuc)->format('d-m-Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md- 6">
                                        <ul class="features">
                                            <li class="check"><span class="ion-ios-checkmark-circle"></span>Địa
                                                điểm học : {{ $chitietkhoahoc->dia_diem_hoc }}</li>
                                            <li class="check"><span class="ion-ios-checkmark-circle"></span>Giảng viên
                                                :
                                                {{ $chitietkhoahoc->giangvien->name }}</li>
                                            <li class="check"><span class="ion-ios-checkmark-circle"></span>Học
                                                phí : {{ $chitietkhoahoc->hoc_phi }}</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-manufacturer" role="tabpanel"
                                aria-labelledby="pills-manufacturer-tab">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead style="color: #fff; background-color: #507CD1; font-weight: bold; "
                                            class="text-center">
                                            <tr>
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
                                            <tr
                                                style="color: #006699; background-color: #EFF3FB; font-size: 18px; height: 40px;">
                                                <td align="center">
                                                    <a href="{{ route('chitietdssv', $chitietkhoahoc->khoahoc_id) }}"
                                                        style="color: #1e99f6; font-size: 17px;">
                                                        {{ $chitietkhoahoc->khoahoc->ma_khoahoc }}
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $chitietkhoahoc->khoahoc->ngay_khai_giang)->format('d-m-Y') }}
                                                </td>
                                                <td align="center">
                                                    {{ $chitietkhoahoc->thoi_gian_hoc }}</td>
                                                <td align="center">{{ $chitietkhoahoc->so_tiet_hoc }}
                                                </td>
                                                <td align="center" style="font-size: 16px;">
                                                    {{ $chitietkhoahoc->dia_diem_hoc }}</td>
                                                <td align="center">{{ $chitietkhoahoc->thu_hoc }}</td>
                                                <td align="center">
                                                    {{ $chitietkhoahoc->giangvien->name }}</td>
                                                <td align="center">
                                                    {{ $chitietkhoahoc->khoahoc->loaikhoahoc->ten_loaikhoahoc }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
