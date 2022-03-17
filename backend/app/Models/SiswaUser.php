<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SiswaUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'siswa';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function jawaban() {
        return $this->hasMany(Jawaban::class, 'siswa_id', 'id');
    }
}
