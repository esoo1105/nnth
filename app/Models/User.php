<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = false;

    protected $casts = [
        'chucvu' => ChucVu::class,
    ];
    protected $hidden = [
        'password'
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
        'quyen_id',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('H:i:s d-m-Y');
    }
    public function quyen()
    {
        return $this->belongsTo(Quyen::class, 'quyen_id');
    }
}

