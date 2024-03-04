@extends('.layoutadmin.main')
@section('title', 'Sửa thông tin người dùng')
@section('content')
    @if (count($errors) > 0)
        <ul style="list-style-type: none;">
            @foreach ($errors->all() as $error)
                <li class="text-danger text-center">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if ($message = \Illuminate\Support\Facades\Session::get('error'))
        <div class="alert alert-danger alert-block text-center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <h2 style="margin-bottom: 40px">CẬP NHẬT THÔNG TIN NGƯỜI DÙNG</h2>
    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputAddress">Họ Tên</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Họ và tên" name="name"
                    value="{{ old('name', $user->name) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email"
                    value="{{ old('email', $user->email) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputPassword4">Mật khẩu</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputZip">Quyền</label>
                <select id="inputState" class="form-control"
                    name="quyen_id"{{ $user->quyen->ten_quyen === 'Giảng viên' ? 'disabled' : '' }}>
                    @foreach ($quyen as $item)
                        <option value="{{ $item->id }}"
                            {{ $item->id == old('quyen_id', $user->quyen_id) ? 'selected' : '' }}>
                            {{ $item->ten_quyen }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-facebook" style="height: 50px">Cập nhật tài khoản</button>
    </form>
@endsection
