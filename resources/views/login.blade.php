<!DOCTYPE html>
<html lang="en">
@include('.layout.header')

<body>
    @include('.layout.nav')
    <div class="hero-wrap" style="background-image: url('images/bg_ctump.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
    </div>
    <section>
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                            </div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger d-flex justify-content-center">
                                    <ul class="list-group" style="list-style-type: none;">
                                        @foreach ($errors->all() as $error)
                                            <li class="text-danger text-center">
                                                <strong>{{ $error }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if ($message = \Illuminate\Support\Facades\Session::get('error'))
                                <div class="alert alert-danger alert-block text-center" id="errorAlert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            <form class="user" action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        aria-describedby="emailHelp" placeholder="Nhập địa chỉ Email..."
                                        name="username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" name="password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Đăng nhập</button>
                            </form>
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
                $("#errorAlert").alert('close');
                $("#successAlert").alert('close');
            });
        });
    </script>

</html>
