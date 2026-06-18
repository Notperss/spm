<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
  protected $fillable = [
    'menu_group_id',
    'name',
    'icon',
    'route',
    'permission_name',
    'order',
    'status',
  ];

  protected $casts = [
    'status' => 'boolean',
  ];

  public function menuGroup()
  {
    return $this->belongsTo(MenuGroup::class);
  }
}
