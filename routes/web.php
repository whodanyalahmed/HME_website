<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\students;
use App\Http\Controllers\admin;
use App\Http\Controllers\Common;

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

Route::get('/',[Common::class,'Index']);
// students
// Students routes
Route::get("students/login", function () {
    if(session()->has('user')){
        return redirect('students/dashboard');
    }
    return view('students.login');
}) -> middleware('revalidate');
Route::post('students/dashboard',[students::class,'Index']) -> middleware('revalidate');
Route::get('students/dashboard',[students::class,'Dashboard']) ->middleware('revalidate');
Route::get('students/logout', function () {
    if(session()->has('user')){
        // session()->pull('user');
        session()->flush();
    }
    return redirect('students/login');
})-> middleware('revalidate');
Route::view('students/signup','students.signup');
Route::post('students/signup', [students::class,'signup']);
Route::post('students/upload',[students::class,'Upload']);
// Admin
// Admin data
Route::get("admin/login", function () {
    if(session()->has('admin')){
        return redirect('admin/dashboard');
    }
    return view('admin.login');
}) -> middleware('revalidate');
Route::post('admin/dashboard',[admin::class,'Index']) -> middleware('revalidate');
Route::get('admin/dashboard',[admin::class,'Dashboard']) ->middleware('revalidate');
Route::get('admin/logout', function () {
    if(session()->has('admin')){
        // session()->pull('user');
        session()->flush();
    }
    return redirect('admin/login');
})-> middleware('revalidate');
Route::get('admin/pending',[admin::class,'pending']);
Route::get('admin/students',[admin::class,'All']);
Route::get('admin/Activestudents',[admin::class,'ActiveStudents']);
Route::post('/admin/student/delete/{id}',[admin::class,'DeleteStudent']);
Route::post('/admin/student/active/{id}',[admin::class,'ActiveStudent']);
Route::post('/admin/student/Edit/{id}',[admin::class,'EditStudent']);
Route::get('admin/student/Edit/{id}',[admin::class,'Edit']);

// admin dashboard