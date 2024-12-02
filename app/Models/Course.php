<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;
    //
    protected $fillable = ["name","description"];

    public function teachers(): BelongsToMany {
        return $this->belongsToMany(Teacher::class);
    }
}
