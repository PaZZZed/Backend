<?php

use App\Http\Controllers\StudentsCtrl;
use App\Student;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
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

Route::get('/home', 'HomeCtrl@home')->name("home");



Route::get('/ues', 'ControllerUES@getAll');
Route::post('/ues', 'ControllerUES@insertUE')->name('add.ue');
Route::get('/ues/{id}', 'ControllerUES@deleteUE')->name('delete.ue');

Route::post('/search', 'StudentsCtrl@search');
Route::get('/search', 'StudentsCtrl@search');

Route::get('/students', 'StudentsCtrl@listAll');
Route::post('/students', 'StudentsCtrl@importEtudiant')->name("import.student");

Route::get('/reports', 'ReportsCtrl@listAll');
Route::post('/reports', 'ReportsCtrl@importBulletin')->name("import.bulletin");
Route::get('/reports/test', 'ReportsCtrl@sortStudent')->name("import.test");

Route::post('/reports/reset', 'ReportsCtrl@resetList')->name("reset.bulletin");

Route::get('/report/{id}', 'ReportCtrl@listAll')->name("Recup.id");

Route::get('/newUser', 'UserCtrl@showForm');
Route::post('/newUser','UserCtrl@store')->name('add.role');

Route::get('/login','LoginCtrl@login');
Route::post('/login','LoginCtrl@auth')->name('auth');

Route::post( '/search2', 'ReportsCtrl@search')->name('search');
Route::get( '/search2', 'ReportsCtrl@search');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

