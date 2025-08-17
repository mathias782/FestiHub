<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','location','description','starts_at','ends_at','capacity','image_path'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
    ];

    // Users die optreden op dit event
    public function performers()
    {
        return $this->belongsToMany(User::class, 'event_performer');
    }

    // Users die ingeschreven zijn als bezoeker
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_registrations')->withTimestamps();
    }

    public function spotsLeft(): int
    {
        return max(0, $this->capacity - $this->attendees()->count());
    }
}
