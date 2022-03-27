<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class SekolahUser extends Authenticatable 
// implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'sekolah';
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

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function getAbilitiesAttribute() {
        if ($this->role_id == null) {
            return [];
        }
        $abilities = RolePermission::select(DB::raw("concat(services.service, '.', permissions.permission) as abilities"))
        ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
        ->join('services', 'services.id', '=', 'permissions.service_id')
        ->where('role_permissions.role_id', $this->role_id)->get()->pluck('abilities')->toArray();
        return $abilities;
    }
}
