<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    // ... các thuộc tính và phương thức khác
    protected $fillable = [
        'ten_quyen',
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }
}