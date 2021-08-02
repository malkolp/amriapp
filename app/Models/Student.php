<?php
/** @noinspection SpellCheckingInspection */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    public function scores(): HasMany {
        return $this->hasMany(Score::class);
    }

    public function walis(): HasMany {
        return $this->hasMany(Wali::class);
    }

    public function level(): BelongsTo {
        return $this->belongsTo(Level::class);
    }

    public function grade(): BelongsTo {
        return $this->belongsTo(Grade::class);
    }

    public function registrations(): HasMany {
        return $this->hasMany(Registration::class);
    }

    public function group(): BelongsTo {
        return $this->belongsTo(Group::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($student) {
            $registration = $student->registrations()->first();
            $registration->delete();
            $student->walis()->each(function ($wali) {
                $parent = $wali->paret();
                $wali->delete();
//                if ($parent->walis()->count() == 0)
//                    $parent->delete();
            });
        });
    }
}
