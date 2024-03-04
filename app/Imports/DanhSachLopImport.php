<?php

namespace App\Imports;

use App\Models\KhoaHoc;
use App\Models\DanhSachLop;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DanhSachLopImport implements ToModel, WithHeadingRow
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
            // dd($row);
            $check = KhoaHoc::where(function ($query) use ($row) {
                $query->where('ma_khoahoc', $row['ma_lop_hoc_phan'])
                    ->where('dot_hoc', $row['dot_hoc']);
            })->value('id');
            // dd($check);
            if ($check) {
                $existingStudent = DanhSachLop::where(function ($query) use ($row) {
                    $query->where('ma_sinh_vien', $row['ma_sinh_vien'])
                        ->orWhere('email', $row['email'])
                        ->orWhere('so_dien_thoai', $row['so_dien_thoai']);
                })
                    ->where('khoahoc_id', $check)
                    ->first();

                if (!$existingStudent) {
                    return new DanhSachLop([
                        'co_so' => $row['co_so'],
                        'lop_hoc' => $row['lop_hoc'],
                        'ma_sinh_vien' => $row['ma_sinh_vien'],
                        'ho_dem' => $row['ho_dem'],
                        'ten' => $row['ten'],
                        'lop_danh_nghia' => $row['lop_danh_nghia'],
                        'gioi_tinh' => $row['gioi_tinh'],
                        'ngay_sinh' => $row['ngay_sinh'],
                        'so_dien_thoai' => $row['so_dien_thoai'],
                        'email' => $row['email'],
                        'ghi_chu' => $row['ghi_chu'],
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
