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

    <section class="ftco-section goto-here">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style-type: none;">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($message = \Illuminate\Support\Facades\Session::get('error'))
            <div class="alert alert-danger alert-block text-center">
                <button type="button" class="close" data-dismiss="alert" id="errorAlert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="container">
            <div class="container mt-5">
                <h2 class="mb-4">Tra cứu điểm thi</h2>
                <form id="sendOtpForm" action="/sendotp" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputIdentifier" name="email"
                            placeholder="Nhập email của bạn" value="{{ $ketqua ? $email : '' }}">
                    </div>
                    <button type="button" class="btn btn-primary" id="btnTraCuu">Tra cứu</button>
                </form>
                @if ($ketqua)
                    <div class="mt-5">
                        <h3>Thông tin điểm thi và bằng:
                        </h3>
                        <ul style="list-style-type: none;">
                            <li>Sinh viên: {{ $ketqua->sinhvien->ma_sinh_vien }} -
                                {{ $ketqua->sinhvien->ho_dem }}
                                {{ $ketqua->sinhvien->ten }}</li>
                        </ul>


                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>Điểm Tin Học:
                                        {{ isset($ketqua->diem_tin_hoc) ? $ketqua->diem_tin_hoc : 'Chưa cập nhật' }}
                                    </li>
                                    <li>Điểm Anh Văn:
                                        {{ isset($ketqua->diem_anh_van) ? $ketqua->diem_anh_van : 'Chưa cập nhật' }}
                                    </li>
                                    <!-- Thêm các trường thông tin điểm khác ở đây nếu cần -->
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>Bằng Tin Học:
                                        {{ isset($ketqua->bang_tin_hoc) ? $ketqua->bang_tin_hoc : 'Chưa cập nhật' }}
                                    </li>
                                    <li>Bằng Anh Văn:
                                        {{ isset($ketqua->bang_anh_van) ? $ketqua->bang_anh_van : 'Chưa cập nhật' }}
                                    </li>
                                    <!-- Thêm các trường thông tin bằng khác ở đây nếu cần -->
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
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
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btnTraCuu').addEventListener('click', function() {
                var identifierValue = document.getElementById('inputIdentifier').value.trim();
                if (identifierValue !== '') {
                    document.getElementById('sendOtpForm').submit();
                } else {
                    alert('Vui lòng điền email trước khi tra cứu.');
                }
            });
        });
    </script>
    <script>
        // Tự đóng thông báo sau khi người dùng thực hiện hành động
        $(document).ready(function() {
            // Đặt sự kiện click cho bất kỳ phần tử nào trên trang
            $(document).on('click', function() {
                // Đóng cả hai thông báo
                $("#errorAlert").alert('close');
            });
        });
    </script>
</body>

</html>
