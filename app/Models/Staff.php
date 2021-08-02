<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use HasFactory;

    public function level(): HasOne {
        return $this->hasOne(Level::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
