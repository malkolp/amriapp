<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wali extends Model
{
    use HasFactory;

    public function student(): BelongsTo {
        return $this->belongsTo(Student::class);
    }

    public function paret(): BelongsTo {
        return $this->belongsTo(Paret::class);
    }
}
