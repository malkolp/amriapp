<?php
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function insert(Request $request): JsonResponse
    {
        $grade  = Grade::all()->firstWhere('id',$request->grade);
        $level  = $grade->level()->first();
        $groups = $grade->groups()->get();
        $head   = User::all()->firstWhere('id',$request->head);
        $has    = false;
        foreach ($groups as $group) {
            if ($group->name == $request->name) {
                $has = true;
                break;
            }
        }
        if (!$has) {
            $group = new Group(['name'=>$request->name]);
            $group->level()->associate($level);
            $group->grade()->associate($grade);
            $group->save();
            return $grade;
        }
        else {
            $data = (object) null;
            $data->status = false;
            return response()->json($data);
        }
    }

    public function index() {
        return Group::with(['grade','grade.level','students'])->get();
    }

    public function item($id) {
        return Group::with(['grade','grade.level','students'])->where('id',$id)->first();
    }

    public function clear(): JsonResponse {
        $groups = Group::all();
        try {
            foreach ($groups as $group) {
                $group->delete();
            }
        } catch (\Exception $e) {
            $data = (object) null;
            $data->status = false;
        }
        $data = (object) null;
        $data->status = true;
        return response()->json($data);
    }

    public function delete(Request $request):JsonResponse {
        $group = Group::all()->firstWhere('id',$request->id);
        $has   = false;
        $data = (object) null;
        if ($group != null) {
            $has = true;
            $group->delete();
        }
        $data->status = $has;
        return response()->json($data);
    }
}
