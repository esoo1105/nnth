<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table = 'sinhviens';
    public $timestamps = false;

    protected $fillable = [
        'ma_sinh_vien',
        'ho_dem',
        'ten',
        'lop_danh_nghia',
        'gioi_tinh',
        'ngay_sinh',
        'so_tien_da_dong',
        'so_tien_con_lai',
        'ghi_chu',
        'lop_danh_nghia',
        'so_dien_thoai',
        'email',
        'thoi_gian_dang_ky',
        'khoahoc_id',
    ];

    public function khoahoc()
    {
        return $this->belongsTo(Khoahoc::class, 'khoahoc_id');
    }

    public function danhsachlops()
    {
        return $this->hasMany(DanhSachLop::class, 'ma_sinh_vien', 'ma_sinh_vien');
    }
}
