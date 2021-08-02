<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    use HasFactory;

//    public function teachers(): HasMany {
//        return $this->hasMany(Teacher::class);
//    }

    public function students(): HasMany {
        return $this->hasMany(Student::class);
    }

//    public function user(): BelongsTo {
//        return $this->belongsTo(User::class);
//    }

    public function level(): BelongsTo {
        return $this->belongsTo(Level::class);
    }

    public function grade(): BelongsTo {
        return $this->belongsTo(Grade::class);
    }
}
