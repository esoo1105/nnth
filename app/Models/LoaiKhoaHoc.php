<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiKhoaHoc extends Model
{

    protected $table = 'loaikhoahocs';
    public $timestamps = false;

    protected $fillable = [
        'ten_loaikhoahoc',
    ];
    

}