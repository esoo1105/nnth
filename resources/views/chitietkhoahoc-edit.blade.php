@extends('.layoutadmin.main')
@section('title', 'Chỉnh sửa thông tin chi tiết khóa học')
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
    @if ($message = \Illuminate\Support\Facades\Session::get('message'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <h2 style="margin-bottom: 20px">CHỈNH SỬA THÔNG TIN CHI TIẾT KHÓA HỌC</h2>
    <form action="{{ route('chitietkhoahoc.update', $chitietkhoahoc->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputKhoaHoc">Mã khóa học</label>
                <select id="inputKhoaHoc" class="form-control" name="khoahoc_id">
                    @foreach ($khoahoc as $item)
                        <option value="{{ $item->id }}"
                            {{ old('khoahoc_id', $chitietkhoahoc->khoahoc_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->ma_khoahoc }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Thời gian học</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="7h30, 8h30,..."
                    name="thoi_gian_hoc" value="{{ old('thoi_gian_hoc', $chitietkhoahoc->thoi_gian_hoc) }}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress">Số tiết</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1, 2, ..." name="so_tiet_hoc"
                    value="{{ old('so_tiet_hoc', $chitietkhoahoc->so_tiet_hoc) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputAddress">Địa điểm học</label>
                <input type="text" class="form-control" id="inputAddress" name="dia_diem_hoc"
                    placeholder="Nhập địa điểm học" value="{{ old('dia_diem_hoc', $chitietkhoahoc->dia_diem_hoc) }}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress">Thứ</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Thứ 2 đến CN" name="thu_hoc"
                    value="{{ old('thu_hoc', $chitietkhoahoc->thu_hoc) }}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputGiangVien">Tên giảng viên</label>
                <select id="inputGiangVien" class="form-control" name="giangvien_id">
                    @foreach ($giangvien as $item)
                        <option value="{{ $item->id }}"
                            {{ old('giangvien_id', $chitietkhoahoc->giangvien_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputAddress">Thời gian bắt đầu</label>
                <input type="date" class="form-control" id="inputAddress" name="thoi_gian_bat_dau"
                    value="{{ old('thoi_gian_bat_dau', $chitietkhoahoc->thoi_gian_bat_dau) }}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress">Thời gian kết thúc</label>
                <input type="date" class="form-control" id="inputAddress" name="thoi_gian_ket_thuc"
                    value="{{ old('thoi_gian_ket_thuc', $chitietkhoahoc->thoi_gian_ket_thuc) }}">
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress">Học phí</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Nhập học phí" name="hoc_phi"
                    value="{{ old('hoc_phi', $chitietkhoahoc->hoc_phi) }}">
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="height: 50px;margin-top: 20px">Cập nhật thông tin chi tiết
            khóa học</button>
    </form>
@endsection
