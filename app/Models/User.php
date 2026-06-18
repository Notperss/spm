<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name',
    'username',
    'company_id',
    'division_id',
    'profile_photo_path',
    'email', 'password',
    'is_logged_in',
    'last_activity'])]

#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['company_id', 'division_id', 'name', 'username', 'email', 'profile_photo_path'])
            ->useLogName('User')
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}")
            ->logOnlyDirty()
            // ->dontLogIfAttributesChangedOnly(['last_activity', 'is_logged_in'])
            ->dontLogEmptyChanges()
            // ->dontSubmitEmptyLogs()
        ;
    }

}
