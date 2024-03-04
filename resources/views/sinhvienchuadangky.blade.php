<!DOCTYPE html>
<html lang="en">

@include('.layoutadmin.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('.layoutadmin.nav')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">DANH SÁCH SINH VIÊN CHƯA ĐĂNG KÝ</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <p class="m-0 font-weight-bold text-primary">Thông tin sinh viên</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>Đợt học</th>
                                    <th>Mã khóa học</th>
                                    <th>Tên khóa học</th>
                                    <th>Lớp</th>
                                    <th>Danh sách</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhsachlops as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->khoahoc->dot_hoc }}</td>
                                        <td>{{ $item->khoahoc->ma_khoahoc }}</td>
                                        <td>{{ $item->khoahoc->ten_khoahoc }}</td>
                                        <td>{{ $item->lop_hoc }}</td>
                                        <td>
                                            <a href="{{ route('chitietdssvcdk', $item->khoahoc_id) }}"
                                                class="btn btn-primary">Xem chi tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    @include('.layoutadmin.footer')
    <!-- End of Footer -->
    {{-- MODAL --}}

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('.layoutadmin.logout')
    @include('.layoutadmin.script')
</body>

</html>
