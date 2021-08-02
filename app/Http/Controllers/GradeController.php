<?php
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Level;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function insert(Request $request) {
        $level  = Level::all()->firstWhere('id',$request->level);
        $has    = false;
        $grades = $level->grades()->get();
        foreach ($grades as $grade) {
            if ($grade->grade == $request->grade) {
                $has = true;
                break;
            }
        }
        if (!$has) {
            $grade = new Grade(['grade'=>$request->grade]);
            $grade->level()->associate($level);
            $grade->save();
            return $grade;
        }
        else {
            $data = (object) null;
            $data->status = false;
            return response()->json($data);
        }
    }

    public function index() {
        return Grade::with(['level','groups'])->get();
    }

    public function item($id) {
        return Grade::with(['level','groups','groups.students'])->where('id',$id)->first();
    }

    public function clear():JsonResponse {
        $grades = Grade::all();
        try {
            foreach ($grades as $grade) {
                $grade->delete();
            }
        } catch (\Exception $e) {
            $data = (object) null;
            $data->status = false;
            return response()->json($data);
        }
        $data = (object) null;
        $data->status = true;
        return response()->json($data);
    }

    public function delete(Request $request):JsonResponse {
        $grade = Grade::all()->firstWhere('id', $request->id);
        $has   = true;
        $data  = (object) null;
        if ($grade == null) {
            $has  = false;
            $data->status = $has;
            return response()->json($data);
        }
        $grade->delete();
        $data->status =$has;
        return response()->json($data);
    }
}
