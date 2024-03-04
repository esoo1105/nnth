<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    protected $table = 'khoahocs';
    public $timestamps = false;
    protected $fillable = [
        'dot_hoc',
        'ma_khoahoc',
        'ten_khoahoc',
        'nguoi_dang_bai',
        'ngay_khai_giang',
        'dia_diem_dang_ky',
        'hinh_anh',
        'loaikhoahoc_id',
    ];
    public function loaikhoahoc()
    {
        return $this->belongsTo(LoaiKhoaHoc::class, 'loaikhoahoc_id');
    }
}
