<?php
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Http\back\_Archive;
use App\Models\Archive;
use App\Models\Level;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard() {
        return view('admin.dashboard');
    }

    public function manage($type) {
        $level       = Level::with(['students','students.grade','students.group','students.registrations'])->where('name', $type)->first()->toJson();
        $data        = (object) null;
        $data->title = 'Pendaftaran ' . strtoupper($type);
        $data->type  = $type;
        $data->level = $level;
        return view('admin.manage', compact('data'));
    }

    public function data($type) {
        $level       = Level::with(['archives','archives.studs'])->where('name', $type)->first()->toJson();
        $data        = (object) null;
        $data->title = 'Data ' . strtoupper($type);
        $data->type  = $type;
        $data->level = $level;
        return view('admin.data', compact('data'));
    }

    public function report($type) {
        $archive     = Archive::with(['level','studs'])->firstWhere('id', $type);
        $data        = (object) null;
        $data->type  = $archive->level->name;
        $data->date  = _Archive::date($archive->updated_at);
        $data        = array($data, $archive);

        return view('admin.report', compact('data'));
    }

    public function deleteReport(Request $request): JsonResponse
    {
        $archive     = Archive::all()->firstWhere('id', $request->id);
        $archive->delete();

        return response()->json($request);
    }
}
