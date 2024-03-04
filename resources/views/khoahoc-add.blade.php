@extends('.layoutadmin.main')
@section('title', 'Thêm khóa học')
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
    <h2 style="margin-bottom: 20px">THÊM THÔNG TIN KHÓA HỌC</h2>
    <form action="{{ route('khoahoc.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputEmail4">Mã khóa học</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Mã khóa học" name="ma_khoahoc"
                    value="{{ old('ma_khoahoc') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Tên khóa học</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Tên khóa học" name="ten_khoahoc"
                    value="{{ old('ten_khoahoc') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress">Đợt học</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="HK1 2023-2024,..." name="dot_hoc"
                    value="{{ old('dot_hoc') }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputZip">Loại khóa học</label>
                <select id="inputState" class="form-control" name="loaikhoahoc_id">
                    @foreach ($loaikhoahoc as $item)
                        <option value="{{ $item->id }}"> {{ $item->ten_loaikhoahoc }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress">Địa điểm đăng ký</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Nhập địa điểm đăng ký học"
                    name="dia_diem_dang_ky" value="{{ old('dia_diem_dang_ky') }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputAddress">Ngày khai giảng</label>
                <input type="date" class="form-control" id="inputAddress" name="ngay_khai_giang"
                    value="{{ old('ngay_khai_giang') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputZip">Chọn hình ảnh</label>
                <input type="file" class="form-control" accept="image/*" name="file" id="fileInput">
            </div>
            <div class="form-group col-md-3" id="imagePreview" style="max-width: 200px; margin-top: 20px;"></div>
        </div>
        <button type="submit" class="btn btn-success" style="height: 50px;margin-top: 20px">Tạo khóa học</button>
    </form>

    <script>
        $(document).ready(function() {
            // Bắt sự kiện khi chọn tệp
            $('#fileInput').on('change', function() {
                // Lấy đối tượng tệp
                var input = this;

                // Kiểm tra xem có tệp được chọn hay không
                if (input.files && input.files[0]) {
                    // Tạo đối tượng FileReader để đọc tệp
                    var reader = new FileReader();

                    // Đặt sự kiện khi đọc tệp thành công
                    reader.onload = function(e) {
                        // Hiển thị hình ảnh trên trang
                        $('#imagePreview').html('<img src="' + e.target.result +
                            '" alt="Ảnh xem trước" style="max-width: 100%;">');
                    };

                    // Đọc tệp như một đối tượng URL dữ liệu (data URL)
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>

@endsection
