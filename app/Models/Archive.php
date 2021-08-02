<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Archive extends Model
{
    use HasFactory;

    public function studs(): HasMany {
        return $this->hasMany(Stud::class);
    }

    public function level(): BelongsTo {
        return $this->belongsTo(Level::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($archive) {
            $archive->studs()->each(function ($stud) {
                $stud->delete();
            });
        });
    }
}
