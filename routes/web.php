<?php

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

Route::get('/','DashboardController@index')->name('dashboard')->middleware(['auth','karyawan']);
Route::get('/request-time-off','RequestTimeOffController@index')->name('request-time-off')->middleware(['auth','karyawan']);
Route::post('/request-time-off/create','RequestTimeOffController@create')->name('create-time-off')->middleware(['auth','karyawan']);
Route::get('/request-overtime','RequestOvertimeController@index')->name('request-overtime')->middleware(['auth','karyawan']);
Route::post('/request-overtime/create','RequestOvertimeController@create')->name('create-overtime')->middleware(['auth','karyawan']);
Route::post('/attendance/{id}','DashboardController@createAttendance')->name('attendance')->middleware(['auth','karyawan']);
Route::get('/request-attendance','RequestAttendanceController@index')->name('request-attendance')->middleware(['auth','karyawan']);
Route::get('/profile/{id}','DashboardController@profile')->name('profile')->middleware(['auth','karyawan']);
Route::post('/profile/{id}/update','DashboardController@updateprofile')->name('update-profile')->middleware(['auth','karyawan']);
Route::post('/profile/{id}/update-picture','DashboardController@updateProfilePicture')->name('update-picture')->middleware(['auth','karyawan']);
Route::post('/request-time-off/export','RequestTimeOffController@export')->name('time-off-export')->middleware(['auth','karyawan']);
Route::post('/request-attendance/export','RequestAttendanceController@export')->name('attendance-export')->middleware(['auth','karyawan']);
Route::post('/request-overtime/export','RequestOvertimeController@export')->name('overtime-export')->middleware(['auth','karyawan']);


Route::prefix('admin')
      ->namespace('Admin')
      ->middleware(['auth','admin'])
      ->group(function() {
        Route::get('/', 'RequestOvertimeController@index')
            ->name('request-overtime-admin');
        Route::post('/request-overtime/{id}', 'RequestOvertimeController@approved')
            ->name('overtime-aprroved');
        Route::post('/request-overtime/rejected/{id}', 'RequestOvertimeController@rejected')
            ->name('overtime-rejected');

        Route::get('/request-timeoff', 'RequestTimeoffController@index')
            ->name('request-timeoff-admin');
        Route::post('/request-timeoff/{id}', 'RequestTimeOffController@approved')
            ->name('timeoff-aprroved');
        Route::post('/request-timeoff/rejected/{id}', 'RequestTimeOffController@rejected')
            ->name('timeoff-rejected');

        Route::get('/attendance', 'AttendanceController@index')
            ->name('attendance-admin');
        Route::resource('data-user','DataUserController');
        Route::post('/data-user/create','DataUserController@create')->name('user-create');
      }); 


Auth::routes(['verify'=>true]);



