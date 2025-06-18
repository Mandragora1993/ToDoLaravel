<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Task extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'priority', 
        'status', 
        'due_date',
        'is_important'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publicLinks()
    {
        return $this->hasMany(TaskPublicLink::class);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Task został {$eventName}";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'name', 'description', 'priority', 'status', 'due_date', 'is_important'])
            ->logOnlyDirty()
            ->useLogName('task');
    }
}