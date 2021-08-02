<?php /** @noinspection PhpUndefinedFieldInspection */


namespace App\Http\back;


use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;

class _School
{
    private static $alpha = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

    public static function make($type, $group_amount, $student_quota): Level {
        if ($type == 'sma' || $type == 'smp')
            $grade_amount = 3;
        elseif ($type == 'sd')
            $grade_amount = 6;
        else
            $grade_amount = 2;
        $level = new Level();
        $level->name  = $type;
        $level->room  = $group_amount;
        $level->quota = $student_quota;
        $level->save();
        self::grades($level, $grade_amount, $group_amount);

        return $level;
    }

    private static function grades($level, $amount = 0, $group = 0) {
        $iter = 0;
        while ($iter < $amount) {
            $grade = new Grade();
            $grade->grade = $iter + 1;
            $grade->level()->associate($level);
            $grade->save();
            self::groups($level, $grade, $group);
            $iter++;
        }
    }

    private static function groups($level, $grade, $amount = 0) {
        $iter = 0;
        while ($iter < $amount) {
            $group = new Group();
            $group->name = self::$alpha[$iter];
            $group->level()->associate($level);
            $group->grade()->associate($grade);
            $group->save();
            $iter++;
        }
    }
}
