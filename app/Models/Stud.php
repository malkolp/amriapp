<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stud extends Model
{
    use HasFactory;

    public function level(): BelongsTo {
        return $this->belongsTo(Level::class);
    }

    public function archive(): BelongsTo {
        return $this->belongsTo(Archive::class);
    }
}
