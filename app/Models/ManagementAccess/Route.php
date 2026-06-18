<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'route',
        'permission_name',
        'status',
        'description',
    ];
    protected $casts = ['status' => 'boolean'];
}
