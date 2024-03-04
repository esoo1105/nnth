<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ChiTietKhoaHoc extends Model
{
    protected $table = 'chitietkhoahocs';
    public $timestamps = false;

    protected $fillable = [
        'khoahoc_id',
        'thoi_gian_hoc',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'so_tiet_hoc',
        'dia_diem_hoc',
        'thu_hoc',
        'giangvien_id',
        'hoc_phi',
    ];

    public function khoahoc()
    {
        return $this->belongsTo(Khoahoc::class, 'khoahoc_id');
    }
    public function giangvien()
    {
        return $this->belongsTo(User::class, 'giangvien_id');
    }


}
