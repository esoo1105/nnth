@extends('.layoutadmin.main')
@section('title', 'Cập nhật thông tin danh sách lớp')
@section('content')
    @if ($errors->any())
        <ul style="list-style-type: none;">
            @foreach ($errors->all() as $error)
                <li class="text-danger text-center">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if ($message = session('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <h2 style="margin-bottom: 20px">SỬA THÔNG TIN SINH VIÊN TRONG DANH SÁCH LỚP</h2>
    <form action="{{ route('danhsachlop.update', $danhsachlop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputKhoaHoc">Mã lớp học phần</label>
                <select id="inputState" class="form-control" name="khoahoc_id">
                    @foreach ($khoahoc as $item)
                        <option value="{{ $item->id }}"
                            {{ old('khoahoc_id', $danhsachlop->khoahoc_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->ma_khoahoc }} - {{ $item->dot_hoc }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress">Số điện thoại</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="0123456789" name="so_dien_thoai"
                    value="{{ old('so_dien_thoai', $danhsachlop->so_dien_thoai) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="vd@gmail.com" name="email"
                    value="{{ old('email', $danhsachlop->email) }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputAddress">Mã số sinh viên</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Nhập cơ sở học"
                    name="ma_sinh_vien" value="{{ old('ma_sinh_vien', $danhsachlop->ma_sinh_vien) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Họ đệm</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Trần Văn" name="ho_dem"
                    value="{{ old('ho_dem', $danhsachlop->ho_dem) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Tên</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Phượng" name="ten"
                    value="{{ old('ten', $danhsachlop->ten) }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="gioi_tinh">Giới tính</label>
                <select class="form-control" id="gioi_tinh" name="gioi_tinh" required>
                    <option value="Nam" {{ old('gioi_tinh', $danhsachlop->gioi_tinh) == 'Nam' ? 'selected' : '' }}>Nam
                    </option>
                    <option value="Nữ" {{ old('gioi_tinh', $danhsachlop->gioi_tinh) == 'Nữ' ? 'selected' : '' }}>Nữ
                    </option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Ngày sinh</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="01/01/1999" name="ngay_sinh"
                    value="{{ old('ngay_sinh', $danhsachlop->ngay_sinh) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Lớp danh nghĩa</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Nhập thông tin lớp danh nghĩa"
                    name="lop_danh_nghia" value="{{ old('lop_danh_nghia', $danhsachlop->lop_danh_nghia) }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputEmail4">Cơ sở</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Nhập thông tin cở sở"
                    name="co_so" value="{{ old('co_so', $danhsachlop->co_so) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Lớp học</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Nhập lớp học" name="lop_hoc"
                    value="{{ old('lop_hoc', $danhsachlop->lop_hoc) }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-9">
                <label for="inputState">Ghi chú</label>
                <div class="form-group" style="width: 100%">
                    <textarea style="height: 150px;width: 100%" name="ghi_chu" class="form-group" placeholder="Thêm ghi chú">{{ old('ghi_chu', $danhsachlop->ghi_chu) }}</textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="height: 50px;margin
