<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    use HasFactory;

    public function level(): BelongsTo {
        return $this->belongsTo(Level::class);
    }

//    public function grade(): HasOne {
//        return $this->hasOne(Grade::class);
//    }

//    public function group(): HasOne {
//        return $this->hasOne(Group::class);
//    }

//    public function subject(): HasOne {
//        return $this->hasOne(Subject::class);
//    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
}
