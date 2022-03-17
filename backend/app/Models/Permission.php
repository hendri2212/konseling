<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $append = [
        'permission_merge'
    ];

    public function service() {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function getPermissionMergeAttribute() {
        // return null;
        // $service = Service::find($this->service_id);
        return $this->service->service . '.' . $this->permission;
    }
}
