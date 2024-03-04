<?php

namespace App\Http\Controllers;

use App\Models\Khoahoc;
use App\Models\LoaiKhoahoc;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KhoahocController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkQuyen:Admin');
    }
    public function index()
    {
        $khoahoc = Khoahoc::where('trangthai', 0)->get();
        return view('khoahoc', compact('khoahoc'));
    }


    public function create()
    {
        $loaikhoahoc = LoaiKhoahoc::all();
        return view('khoahoc-add', compact('loaikhoahoc'));
    }


    public function store(Request $request)
    {
        $messages = [
            'dot_hoc.required' => 'Vui lòng nhập đợt học.',
            'ma_khoahoc.required' => 'Vui lòng nhập mã khóa học.',
            'ma_khoahoc.unique' => 'Đã tồn tại mã khóa học này.',
            'ten_khoahoc.unique' => 'Đã tồn tại tên khóa học này.',
            'ten_khoahoc.required' => 'Vui lòng nhập tên khóa học.',
            'dia_diem_dang_ky.required' => 'Vui lòng nhập địa điểm đăng ký.',
            'ngay_khai_giang.required' => 'Vui lòng nhập ngày khai giảng.',
            'file.image' => 'File phải là hình ảnh.',
            'file.required' => 'Vui lòng thêm hình ảnh vào khóa học.',
        ];

        $request->validate([
            'dot_hoc' => 'required',
            'ma_khoahoc' => [
                'required',
                Rule::unique('khoahocs', 'ma_khoahoc')->where('dot_hoc', request('dot_hoc'))
            ],
            'ten_khoahoc' => [
                'required',
                Rule::unique('khoahocs', 'ten_khoahoc')->where('dot_hoc', request('dot_hoc'))
            ],
            'dia_diem_dang_ky' => 'required',
            'ngay_khai_giang' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Kiểm tra file hình ảnh
        ], $messages);

        $id = Auth::user()->id;
        $get_admin = User::find($id)->value('name');

        $image = $request->file('file');
        $destinationPath = 'images/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalName();
        $image->move($destinationPath, $profileImage);
        $data = "http://127.0.0.1:8000/images/$profileImage";

        Khoahoc::create([
            'dot_hoc' => $request->dot_hoc,
            'ma_khoahoc' => $request->ma_khoahoc,
            'ten_khoahoc' => $request->ten_khoahoc,
            'dia_diem_dang_ky' => $request->dia_diem_dang_ky,
            'ngay_khai_giang' => $request->ngay_khai_giang,
            'hinh_anh' => $data,
            'nguoi_dang_bai' => $get_admin,
            'loaikhoahoc_id' => $request->loaikhoahoc_id,
        ]);

        return redirect('khoahoc')->with('message', 'Thêm khóa học thành công!');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $khoahoc = Khoahoc::find($id);
        $loaikhoahoc = LoaiKhoahoc::all();
        return view('khoahoc-edit', compact('khoahoc', 'loaikhoahoc'));
    }


    public function update(Request $request, $id)
    {

        // dd($request);
        $messages = [
            'dot_hoc.required' => 'Vui lòng nhập đợt học.',
            'ma_khoahoc.required' => 'Vui lòng nhập mã khóa học.',
            'ma_khoahoc.unique' => 'Đã tồn tại mã khóa học này.',
            'ten_khoahoc.unique' => 'Đã tồn tại tên khóa học này.',
            'ten_khoahoc.required' => 'Vui lòng nhập tên khóa học.',
            'dia_diem_dang_ky.required' => 'Vui lòng nhập địa điểm đăng ký.',
            'ngay_khai_giang.required' => 'Vui lòng nhập ngày khai giảng.',
            'file.image' => 'File phải là hình ảnh.',
            'file.required' => 'Vui lòng thêm hình ảnh vào khóa học.',
        ];

        $request->validate([
            'dot_hoc' => 'required',
            'ma_khoahoc' => [
                'required',
                Rule::unique('khoahocs', 'ma_khoahoc')->where('dot_hoc', request('dot_hoc'))->ignore($id)
            ],
            'ten_khoahoc' => [
                'required',
                Rule::unique('khoahocs', 'ten_khoahoc')->where('dot_hoc', request('dot_hoc'))->ignore($id)
            ],
            'dia_diem_dang_ky' => 'required',
            'ngay_khai_giang' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Kiểm tra file hình ảnh
        ], $messages);

        $get_admin = User::find(Auth::user())->value('name');

        if (!$request->has('save_image')) {
            $request->validate(['file' => 'required'], $messages);
            $image = $request->file('file');
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $data = "http://127.0.0.1:8000/images/$profileImage";
        } else {
            $data = $request->save_image;
        }
        DB::table('khoahocs')->where('id', $id)->update([
            'dot_hoc' => $request->dot_hoc,
            'ma_khoahoc' => $request->ma_khoahoc,
            'ten_khoahoc' => $request->ten_khoahoc,
            'dia_diem_dang_ky' => $request->dia_diem_dang_ky,
            'ngay_khai_giang' => $request->ngay_khai_giang,
            'hinh_anh' => $data,
            'nguoi_dang_bai' => $get_admin,
            'loaikhoahoc_id' => $request->loaikhoahoc_id,
        ]);
        return redirect('khoahoc')->with('message', 'Cập nhật khóa học thành công !');
    }

    public function destroy($id)
    {
        DB::table('khoahocs')->where('id', $id)->update([
            'trangthai' => 1,
        ]);
        return redirect('khoahoc')->with('message', 'Xóa thành công');
    }
}
