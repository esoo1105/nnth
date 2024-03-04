@extends('.layoutadmin.main')
@section('title', 'Chỉnh sửa Kết Quả')
@section('content')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="list-style-type: none;">
                @foreach ($errors->all() as $error)
                    <li class="text-danger text-center">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($message = session('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = session('message'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <h2 style="margin-bottom: 20px">CHỈNH SỬA KẾT QUẢ</h2>
    <form action="{{ route('ketqua.update', $ketqua->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="ttsv">Thông tin sinh viên</label>
                <select id="ttsv" class="form-control selectpicker" data-live-search="true" name="sinhvien_id">
                    @foreach ($sinhvien as $item)
                        <option value="{{ $item->id }}"
                            {{ old('sinhvien_id', $ketqua->sinhvien_id) == $item->id ? 'selected' : '' }}>
                            MSSV: {{ $item->ma_sinh_vien }} | Họ và tên: {{ $item->ho_dem }} {{ $item->ten }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="dth">Điểm tin học</label>
                <input type="text" class="form-control" id="dth" placeholder="Nhập điểm tin học"
                    name="diem_tin_hoc" value="{{ old('diem_tin_hoc', $ketqua->diem_tin_hoc) }}">
            </div>
            <div class="form-group col-md-3">
                <label for="bth">Bằng tin học</label>
                <input type="text" class="form-control"id="bth" placeholder="Nhập bằng tin học" name="bang_tin_hoc"
                    value="{{ old('bang_tin_hoc', $ketqua->bang_tin_hoc) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="dav">Điểm anh văn</label>
                <input type="text" class="form-control" id="dav" placeholder="Nhập điểm anh văn"
                    name="diem_anh_van" value="{{ old('diem_anh_van', $ketqua->diem_anh_van) }}">
            </div>
            <div class="form-group col-md-3">
                <label for="bav">Bằng anh văn</label>
                <input type="text" class="form-control" id="bav" placeholder="Nhập bằng anh văn"
                    name="bang_anh_van" value="{{ old('bang_anh_van', $ketqua->bang_anh_van) }}">
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="height: 50px; margin-top: 20px">Cập nhật</button>
    </form>
    <!-- Include jQuery, Bootstrap Bundle, and Bootstrap Select JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

@endsection
