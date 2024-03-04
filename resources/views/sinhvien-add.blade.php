@extends('.layoutadmin.main')
@section('title', 'Thêm thông tin sinh viên')
@section('content')
    @if (count($errors) > 0)
        <ul style="list-style-type: none;">
            @foreach ($errors->all() as $error)
                <li class="text-danger text-center">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if ($message = \Illuminate\Support\Facades\Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <h2 style="margin-bottom: 20px">THÊM THÔNG TIN SINH VIÊN</h2>
    <form action="{{ route('sinhvien.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputKhoaHoc">Mã khóa học</label>
                <select id="inputState" class="form-control" name="khoahoc_id">
                    @foreach ($khoahoc as $item)
                        <option value="{{ $item->id }}" {{ old('khoahoc_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->ma_khoahoc }} - {{ $item->dot_hoc }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="vd@gmail.com" name="email"
                    value="{{ old('email') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress">Số điện thoại</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="0123456789" name="so_dien_thoai"
                    value="{{ old('so_dien_thoai') }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="ma_sinh_vien">Mã số sinh viên</label>
                <input type="text" class="form-control" id="ma_sinh_vien" placeholder="Nhập mã số sinh viên"
                    name="ma_sinh_vien" value="{{ old('ma_sinh_vien') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="ho_dem">Họ đệm</label>
                <input type="text" class="form-control" id="ho_dem" placeholder="Nhập họ đệm" name="ho_dem"
                    value="{{ old('ho_dem') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="ten">Tên</label>
                <input type="text" class="form-control" id="ten" placeholder="Nhập tên" name="ten"
                    value="{{ old('ten') }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="ngay_sinh">Thời gian đăng ký</label>
                <input type="text" class="form-control" id="thoi_gian_dang_ky" name="thoi_gian_dang_ky"
                    placeholder="Nhập thời gian đăng ký" value="{{ old('thoi_gian_dang_ky') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="lop_danh_nghia">Lớp danh nghĩa</label>
                <input type="text" class="form-control" id="lop_danh_nghia" placeholder="Nhập lớp danh nghĩa"
                    name="lop_danh_nghia" value="{{ old('lop_danh_nghia') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="gioi_tinh">Giới tính</label>
                <select class="form-control" id="gioi_tinh" name="gioi_tinh" required>
                    <option value="Nam" {{ old('gioi_tinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ old('gioi_tinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="ngay_sinh">Ngày sinh</label>
                <input type="text" class="form-control" id="ngay_sinh" name="ngay_sinh" placeholder="Nhập ngày sinh"
                    value="{{ old('ngay_sinh') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="so_tien_da_dong">Số tiền đã đóng</label>
                <input type="text" class="form-control" id="so_tien_da_dong" placeholder="Nhập số tiền đã đóng"
                    name="so_tien_da_dong" value="{{ old('so_tien_da_dong') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="so_tien_con_lai">Số tiền còn lại</label>
                <input type="text" class="form-control" id="so_tien_con_lai" placeholder="Nhập số tiền còn lại"
                    name="so_tien_con_lai" value="{{ old('so_tien_con_lai') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-9">
                <label for="ghi_chu">Ghi chú</label>
                <textarea class="form-control" id="ghi_chu" placeholder="Nhập ghi chú" name="ghi_chu" rows="3">{{ old('ghi_chu') }}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="height: 50px;margin-top: 20px">Thêm thông tin sinh
            viên</button>
    </form>
@endsection
