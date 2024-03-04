<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DanhSachLop extends Model
{
    protected $table = 'danhsachlophocs';
    public $timestamps = false;

    protected $fillable = [
        'co_so',
        'lop_hoc',
        'ma_sinh_vien',
        'ho_dem',
        'ten',
        'lop_danh_nghia',
        'gioi_tinh',
        'ngay_sinh',
        'so_dien_thoai',
        'email',
        'ghi_chu',
        'khoahoc_id',
    ];

    public function khoahoc()
    {
        return $this->belongsTo(Khoahoc::class, 'khoahoc_id');
    }
}
