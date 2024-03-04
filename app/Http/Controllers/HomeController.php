<?php

namespace App\Http\Controllers;

use App\Models\Khoahoc;
use App\Models\LoaiKhoahoc;
use App\Models\ChiTietKhoaHoc;
use App\Models\DanhSachLop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    //
    public function index()
    {
        $loaiKhoahocs = Loaikhoahoc::pluck('ten_loaikhoahoc')->toArray();
        $khoahocs = [];
        foreach ($loaiKhoahocs as $loaiKhoahoc) {
            $khoahocs[$loaiKhoahoc] = Khoahoc::whereHas('loaikhoahoc', function ($query) use ($loaiKhoahoc) {
                $query->where('ten_loaikhoahoc', $loaiKhoahoc)
                    ->where('trangthai', '0');
            })->get();
        }
        return view('index', compact('khoahocs'));
    }
    public function searchKH(Request $request)
    {
        $keyword = $request->input('keyword');
        $loaiKhoahocs = Loaikhoahoc::pluck('ten_loaikhoahoc')->toArray();
        $khoahocs = [];
        foreach ($loaiKhoahocs as $loaiKhoahoc) {
            $khoahocs[$loaiKhoahoc] = Khoahoc::whereHas('loaikhoahoc', function ($query) use ($loaiKhoahoc) {
                $query->where('ten_loaikhoahoc', $loaiKhoahoc)
                    ->where('trangthai', '0');
            })
                ->where(function ($query) use ($keyword) {
                    $query->where('ten_khoahoc', 'like', "%$keyword%")
                        ->orWhere('ma_khoahoc', 'like', "%$keyword%");
                })
                ->get();
        }
        return view('index', compact('khoahocs'));
    }
    public function chitiet($id)
    {

        $chitietkhoahoc = ChiTietKhoaHoc::where('khoahoc_id', $id)->first();
        // dd($chitietkhoahoc);
        if ($chitietkhoahoc) {
            return view('chitiet', compact('chitietkhoahoc'));
        } else {
            // Nếu không tồn tại, hiển thị thông báo và chuyển hướng về trang khác (ví dụ: trang cập nhật khóa học)
            return redirect('/')->with('message', 'Chi tiết khóa học này đang được cập nhật');
        }
    }
    public function lichdayhoc()
    {
        $user = Auth::user();
        if ($user) {

            if ($user->quyen->ten_quyen === 'Giảng viên') {
                // Nếu là giảng viên, hiển thị chỉ chi tiết khóa học của giảng viên đó
                $chitietkhoahoc = Chitietkhoahoc::where('giangvien_id', $user->id)->get();
            } else {
                // Nếu là admin, hiển thị tất cả chi tiết khóa học
                $chitietkhoahoc = Chitietkhoahoc::whereHas('khoahoc', function ($query) {
                    $query->where('trangthai', 0);
                })->get();
            }
            return view('lichdayhoc', compact('chitietkhoahoc'));
        } else {
            return redirect('login');
        }
    }
    public function tracuudiem()
    {
        $ketqua = null;
        return view('tracuudiem', compact('ketqua'));
    }
    public function searchLH(Request $request)
    {
        $keyword = $request->input('keyword');

        $chitietkhoahoc = Chitietkhoahoc::whereHas('khoahoc', function ($query) use ($keyword) {
            $query->where('ma_khoahoc', 'like', "%$keyword%");
        })
            ->orWhereHas('giangvien', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->get();

        return view('lichhoc', compact('chitietkhoahoc'));
    }

    public function lichhoc()
    {
        $chitietkhoahoc = Chitietkhoahoc::whereHas('khoahoc', function ($query) {
            $query->where('trangthai', 0);
        })->get();
        return view('lichhoc', compact('chitietkhoahoc'));
    }

    public function chitietdssv($id)
    {
        $danhsachlop = DanhSachLop::where('khoahoc_id', $id)->first();
        if ($danhsachlop) {
            $danhsachlop = DanhSachLop::where('khoahoc_id', $id)->get();
            $thongtin = DanhSachLop::where('khoahoc_id', $id)->first();
            $count = DanhSachLop::where('khoahoc_id', $id)->count();
            return view('chitietdssv', compact('danhsachlop', 'count', 'thongtin'));
        } else {
            // Nếu không tồn tại, hiển thị thông báo và chuyển hướng về trang khác (ví dụ: trang cập nhật khóa học)
            return redirect()->back()->with('message', 'Danh sách lớp đang được cập nhật');
        }

    }
}
