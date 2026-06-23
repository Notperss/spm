<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use LogsActivity, SoftDeletes;
    protected $fillable = [
        'name',
        'order',
        'direction',
        'position',
        'segment',
        'section',
        'hm1',
        'hm2',
        'km1',
        'km2',
        'description',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'order', 'direction', 'position', 'segment', 'section', 'hm1', 'hm2', 'km1', 'km2', 'description'])
            ->useLogName('Location')
            ->setDescriptionForEvent(fn (string $eventName) => "Location has been {$eventName}")
            ->logOnlyDirty()
            // ->dontLogIfAttributesChangedOnly(['last_activity', 'is_logged_in'])
            ->dontLogEmptyChanges()
            // ->dontSubmitEmptyLogs()
        ;
    }
}
