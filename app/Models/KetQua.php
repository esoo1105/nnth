<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class KetQua extends Model
{
    protected $table = 'ketquas';
    public $timestamps = false;

    protected $fillable = [
        'sinhvien_id',
        'diem_tin_hoc',
        'bang_tin_hoc',
        'diem_anh_van',
        'bang_anh_van',
    ];
    public function sinhvien()
    {
        return $this->belongsTo(SinhVien::class, 'sinhvien_id');
    }

}
