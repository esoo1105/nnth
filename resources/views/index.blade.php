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
                        <form action="{{ route('searchKH') }}" method="GET" class="search-form">
                            <h2>Nhập từ khóa để tìm kiếm</h2>
                            <div class="input-group">
                                <input type="text" name="keyword" id="khoahoc"
                                    placeholder="Nhập khóa học bạn muốn tìm kiếm" class="form-control">
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
                    <div id="danhsach_khoahoc">
                        @foreach ($khoahocs as $loai => $khoahoc)
                            <div class="col-md-12 heading-section ftco-animate mb-5">
                                <div class="text-center"><span class="subheading">{{ $loai }}</span></div>
                                <div class="row" style="margin-top: 20px;">
                                    <!-- Adjust the margin-top value as needed -->
                                    @foreach ($khoahoc as $item)
                                        <div class="col-md-4">
                                            <div class="property-wrap ftco-animate">
                                                <div class="img d-flex align-items-center justify-content-center"
                                                    style="background-image: url({{ $item->hinh_anh }});">
                                                    <a href="{{ route('chitiet', $item->id) }}"
                                                        class="icon d-flex align-items-center justify-content-center btn-custom">
                                                        <span class="ion-ios-link"></span>
                                                    </a>
                                                    <div class="list-agent d-flex align-items-center">
                                                        <a class="agent-info d-flex align-items-center">
                                                            <div class="img-2 rounded-circle"
                                                                style="background-image: url(images/person_1.jpg);">
                                                            </div>
                                                            <h3 class="mb-0 ml-2">{{ $item->nguoi_dang_bai }}</h3>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <h3 class="mb-0"><a
                                                            href="{{ route('chitiet', $item->id) }}">{{ $item->ma_khoahoc }}
                                                            -
                                                            {{ $item->ten_khoahoc }} </a></h3>
                                                    <p class="price mb-3"><span> Đợt học: {{ $item->dot_hoc }}</span>
                                                    </p>
                                                    <p class="price mb-3"><span> Ngày khai giảng:
                                                            {{ Carbon\Carbon::createFromFormat('Y-m-d', $item->ngay_khai_giang)->format('d-m-Y') }}</span>
                                                    </p>
                                                    <span class="location d-inline-block mb-3">
                                                        <i class="fas fa-map-marker-alt"></i> Địa điểm đăng ký:
                                                        {{ $item->dia_diem_dang_ky }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3"></div>
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
