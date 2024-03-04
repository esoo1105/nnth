@extends('.layoutadmin.main')
@section('title', 'Thêm loại khóa học')
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
    <form action="{{ route('loaikhoahoc.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputAddress">Tên loại khóa học</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Tin học, Anh Văn,..."
                    name="ten_loaikhoahoc" value="{{ old('ten_loaikhoahoc') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-facebook" style="height: 50px">Tạo loại khóa học</button>
    </form>
@endsection
