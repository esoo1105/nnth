</html>
<!DOCTYPE html>
<html lang="en">
@include('.layoutadmin.header')
@php
    $isAdmin = !auth()->check() || auth()->user()->quyen->ten_quyen === 'Admin';
@endphp

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('.layoutadmin.nav')
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($message = \Illuminate\Support\Facades\Session::get('message'))
                            <div class="alert alert-primary alert-block text-center" style="margin-top: 20px;"
                                id="primaryAlert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
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
                                    @if ($isAdmin)
                                        <th scope="col">Chỉnh sửa</th>
                                    @endif
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
                                        @if ($isAdmin)
                                            <td align="center"> <a
                                                    href="{{ route('hienthichitietkhoahoc', $item->id) }}"
                                                    style="color: #f61e1e; font-size: 17px; font-weight: bold;">Chỉnh
                                                    sửa</a></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('.layoutadmin.footer')
    </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    @include('.layoutadmin.logout')
    @include('.layoutadmin.script')
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
