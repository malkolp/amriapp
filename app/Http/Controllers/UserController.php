<?php
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Http\back\_Authorize;
use App\Http\back\_Image;
use App\Models\Level;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function insert(Request $request): User {
        $user    = new User();
        $user->name     = $request->name;
        $user->identity = $request->identity;
        if ($request->file('pic') != null) {
            $user->pic  = _Image::setProfile($request->file('pic'),$request->identity,'',true);
        }
        else {
            $user->pic  = _Image::setDefaultProfile($request->name,$request->identity,'',true);
        }
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->role     = $request->role;
        $user->save();
        if ($request->role == 'teacher') {
            $teacher = new Teacher();
            $level   = Level::all()->firstWhere('id',$request->id);
            $teacher->user()->associate($user);
            $teacher->level()->associate($level);
            $teacher->save();
        }
        return $user;
    }

    public function index($type='') {
        if ($type != '')
            $data = User::all()->where('role', $type);
        else
            $data = User::all();

        return $data;
    }

    public function item($id) {
        return User::all()->firstWhere('id', $id);
    }

    public function update(Request $request): JsonResponse {
        $logger         = _Authorize::data();
        $user           = User::all()->firstWhere('id',$request->id);
        $user->identity = $request->identity;
        $user->name     = $request->name;
        if ($request->file('pic') != null) {
            $user->pic  = _Image::setProfile($request->file('pic'),$request->identity,'',true);
        }
        else {
            $user->pic  = _Image::setDefaultProfile($request->name,$request->identity,'',true);
        }
        if ($logger->id == $user->id) {
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
        }
        if ($logger->role == 'super') {
            $user->role     = $request->role;
        }
        $user->save();

        return response()->json($user);
    }

    public function clear(Request $request):JsonResponse {
        $logger = _Authorize::data();
        $data   = (object) null;
        $data->status = false;
        if ($logger->role == 'super') {
            $users  = User::all();
            try {
                foreach ($users as $user) {
                    if ($user->role != 'super' && $user->role != 'head')
                        $user->delete();
                }
            } catch (\Exception $e) {
                return response()->json($data);
            }
            $data->status = true;
            return response()->json($data);
        }
        return response()->json($data);
    }

    public function delete(Request $request): JsonResponse {
        $logger = _Authorize::data();
        $data   = (object) null;
        $data->status = false;
        if ($logger->role == 'super') {
            $user = User::all()->firstWhere('id', $request->id);
            if ($user->role != 'super') {
                $user->delete();
                $data->status = true;
            }
        }

        return response()->json($data);
    }
}
