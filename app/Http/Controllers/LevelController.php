<?php
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Http\back\_Archive;
use App\Http\back\_Authorize;
use App\Http\back\_School;
use App\Models\Archive;
use App\Models\Level;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function insert(Request $request): JsonResponse {
        if (Level::all()->where('name', $request->tingkatan)->count() == 0) {
            $level = _School::make($request->tingkatan, $request->ruang, $request->siswa);
            $level = Level::with(['grades', 'grades.groups'])->firstWhere('id', $level->id);
            return response()->json($level);
        }
        else {
            $data = (object) null;
            return response()->json($data);
        }
    }

    public function index() {
        return Level::with(['grades','grades.groups','students','students.walis','students.walis.paret','students.level','students.grade','students.group','students.registrations'])->get();
    }

    public function item($id) {
        return Level::with(['grades','grades.groups','grades.groups.students'])->where('id',$id)->first();
    }

    public function clear(Request $request): JsonResponse {
        $levels = Level::all();
        try {
            foreach ($levels as $level) {
                $level->delete();
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
        $level = Level::all()->firstWhere('name',$request->level);
        $level->delete();
        return response()->json($level);
    }

    public function open(Request $request):JsonResponse {
        $level = Level::all()->firstWhere('id',$request->id);
        if (_Authorize::login()) {
            $level->open = true;
            $level->save();
        }

        return response()->json($level);
    }

    public function close(Request $request):JsonResponse {
        $level = Level::all()->firstWhere('id',$request->id);
        if (_Authorize::login()) {
            $level = _Archive::make($level);
            $level->open = false;
            $level->save();
        }

        return response()->json($level);
    }
}
