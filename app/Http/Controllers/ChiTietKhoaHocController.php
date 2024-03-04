<?php

namespace App\Http\Controllers;

use App\Models\Chitietkhoahoc;
use App\Models\Khoahoc;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Enums\ChucVu;

class ChitietkhoahocController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkQuyen:Admin');
    }
    public function index()
    {
        $chitietkhoahoc = Chitietkhoahoc::whereHas('khoahoc', function ($query) {
            $query->where('trangthai', 0);
        })->get();
        return view('chitietkhoahoc', compact('chitietkhoahoc'));
    }

    public function create()
    {
        $khoahoc = Khoahoc::where('trangthai', 0)->get();
        $giangvien = User::whereHas('quyen', function ($query) {
            $query->where('ten_quyen', 'Giảng viên');
        })->get();
        return view('chitietkhoahoc-add', compact('khoahoc', 'giangvien'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $messages = [
            'thoi_gian_bat_dau.required' => 'Vui lòng nhập thời gian bắt đầu.',
            'thoi_gian_ket_thuc.required' => 'Vui lòng nhập thòi gian kết thúc.',
            'khoahoc_id.unique' => 'Đã tồn tại chi tiết khóa học này.',
            'thoi_gian_hoc.required' => 'Vui lòng nhập thời gian học.',
            'so_tiet_hoc.required' => 'Vui lòng nhập số tiết học.',
            'dia_diem_hoc.required' => 'Vui lòng nhập địa địa điểm học.',
            'hoc_phi.required' => 'Vui lòng nhập học phí.',
            'thu_hoc.required' => 'Vui lòng nhập thông tin thứ học.',
        ];

        $request->validate([
            'khoahoc_id' => 'required|unique:chitietkhoahocs,khoahoc_id',
            'thoi_gian_bat_dau' => 'required',
            'thoi_gian_ket_thuc' => 'required',
            'thoi_gian_hoc' => 'required',
            'so_tiet_hoc' => 'required',
            'dia_diem_hoc' => 'required',
            'hoc_phi' => 'required',
            'thu_hoc' => 'required',
        ], $messages);

        Chitietkhoahoc::create([
            'khoahoc_id' => $request->khoahoc_id,
            'thoi_gian_bat_dau' => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc' => $request->thoi_gian_ket_thuc,
            'thoi_gian_hoc' => $request->thoi_gian_hoc,
            'so_tiet_hoc' => $request->so_tiet_hoc,
            'dia_diem_hoc' => $request->dia_diem_hoc,
            'thu_hoc' => $request->thu_hoc,
            'giangvien_id' => $request->giangvien_id,
            'hoc_phi' => $request->hoc_phi,

        ]);
        return redirect('chitietkhoahoc')->with('message', 'Thêm thông tin chi tiết khóa học thành công !');

    }


    public function show($id)
    {
        $chitietkhoahoc = Chitietkhoahoc::where('id', $id)->get();
        // dd($chitietkhoahoc);
        return view('chitietkhoahoc', compact('chitietkhoahoc'));
    }


    public function edit($id)
    {
        $khoahoc = Khoahoc::where('trangthai', 0)->get();
        $giangvien = User::whereHas('quyen', function ($query) {
            $query->where('ten_quyen', 'Giảng viên');
        })->get();
        $chitietkhoahoc = Chitietkhoahoc::find($id);
        return view('chitietkhoahoc-edit', compact('chitietkhoahoc', 'khoahoc', 'giangvien'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'thoi_gian_bat_dau.required' => 'Vui lòng nhập thời gian bắt đầu.',
            'thoi_gian_ket_thuc.required' => 'Vui lòng nhập thòi gian kết thúc.',
            'khoahoc_id.unique' => 'Đã tồn tại chi tiết khóa học này.',
            'thoi_gian_hoc.required' => 'Vui lòng nhập thời gian học.',
            'so_tiet_hoc.required' => 'Vui lòng nhập số tiết học.',
            'dia_diem_hoc.required' => 'Vui lòng nhập địa địa điểm học.',
            'hoc_phi.required' => 'Vui lòng nhập học phí.',
            'thu_hoc.required' => 'Vui lòng nhập thông tin thứ học.',
        ];
        $request->validate([
            'khoahoc_id' => [
                'required',
                Rule::unique('chitietkhoahocs', 'id')->ignore($id)
            ],
            'thoi_gian_bat_dau' => 'required',
            'thoi_gian_ket_thuc' => 'required',
            'thoi_gian_hoc' => 'required',
            'so_tiet_hoc' => 'required',
            'dia_diem_hoc' => 'required',
            'hoc_phi' => 'required',
            'thu_hoc' => 'required',
        ], $messages);

        DB::table('chitietkhoahocs')->where('id', $id)->update([
            'khoahoc_id' => $request->khoahoc_id,
            'thoi_gian_bat_dau' => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc' => $request->thoi_gian_ket_thuc,
            'thoi_gian_hoc' => $request->thoi_gian_hoc,
            'so_tiet_hoc' => $request->so_tiet_hoc,
            'dia_diem_hoc' => $request->dia_diem_hoc,
            'thu_hoc' => $request->thu_hoc,
            'giangvien_id' => $request->giangvien_id,
            'hoc_phi' => $request->hoc_phi,
        ]);
        return redirect('chitietkhoahoc')->with('message', 'Cập nhật thông tin chi tiết khóa học thành công !');

    }
    public function destroy($id)
    {
        Chitietkhoahoc::destroy($id);
        return redirect('chitietkhoahoc')->with('message', 'Xóa thành công');
    }
}
