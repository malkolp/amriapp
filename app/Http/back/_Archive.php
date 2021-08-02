<?php /** @noinspection PhpUndefinedFieldInspection */


namespace App\Http\back;


use App\Models\Archive;
use App\Models\Level;
use App\Models\Stud;

class _Archive
{
    public static function make($level): Level {
        $archive  = new Archive();
        $archive->level()->associate($level);
        $archive->save();
        $students = $level->students()->get();
        foreach ($students as $student) {
            if ($student->registrations()->first()->verified) {
                $stud = new Stud();

                $stud->citizen_identity = $student->citizen_identity;
                $stud->name             = $student->name;
                $stud->gender           = $student->gender;
                $stud->day_birth        = $student->day_birth;
                $stud->month_birth      = $student->month_birth;
                $stud->year_birth       = $student->year_birth;
                $stud->place_birth      = $student->place_birth;
                $stud->address          = $student->address;
                $stud->religion         = $student->religion;
                $stud->pic              = $student->pic;
                $stud->grade            = $student->grade->grade;
                $stud->group            = $student->group->name;
                $stud->register_time    = $student->updated_at.'';
                $stud->archive()->associate($archive);
                $stud->level()->associate($level);
                $stud->save();
            }
            $student->delete();
        }
        return $level;
    }

    public static function date($string): array {
        $pattern  = '/(\d{4})-(\d{2})-(\d{2})/i';
        preg_match($pattern, $string, $match);
        $year     = $match[1];
        $month    = $match[2];
        $day      = $match[3];
        if ($month == '01')
            $month = 'januari';
        elseif ($month == '02')
            $month = 'februari';
        elseif ($month == '03')
            $month = 'maret';
        elseif ($month == '04')
            $month = 'april';
        elseif ($month == '05')
            $month = 'mei';
        elseif ($month == '06')
            $month = 'juni';
        elseif ($month == '07')
            $month = 'juli';
        elseif ($month == '08')
            $month = 'agustus';
        elseif ($month == '09')
            $month = 'september';
        elseif ($month == '10')
            $month = 'oktober';
        elseif ($month == '11')
            $month = 'november';
        else
            $month = 'desember';

        return array($year, $month, $day);
    }
}
