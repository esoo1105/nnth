<?php

namespace App\Http\Controllers;

use App\Imports\MauSinhVien;
use App\Models\SinhVien;
use App\Models\KhoaHoc;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use App\Imports\SinhVienImport;
use App\Models\DanhSachLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SinhVienController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkQuyen:Admin');
    }
    public function index()
    {

        $sinhvien = SinhVien::where('trangthai', 0)
            ->whereHas('khoahoc', function ($query) {
                $query->where('trangthai', 0);
            })
            ->get();
        return view('sinhvien', compact('sinhvien'));
    }


    public function create()
    {
        $khoahoc = Khoahoc::where('trangthai', 0)->get();
        return view('sinhvien-add', compact('khoahoc'));
    }

    public function store(Request $rq)
    {
        $messages = [
            'ho_dem.required' => 'Vui lòng nhập thông tin họ đệm.',
            'ten.required' => 'Vui lòng nhập thông tin tên.',
            'ma_sinh_vien.required' => 'Vui lòng nhập Mã số sinh viên.',
            'ma_sinh_vien.unique' => 'Mã số sinh viên đã tồn tại.',
            'ngay_sinh.required' => 'Vui lòng nhập Ngày sinh.',
            'gioi_tinh.required' => 'Vui lòng nhập Giới tính.',
            'thoi_gian_dang_ky.required' => 'Vui lòng nhập Thời gian đăng ký.',
            'so_tien_da_dong.required' => 'Vui lòng nhập Số tiền đã đóng.',
            'lop_danh_nghia.required' => 'Vui lòng nhập Lớp danh nghĩa.',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại.',
            'so_dien_thoai.required' => 'Vui lòng nhập Số điện thoại.',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là một số.',
            'email.required' => 'Vui lòng nhập Địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã tồn tài.',
            'khoahoc_id.required' => 'Vui lòng chọn Khóa học.',
        ];
        $rq->validate([
            'ma_sinh_vien' => [
                'required',
                Rule::unique('sinhviens', 'ma_sinh_vien')->where('khoahoc_id', request('khoahoc_id')),
            ],
            'so_dien_thoai' => [
                'numeric',
                'required',
                Rule::unique('sinhviens', 'so_dien_thoai')->where('khoahoc_id', request('khoahoc_id')),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('sinhviens', 'email')->where('khoahoc_id', request('khoahoc_id')),
            ],
            'ho_dem' => 'required',
            'ten' => 'required',
            'ngay_sinh' => 'required',
            'gioi_tinh' => 'required',
            'thoi_gian_dang_ky' => 'required',
            'lop_danh_nghia' => 'required',
            'so_tien_da_dong' => 'required',
            'so_tien_con_lai' => 'nullable',
            'ghi_chu' => 'nullable',
        ], $messages);

        SinhVien::create([
            'ma_sinh_vien' => $rq->ma_sinh_vien,
            'ho_dem' => $rq->ho_dem,
            'ten' => $rq->ten,
            'ngay_sinh' => $rq->ngay_sinh,
            'gioi_tinh' => $rq->gioi_tinh,
            'thoi_gian_dang_ky' => $rq->thoi_gian_dang_ky,
            'so_tien_da_dong' => $rq->so_tien_da_dong,
            'so_tien_con_lai' => $rq->so_tien_con_lai,
            'lop_danh_nghia' => $rq->lop_danh_nghia,
            'so_dien_thoai' => $rq->so_dien_thoai,
            'ghi_chu' => $rq->ghi_chu,
            'email' => $rq->email,
            'khoahoc_id' => $rq->khoahoc_id,
        ]);
        return redirect('sinhvien')->with('message', 'Thêm sinh viên thành công !');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $khoahoc = Khoahoc::where('trangthai', 0)->get();
        $sinhvien = SinhVien::all()->where('id', $id)->first();
        return view('sinhvien-edit', compact('sinhvien', 'khoahoc'));
    }
    public function update(Request $rq, $id)
    {
        $messages = [
            'ho_dem.required' => 'Vui lòng nhập thông tin họ đệm.',
            'ten.required' => 'Vui lòng nhập thông tin tên.',
            'ma_sinh_vien.required' => 'Vui lòng nhập Mã số sinh viên.',
            'ma_sinh_vien.unique' => 'Mã số sinh viên đã tồn tại.',
            'ngay_sinh.required' => 'Vui lòng nhập Ngày sinh.',
            'gioi_tinh.required' => 'Vui lòng nhập Giới tính.',
            'thoi_gian_dang_ky.required' => 'Vui lòng nhập Thời gian đăng ký.',
            'so_tien_da_dong.required' => 'Vui lòng nhập Số tiền đã đóng.',
            'lop_danh_nghia.required' => 'Vui lòng nhập Lớp danh nghĩa.',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại.',
            'so_dien_thoai.required' => 'Vui lòng nhập Số điện thoại.',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là một số.',
            'email.required' => 'Vui lòng nhập Địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã tồn tài.',
            'khoahoc_id.required' => 'Vui lòng chọn Khóa học.',
        ];
        $rq->validate([
            'ma_sinh_vien' => [
                'required',
                Rule::unique('sinhviens', 'ma_sinh_vien')->where('khoahoc_id', request('khoahoc_id'))->ignore($id),
            ],
            'so_dien_thoai' => [
                'numeric',
                'required',
                Rule::unique('sinhviens', 'so_dien_thoai')->where('khoahoc_id', request('khoahoc_id'))->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('sinhviens', 'email')->where('khoahoc_id', request('khoahoc_id'))->ignore($id),
            ],
            'ho_dem' => 'required',
            'ten' => 'required',
            'ngay_sinh' => 'required',
            'gioi_tinh' => 'required',
            'thoi_gian_dang_ky' => 'required',
            'lop_danh_nghia' => 'required',
            'so_tien_da_dong' => 'required',
            'so_tien_con_lai' => 'nullable',
            'ghi_chu' => 'nullable',
        ], $messages);

        DB::table('sinhviens')->where('id', $id)->update([
            'ma_sinh_vien' => $rq->ma_sinh_vien,
            'ho_dem' => $rq->ho_dem,
            'ten' => $rq->ten,
            'ngay_sinh' => $rq->ngay_sinh,
            'gioi_tinh' => $rq->gioi_tinh,
            'thoi_gian_dang_ky' => $rq->thoi_gian_dang_ky,
            'so_tien_da_dong' => $rq->so_tien_da_dong,
            'so_tien_con_lai' => $rq->so_tien_con_lai,
            'lop_danh_nghia' => $rq->lop_danh_nghia,
            'so_dien_thoai' => $rq->so_dien_thoai,
            'ghi_chu' => $rq->ghi_chu,
            'email' => $rq->email,
            'khoahoc_id' => $rq->khoahoc_id,
        ]);
        return redirect('sinhvien')->with('message', 'Cập nhật thông tin sinh viên thành công !');
    }


    public function destroy($id)
    {
        DB::table('sinhviens')->where('id', $id)->update([
            'trangthai' => 1,
        ]);
        return redirect('sinhvien')->with('message', 'Xóa thành công');
    }

    public function _import_csv(Request $request)
    {
        $import = new SinhVienImport;
        $check = $request->file('file');
        if ($check) {
            $path = $check->getRealPath();
            if (file_exists($path)) {
                Excel::import($import, $path);
                $getExisting = $import->getExisting();
                $getError = $import->getError();
                // dd($getError);
                if ($getError) {
                    return redirect('sinhvien')->with('error', 'Các trường trong file excel không trùng khớp với dữ liệu nhập. Vui lòng kiểm tra lại file excel và nhập theo mẫu');
                } else if (!$getExisting) {
                    // Import thành công
                    return redirect('sinhvien')->with('message', 'Dữ liệu đã được import thành công.');
                } else {
                    // Import không thành công
                    return redirect('sinhvien')->with('error', 'Dữ liệu không được import thành công. Có ' . $getExisting . ' dữ liệu bị trùng');
                }
            } else {
                return redirect('sinhvien')->with('error', 'Đường dẫn không tồn tại.');
            }
        } else {
            return redirect('sinhvien')->with('error', 'Không được để trống file excel');
        }
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Tìm kiếm sinh viên dựa trên từ khóa
        $sinhviens = SinhVien::where('ma_sinh_vien', 'like', "%$keyword%")->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($sinhviens);
    }
    public function exportSV()
    {
        return Excel::download(new MauSinhVien, 'dsdk.xlsx');
    }

}
