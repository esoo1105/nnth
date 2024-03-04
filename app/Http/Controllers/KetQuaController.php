<?php

namespace App\Http\Controllers;

use App\Models\KetQua;
use App\Models\SinhVien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KetQuaController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkQuyen:Admin');
    }
    public function index()
    {
        $ketqua = Ketqua::all();
        return view('ketqua', compact('ketqua'));
    }

    public function create()
    {
        $sinhvien = SinhVien::select('id', 'ma_sinh_vien', 'ho_dem', 'ten')
            ->distinct('ma_sinh_vien')
            ->get();

        return view('ketqua-add', compact('sinhvien'));
    }


    public function store(Request $request)
    {
        $messages = [
            'sinhvien_id.unique' => 'Thông tin sinh viên này đã tồn tại',
            'diem_tin_hoc.numeric' => 'Điểm tin học phải là số.',
            'diem_anh_van.numeric' => 'Điểm Anh văn phải là số.',
        ];
        $request->validate([
            'sinhvien_id' => 'required|unique:ketquas,sinhvien_id',
            'diem_tin_hoc' => 'nullable',
            'bang_tin_hoc' => 'nullable',
            'diem_anh_van' => 'nullable',
            'bang_anh_van' => 'nullable',
        ], $messages);

        Ketqua::create([
            'sinhvien_id' => $request->sinhvien_id,
            'diem_tin_hoc' => $request->diem_tin_hoc,
            'bang_tin_hoc' => $request->bang_tin_hoc,
            'diem_anh_van' => $request->diem_anh_van,
            'bang_anh_van' => $request->bang_anh_van,
        ]);
        return redirect('ketqua')->with('message', 'Thêm kết quả thành công !');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $sinhvien = SinhVien::select('id', 'ma_sinh_vien', 'ho_dem', 'ten')
            ->distinct('ma_sinh_vien')
            ->get();
        $ketqua = Ketqua::all()->where('id', $id)->first();
        return view('ketqua-edit', compact('ketqua', 'sinhvien'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'sinhvien_id,unique' => 'Thông tin sinh viên này đã tồn tại',
            'diem_tin_hoc.numeric' => 'Điểm tin học phải là số.',
            'diem_anh_van.numeric' => 'Điểm Anh văn phải là số.',
        ];
        $request->validate([
            Rule::unique('ketquas', 'sinhvien_id')->ignore($id),
            'diem_tin_hoc' => 'nullable|numeric',
            'bang_tin_hoc' => 'nullable',
            'diem_anh_van' => 'nullable|numeric',
            'bang_anh_van' => 'nullable',
        ], $messages);

        DB::table('ketquas')->where('id', $id)->update([
            'sinhvien_id' => $request->sinhvien_id,
            'diem_tin_hoc' => $request->diem_tin_hoc,
            'bang_tin_hoc' => $request->bang_tin_hoc,
            'diem_anh_van' => $request->diem_anh_van,
            'bang_anh_van' => $request->bang_anh_van,
        ]);

        return redirect('ketqua')->with('message', 'Cập nhật kết quả thành công !');

    }

    public function destroy($id)
    {
        Ketqua::destroy($id);
        return redirect('ketqua')->with('message', 'Xóa thành công');
    }
}
