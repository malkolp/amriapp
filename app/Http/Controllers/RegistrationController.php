<?php
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Http\back\_Authorize;
use App\Http\back\_Image;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Paret;
use App\Models\Wali;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function insert(Request $request): JsonResponse
    {
        $regist  = new Registration();
        $student = new Student();
        if (Paret::all()->where('citizen_identity', $request->nik_ayah)->count() > 0)
            $father = Paret::all()->firstWhere('citizen_identity', $request->nik_ayah);
        else {
            $father  = new Paret();
            $father->name              = $request->nama_ayah;
            $father->citizen_identity  = $request->nik_ayah;
            $father->gender            = 'laki-laki';
            $father->day_birth         = $request->tanggal_lahir_ayah;
            $father->month_birth       = $request->bulan_lahir_ayah;
            $father->year_birth        = $request->tahun_lahir_ayah;
            $father->place_birth       = $request->tempat_lahir_ayah;
            $father->address           = $request->alamat_ayah;
            $father->phone             = $request->no_hp_ayah;
            $father->email             = $request->email_ayah;
            $father->occupation        = $request->pekerjaan_ayah;
            $father->salary            = $request->penghasilan_ayah;
            $father->save();
        }
        if (Paret::all()->where('citizen_identity', $request->nik_ibu)->count() > 0)
            $mother = Paret::all()->firstWhere('citizen_identity', $request->nik_ibu);
        else {
            $mother  = new Paret();
            $mother->name              = $request->nama_ibu;
            $mother->citizen_identity  = $request->nik_ibu;
            $mother->gender            = 'perempuan';
            $mother->day_birth         = $request->tanggal_lahir_ibu;
            $mother->month_birth       = $request->bulan_lahir_ibu;
            $mother->year_birth        = $request->tahun_lahir_ibu;
            $mother->place_birth       = $request->tempat_lahir_ibu;
            $mother->address           = $request->alamat_ibu;
            $mother->phone             = $request->no_hp_ibu;
            $mother->email             = $request->email_ibu;
            $mother->occupation        = $request->pekerjaan_ibu;
            $mother->salary            = $request->penghasilan_ibu;
            $mother->save();
        }
        $level   = Level::all()->firstWhere('id', $request->tingkatan_siswa);
        $class   = Grade::all()->firstWhere('id', $request->kelas_siswa);
        $group   = Group::all()->firstWhere('id', $request->ruang_siswa);
        $student->name             = $request->nama_siswa;
        $student->citizen_identity = $request->nik_siswa;
        $student->gender           = $request->jenis_kelamin;
        $student->day_birth        = $request->tanggal_lahir_siswa;
        $student->month_birth      = $request->bulan_lahir_siswa;
        $student->year_birth       = $request->tahun_lahir_siswa;
        $student->place_birth      = $request->tempat_lahir_siswa;
        $student->address          = $request->alamat_siswa;
        $student->pic              = _Image::setProfile($request->file('foto_siswa'), $request->nik_siswa);
        $student->level()->associate($level);
        $student->grade()->associate($class);
        $student->group()->associate($group);
        $student->save();
        $regist->student()->associate($student);
        $regist->token             = $request->token;
        $regist->payment_pic       = _Image::setTransaction($request->file('transaksi'), $request->nik_siswa, $request->token);
        $regist->save();

        $wali1       = new Wali();
        $wali1->role = $request->status_anak;
        $wali1->student()->associate($student);
        $wali1->paret()->associate($father);
        $wali1->save();

        $wali2       = new Wali();
        $wali2->role = $request->status_anak;
        $wali2->student()->associate($student);
        $wali2->paret()->associate($mother);
        $wali2->save();

        return response()->json($request);
    }

    public function index($type='none') {
        if (_Authorize::login()) {
            if ($type != 'none') {
                if ($type == 'veryfied')
                    $veryfied = true;
                else
                    $veryfied = false;
                return Registration::with(['student','student.walis','student.walis.paret','student.level','student.grade','student.group'])->where('verified', $veryfied)->get();
            }
            return Registration::with(['student','student.walis','student.walis.paret','student.level','student.grade','student.group'])->get();
        }
        else {
            $data = (object) null;
            $data->data = 'not logged in';
            return response()->json($data);
        }
    }

    public function item($token) {
        $data = Registration::with(['student','student.walis','student.walis.paret','student.level','student.grade','student.group'])
            ->where('token',$token)
            ->first();
        return view('client.registration', compact('data'));
    }

    public function clear(Request $request):JsonResponse {
        $regists = Registration::whereHas('student.levels', function($q) use ($request){
            $q->where('name', '=', $request->name);
        })->get();
        foreach ($regists as $regist) {
            $regist->delete();
        }

        $data = (object) null;
        $data->status = true;
        return response()->json($data);
    }

    public function delete(Request $request):JsonResponse {
        $token = $request->token;
        if (Registration::all()->where('token', $token)->count() > 0) {
            $data = Registration::all()->firstWhere('token', $token);
            $data = $data->student();
            $data->delete();
            $data = (object) null;
            $data->status = true;
            return response()->json($data);
        }
        else {
            $data = (object) null;
            $data->status = false;
            return response()->json($data);
        }
    }

    public function verify(Request $request):JsonResponse {
        $token = $request->token;
        if (Registration::all()->where('token', $token)->count() > 0) {
            $data = Registration::all()->firstWhere('token', $token);
            $data->veryfied_by = _Authorize::data()->name;
            $data->verified = true;
            $data->save();
            $data = (object) null;
            $data->status = true;
            return response()->json($data);
        }
        else {
            $data = (object) null;
            $data->status = false;
            return response()->json($data);
        }
    }

    public function unverify(Request $request):JsonResponse {
        if (Registration::all()->where('token', $request->token)->count() > 0) {
            $data = Registration::all()->firstWhere('token', $request->token);
            $data->veryfied_by = null;
            $data->verified = false;
            $data->save();
            $data = (object) null;
            $data->status = true;
            return response()->json($data);
        }
        else {
            $data = (object) null;
            $data->status = false;
            return response()->json($data);
        }
    }
}
