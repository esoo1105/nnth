<?php

namespace App\Imports;

use App\Models\KhoaHoc;
use App\Models\SinhVien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SinhVienImport implements ToModel, WithHeadingRow
{
    private $existing;
    private $error;
    protected $khoahocs;

    public function __construct()
    {
        $this->existing = 0;
        $this->error = 0;
    }
    public function model(array $row)
    {
        try {
            $check = KhoaHoc::where(function ($query) use ($row) {
                $query->where('ma_khoahoc', $row['ma_lop_hoc_phan'])
                      ->where('dot_hoc', $row['dot_hoc']);
            })->value('id');
            if ($check) {
                $existingStudent = SinhVien::where(function ($query) use ($row) {
                    $query->where('ma_sinh_vien', $row['ma_sinh_vien'])
                          ->orWhere('email', $row['email'])
                          ->orWhere('so_dien_thoai', $row['so_dien_thoai']);
                })
                ->where('khoahoc_id', $check)
                ->first();
    
                if (!$existingStudent) {
                    return new SinhVien([
                        'ma_sinh_vien' => $row['ma_sinh_vien'],
                        'ho_dem' => $row['ho_dem'],
                        'ten' => $row['ten'],
                        'lop_danh_nghia' => $row['lop_danh_nghia'],
                        'gioi_tinh' => $row['gioi_tinh'],
                        'ngay_sinh' => $row['ngay_sinh'],
                        'so_dien_thoai' => $row['so_dien_thoai'],
                        'thoi_gian_dang_ky' => $row['ngay_dang_ky'],
                        'email' => $row['email'],
                        'ghi_chu' => $row['ghi_chu'],
                        'so_tien_da_dong' => $row['so_tien_da_dong'],
                        'so_tien_con_lai' => $row['so_tien_con_lai'],
                        'khoahoc_id' => $check,
                    ]);
                } else {
                    $this->existing++;
                }
            }
        } catch (\Exception $e) {
            $this->error++;
        }
    }
    public function getExisting()
    {
        return $this->existing;
    }
    public function getError()
    {
        return $this->error;
    }
}
