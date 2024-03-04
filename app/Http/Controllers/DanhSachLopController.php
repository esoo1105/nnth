<?php

namespace App\Http\Controllers;

use App\Models\DanhSachLop;
use App\Models\SinhVien;
use App\Models\KhoaHoc;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use App\Imports\DanhSachLopImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Imports\MauDanhSachLop;

class DanhSachLopController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkQuyen:Admin');
    }
    public function index()
    {
        //
        $danhsachlop = DanhSachLop::whereHas('khoahoc', function ($query) {
            $query->where('trangthai', 0);
        })->get();
        return view('danhsachlop', compact('danhsachlop'));
    }


    public function create()
    {
        $khoahoc = Khoahoc::where('trangthai', 0)->get();
        return view('danhsachlop-add', compact('khoahoc'));
    }

    public function store(Request $rq)
    {
        $messages = [
            'co_so.required' => 'Vui lòng nhập thông tin cơ sở.',
            'lop_hoc.required' => 'Vui lòng nhập thông tin lớp học.',
            'ma_sinh_vien.required' => 'Vui lòng nhập thông tin mã sinh viên.',
            'ho_dem.required' => 'Vui lòng nhập thông tin họ đệm.',
            'ten.required' => 'Vui lòng nhập thông tin tên.',
            'lop_danh_nghia.required' => 'Vui lòng nhập thông tin lớp danh nghĩa.',
            'gioi_tinh.required' => 'Vui lòng nhập thông tin giới tính.',
            'ngay_sinh.required' => 'Vui lòng nhập thông tin ngày sinh.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là số.',
        ];
        $rq->validate([
            'ma_sinh_vien' => [
                'required',
                Rule::unique('danhsachlophocs', 'ma_sinh_vien')->where('khoahoc_id', request('khoahoc_id')),
            ],
            'so_dien_thoai' => [
                'numeric',
                'required',
                Rule::unique('danhsachlophocs', 'so_dien_thoai')->where('khoahoc_id', request('khoahoc_id')),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('danhsachlophocs', 'email')->where('khoahoc_id', request('khoahoc_id')),
            ],
            'co_so' => 'required',
            'lop_hoc' => 'required',
            'ho_dem' => 'required',
            'ten' => 'required',
            'lop_danh_nghia' => 'required',
            'gioi_tinh' => 'required',
            'ngay_sinh' => 'required',
            'ghi_chu' => 'nullable',
        ], $messages);

        DanhSachLop::create([
            'co_so' => $rq->co_so,
            'lop_hoc' => $rq->lop_hoc,
            'ma_sinh_vien' => $rq->ma_sinh_vien,
            'ho_dem' => $rq->ho_dem,
            'ten' => $rq->ten,
            'lop_danh_nghia' => $rq->lop_danh_nghia,
            'gioi_tinh' => $rq->gioi_tinh,
            'ngay_sinh' => $rq->ngay_sinh,
            'so_dien_thoai' => $rq->so_dien_thoai,
            'email' => $rq->email,
            'khoahoc_id' => $rq->khoahoc_id,
            'ghi_chu' => $rq->ghi_chu,
        ]);
        return redirect('danhsachlop')->with('message', 'Thêm thành viên vào danh sách lớp thành công !');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $khoahoc = Khoahoc::where('trangthai', 0)->get();
        $danhsachlop = DanhSachLop::all()->where('id', $id)->first();
        return view('danhsachlop-edit', compact('danhsachlop', 'khoahoc'));
    }


    public function update(Request $rq, $id)
    {
        $messages = [
            'co_so.required' => 'Vui lòng nhập thông tin cơ sở.',
            'lop_hoc.required' => 'Vui lòng nhập thông tin lớp học.',
            'ma_sinh_vien.required' => 'Vui lòng nhập thông tin mã sinh viên.',
            'ho_dem.required' => 'Vui lòng nhập thông tin họ đệm.',
            'ten.required' => 'Vui lòng nhập thông tin tên.',
            'lop_danh_nghia.required' => 'Vui lòng nhập thông tin lớp danh nghĩa.',
            'gioi_tinh.required' => 'Vui lòng nhập thông tin giới tính.',
            'ngay_sinh.required' => 'Vui lòng nhập thông tin ngày sinh.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là số.',
        ];
        $rq->validate([
            'ma_sinh_vien' => [
                'required',
                Rule::unique('danhsachlophocs', 'ma_sinh_vien')->where('khoahoc_id', request('khoahoc_id'))->ignore($id),
            ],
            'so_dien_thoai' => [
                'numeric',
                'required',
                Rule::unique('danhsachlophocs', 'so_dien_thoai')->where('khoahoc_id', request('khoahoc_id'))->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('danhsachlophocs', 'email')->where('khoahoc_id', request('khoahoc_id'))->ignore($id),
            ],
            'co_so' => 'required',
            'lop_hoc' => 'required',
            'ho_dem' => 'required',
            'ten' => 'required',
            'lop_danh_nghia' => 'required',
            'gioi_tinh' => 'required',
            'ngay_sinh' => 'required',
            'ghi_chu' => 'nullable',
        ], $messages);
        DB::table('danhsachlophocs')->where('id', $id)->update([
            'co_so' => $rq->co_so,
            'lop_hoc' => $rq->lop_hoc,
            'ma_sinh_vien' => $rq->ma_sinh_vien,
            'ho_dem' => $rq->ho_dem,
            'ten' => $rq->ten,
            'lop_danh_nghia' => $rq->lop_danh_nghia,
            'gioi_tinh' => $rq->gioi_tinh,
            'ngay_sinh' => $rq->ngay_sinh,
            'so_dien_thoai' => $rq->so_dien_thoai,
            'email' => $rq->email,
            'khoahoc_id' => $rq->khoahoc_id,
            'ghi_chu' => $rq->ghi_chu,
        ]);
        return redirect('danhsachlop')->with('message', 'Cập nhật danh sách lớp thành công !');
    }


    public function destroy($id)
    {
        Danhsachlop::destroy($id);
        return redirect('danhsachlop')->with('message', 'Xóa thành công');
    }

    public function import_csv(Request $request)
    {
        $import = new DanhSachLopImport;
        $check = $request->file('file');
        if ($check) {
            $path = $check->getRealPath();
            if (file_exists($path)) {
                Excel::import($import, $path);
                $getExisting = $import->getExisting();
                $getError = $import->getError();
                if ($getError) {
                    return redirect('danhsachlop')->with('error', 'Các trường trong file excel không trùng khớp với dữ liệu nhập. Vui lòng kiểm tra lại file excel và nhập theo mẫu');
                } else if (!$getExisting) {
                    // Import thành công
                    return redirect('danhsachlop')->with('message', 'Dữ liệu đã được import thành công.');
                } else {
                    // Import không thành công
                    return redirect('danhsachlop')->with('error', 'Dữ liệu không được import thành công. Có ' . $getExisting . ' dữ liệu bị trùng');
                }
            } else {
                return redirect('danhsachlop')->with('error', 'Đường dẫn không tồn tại.');
            }
        } else {
            return redirect('danhsachlop')->with('error', 'Không được để trống file excel');
        }
    }
    public function exportDSL()
    {
        return Excel::download(new MauDanhSachLop, 'dsl.xlsx');
    }

    public function sinhvienchuadangky()
    {
        $danhsachlops = DanhSachLop::select('khoahoc_id', 'lop_hoc')
            ->whereHas('khoahoc', function ($query) {
                $query->where('trangthai', 0);
            })
            ->groupBy('khoahoc_id', 'lop_hoc')
            ->get();

        return view('sinhvienchuadangky', compact('danhsachlops'));
    }

    public function chitietdssvcdk($id)
    {
        $sinhVienKhongCoTrongLop = DanhSachLop::where('khoahoc_id', $id)
            ->whereNotIn('ma_sinh_vien', function ($query) use ($id) {
                $query->select('ma_sinh_vien')
                    ->from('sinhviens')
                    ->where('khoahoc_id', $id)
                    ->where('trangthai', 0);
            })
            ->get();
        $thongtin = DanhSachLop::where('khoahoc_id', $id)->first();
        $count = $sinhVienKhongCoTrongLop->count();
        return view('chitietdssvcdk', compact('sinhVienKhongCoTrongLop', 'count', 'thongtin'));
    }
}
