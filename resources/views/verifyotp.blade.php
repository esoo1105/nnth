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
        <div class="container">
            <div id="otpSection" class="container mt-5">
                <h2 class="mb-4">Nhập OTP</h2>
                <form id="verifyOtpForm" action="{{ route('verifyotp') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputOtp" name="otp" placeholder="Nhập OTP"
                            value="{{ $otp }}" required>
                    </div>
                    <!-- Thêm một trường ẩn để chứa email -->
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" class="btn btn-primary" id="btnXacMinhOtp">Xác minh OTP</button>
                    {{-- <div id="resendSection" class="text-center mt-3" style="display: none;">
                        <button id="resendButton" class="btn btn-primary">Gửi lại</button>
                    </div>
                    <span id="countdown" style="display: none;"></span> --}}
                </form>
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
                $("#errorAlert").alert('close');
                $("#successAlert").alert('close');
            });
        });
    </script>
    {{-- <script>
        // Lấy thời gian hiện tại
        let currentTime = new Date().getTime();
        // Thời gian kết thúc là thời gian hiện tại cộng thêm 1 phút
        let endTime = currentTime + 60000; // 1 phút = 60000 ms

        // Bắt đầu đếm ngược
        let x = setInterval(function() {
            // Lấy thời gian hiện tại
            let now = new Date().getTime();

            // Tính thời gian còn lại
            let distance = endTime - now;

            // Tính toán các phần tử của thời gian (phút và giây)
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Hiển thị thời gian đếm ngược
            document.getElementById("countdown").innerHTML = "Thời gian còn lại: " + minutes + "phút " + seconds +
                "giây ";

            // Nếu thời gian kết thúc, hiển thị nút gửi lại và dừng đếm ngược
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").style.display = "none";
                document.getElementById("resendSection").style.display = "block";
            } else {
                document.getElementById("countdown").style.display = "inline";
                document.getElementById("resendSection").style.display = "none";
            }
        }, 1000);
    </script> --}}
    <script>
        // Lấy thời gian hiện tại
        let currentTime = new Date().getTime();
        // Thời gian kết thúc là thời gian hiện tại cộng thêm 5 giây
        let endTime = currentTime + 5000; // 5 giây = 5000 ms

        // Bắt đầu đếm ngược
        let x = setInterval(function() {
            // Lấy thời gian hiện tại
            let now = new Date().getTime();

            // Tính thời gian còn lại
            let distance = endTime - now;

            // Tính toán các phần tử của thời gian (giây)
            let seconds = Math.floor(distance / 1000);

            // Hiển thị thời gian đếm ngược
            document.getElementById("countdown").innerHTML = "Thời gian còn lại: " + seconds + " giây";

            // Nếu thời gian kết thúc, hiển thị nút gửi lại và dừng đếm ngược
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").style.display = "none";
                document.getElementById("resendSection").style.display = "block";
            } else {
                document.getElementById("countdown").style.display = "inline";
                document.getElementById("resendSection").style.display = "none";
            }
        }, 1000);
    </script>
</body>

</html>
