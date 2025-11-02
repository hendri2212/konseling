<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'teachers';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function school()
    {
        // Teacher belongs to a School via teachers.school_id -> schools.id
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function class()
    {
        return $this->hasOne(ClassModel::class, 'teacher_id', 'id');
    }
}
