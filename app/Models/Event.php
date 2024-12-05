<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        "name","user_id","location_id","description","start_time","end_time"
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function attendees(array $options = []): HasMany {
        return $this->hasMany(Attendee::class);
    }

    public function location(): BelongsTo {
        return $this->belongsTo(Location::class);
    }
}
