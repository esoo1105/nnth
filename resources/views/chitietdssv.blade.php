<!DOCTYPE html>
<html lang="en">
@include('.layout.header')

<section>
    <h2 class="text-center">DANH SÁCH SINH VIÊN LỚP HỌC PHẦN</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li><strong>Đợt học: {{ $thongtin->khoahoc->dot_hoc }}</strong> </li>
                    <li><strong>Cơ sở: {{ $thongtin->co_so }} </strong> </li>
                    <li><strong>Lớp học: {{ $thongtin->lop_hoc }}</strong> </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li><strong>Mã lớp học phần: {{ $thongtin->khoahoc->ma_khoahoc }}</strong> </li>
                    <li><strong>Tên học phần: {{ $thongtin->khoahoc->ten_khoahoc }}</strong> </li>
                    <li><strong>Sĩ số lớp: {{ $count }}</strong></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Mã sinh viên</th>
                        <th>Họ đệm</th>
                        <th>Tên</th>
                        <th>Lớp danh nghĩa</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1; // Khởi tạo biến đếm
                    @endphp
                    @foreach ($danhsachlop as $item)
                        <tr class="text-center">
                            <td>{{ $count++ }}</td> <!-- Hiển thị số thứ tự và tự tăng -->
                            <td>{{ $item->ma_sinh_vien }}</td>
                            <td>{{ $item->ho_dem }}</td>
                            <td>{{ $item->ten }}</td>
                            <td>{{ $item->lop_danh_nghia }}</td>
                            <td>{{ $item->gioi_tinh }}</td>
                            <td>{{ $item->ngay_sinh }}</td>
                            <td>{{ $item->so_dien_thoai }}</td>
                            <td>{{ $item->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
