<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function teachers(): HasMany {
        return $this->hasMany(Teacher::class);
    }

    public function students(): HasMany {
        return $this->hasMany(Student::class);
    }

    public function staff(): HasMany {
        return $this->hasMany(Staff::class);
    }

    public function grades(): HasMany {
        return $this->hasMany(Grade::class);
    }

    public function groups(): HasMany {
        return $this->hasMany(Group::class);
    }

    public function studs(): HasMany {
        return $this->hasMany(Stud::class);
    }

    public function archives(): HasMany {
        return $this->hasMany(Archive::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($level) {
            $level->grades()->each(function ($grade) {
                $grade->groups()->each(function ($group) {
                    $group->students()->each(function ($student) {
                        $student->delete();
                    });
                    $group->delete();
                });
                $grade->delete();
            });
//            $level->studs()->each(function ($studs) {
//                $studs->delete();
//            });
        });
    }
}
