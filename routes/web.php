<?php /** @noinspection PhpUndefinedClassInspection */

use App\Http\back\_Authorize;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {return view('welcome');});
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::get('/login', function () {if (!_Authorize::login())return view('client.login');return redirect()->route('dashboard');});

Route::get('/dashboard','Controller@dashboard')->name('dashboard');

Route::get('/manage/{type}','Controller@manage')->name('manage');
Route::get('/data/{type}','Controller@data')->name('data');
Route::get('/report/{type}','Controller@report')->name('report');
Route::post('deleteReport','Controller@deleteReport');

Route::get('/registrations', function (){return redirect()->route('registrations',['none']);});
Route::get('/registrations/{type}', 'RegistrationController@index')->name('registrations');
Route::get('/registration/{token}', 'RegistrationController@item');
Route::post('insertRegistration', 'RegistrationController@insert');
Route::post('clearRegistration', 'RegistrationController@clear');
Route::post('deleteRegistration', 'RegistrationController@delete');
Route::post('verify', 'RegistrationController@verify');
Route::post('unverify', 'RegistrationController@unverify');

Route::get('/users/{type}', 'UserController@index');
Route::get('/user/{id}', 'UserController@item');
Route::post('insertUser', 'UserController@insert');
Route::post('clearUser', 'UserController@clear');
Route::post('deleteUser', 'UserController@delete');

Route::get('/levels', 'LevelController@index');
Route::get('/level/{id}', 'LevelController@item');
Route::post('insertLevel', 'LevelController@insert');
Route::post('clearLevel', 'LevelController@clear');
Route::post('deleteLevel', 'LevelController@delete');
Route::post('open', 'LevelController@open');
Route::post('close', 'LevelController@close');

Route::get('/grades', 'GradeController@index');
Route::get('/grade/{id}', 'GradeController@item');
Route::post('insertGrade', 'GradeController@insert');
Route::post('clearGrade', 'GradeController@clear');
Route::post('deleteGrade', 'GradeController@delete');

Route::get('/groups', 'GroupController@index');
Route::get('/group/{id}', 'GroupController@item');
Route::post('insertGroup', 'GroupController@insert');
Route::post('clearGroup', 'GroupController@clear');
Route::post('deleteGroup', 'GroupController@delete');
