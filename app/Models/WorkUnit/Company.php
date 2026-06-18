<?php

namespace App\Models\WorkUnit;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'phone',
        'email',
        'address',
        'logo_path',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
