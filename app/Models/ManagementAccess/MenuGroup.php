<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'route',
        'permission_name',
        'order',
        'status',
        'child_menu',
    ];

    protected $casts = [
        'status' => 'boolean',
        'child_menu' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }
}
