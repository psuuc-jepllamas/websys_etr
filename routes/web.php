<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\UndergraduateController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');;

Route::get('/graduate', [GraduateController::class, 'show'])->name('user.graduate');
Route::post('/graduate', [GraduateController::class, 'store'])->name('user.graduate.store');
Route::get('/undergraduate', [UndergraduateController::class, 'show'])->name('user.undergraduate');
Route::post('/undergraduate', [UndergraduateController::class, 'store'])->name('user.undergraduate.store');
Route::get('/adminregister', [AdminController::class, 'showRegisterForm'])->name('register');
Route::post('/adminregister', [AdminController::class, 'register']);
Route::get('/adminlogin', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/adminlogin', [AdminController::class, 'login']);

Route::get('/admin/get-student-data', [AdminController::class, 'getStudentData'])->name('admin.getStudentData');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::get('/admindashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/studentrecords', [AdminController::class, 'records'])->name('admin.studentrecords');
Route::get('/studentrecordsgraduate', [AdminController::class, 'recordsGraduate'])->name('admin.studentrecordsgraduate');
Route::get('/admin/print-credential/{id}/{type}', [AdminController::class, 'printCredential'])->name('admin.printCredential');
Route::get('/admin/print-recent-data', [AdminController::class, 'printRecentData'])->name('admin.printRecentData');
Route::post('/admin/duplicate/mark/{id}', [AdminController::class, 'markDuplicateAttempt'])->name('admin.duplicate.mark');