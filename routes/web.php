<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\students;
use App\Http\Controllers\teachers;
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
Route::post('/careers',[Common::class,'Upload']);
Route::view('careers', 'careers');
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
        session()->forget('user');
    }
    return redirect('students/login');
})-> middleware('revalidate');
Route::view('students/signup','students.signup');
Route::post('students/signup', [students::class,'signup']);
Route::post('students/upload',[students::class,'Upload']);
Route::get('students/class/{id}', [students::class,'ClassView']) -> middleware('revalidate');
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
        session()->forget('admin');
    }
    return redirect('admin/login');
})-> middleware('revalidate');
Route::get('admin/students',[admin::class,'All']);
Route::get('admin/studentsfee',[admin::class,'ActiveStudents']);
Route::post('/admin/student/delete/{id}',[admin::class,'DeleteStudent']);
Route::post('/admin/student/active/{id}',[admin::class,'ActiveStudent']);
Route::post('/admin/student/update',[admin::class,'updateStudent']);
Route::post('/admin/student/notpaid/{id}',[admin::class,'notpaidStudent']);
Route::post('/admin/student/pending/{id}',[admin::class,'pendingStudent']);
Route::post('/admin/student/paid/{id}',[admin::class,'paidStudent']);
Route::post('/admin/contactus',[admin::class,'Contactus']);
Route::get('/admin/upcoming',[admin::class,'Upcoming']);
Route::post('/admin/upcoming',[admin::class,'UpcomingUpdate']);
Route::post('/admin/upcomingcreate',[admin::class,'UpcomingCreate']);
Route::get('/admin/admissionfee',[admin::class,'admissionfee']);
Route::post('/admin/admissionfee',[admin::class,'admissionfeeUpdate']);
Route::get('/admin/coursesfee',[admin::class,'coursesfee']);
Route::post('/admin/coursesfee',[admin::class,'coursesfeeUpdate']);
Route::get('/admin/feedback',[admin::class,'feedback']);
Route::get('/admin/news',[admin::class,'news']);
Route::post('/admin/news',[admin::class,'newsCreate']);
Route::post('/admin/newsUpdate',[admin::class,'newsUpdate']);
Route::post('/admin/newsDelete',[admin::class,'newsDelete']);
Route::get('/admin/careers',[admin::class,'careers']);
Route::get('/admin/classes',[admin::class,'classes']);
Route::post('/admin/classedit',[admin::class,'updateTeacher']);
// Route::get('/admin/student/payable/{id}',[students::class,'getPayableFees']);
// Route::get('/students/test',[students::class,'getAddMonth']);


// TEachers 
Route::get("teachers/login", function () {
    if(session()->has('teacher')){
        return redirect('teachers/dashboard');
    }
    return view('teachers.login');
}) -> middleware('revalidate');
Route::post('teachers/dashboard',[teachers::class,'Index']) -> middleware('revalidate');
Route::get('teachers/dashboard',[teachers::class,'Dashboard']) ->middleware('revalidate') -> middleware('revalidate');
Route::get('teachers/logout', function () {
    if(session()->has('teacher')){
        // session()->pull('user');
        session()->forget('teacher');
    }
    return redirect('teachers/login');
})-> middleware('revalidate');

Route::view('teachers/signup','teachers.signup');
Route::post('teachers/signup', [teachers::class,'signup']);
Route::post('teachers/class/create', [teachers::class,'CreateClass']);
Route::post('teachers/class/delete', [teachers::class,'DeleteClass']);
Route::post('teachers/class/add', [teachers::class,'AddStudentClass']);
Route::get('teachers/class/{id}', [teachers::class,'ClassView']) -> middleware('revalidate');
// Route::get('teachers/class/puchin/{id}',[teachers::class,'getPunchin']);
Route::post('teachers/class/{c_id}/punchin/{id}', [teachers::class,'Punchin']);
Route::post('teachers/class/{c_id}/punchout/{id}',[teachers::class,'Punchout']);
Route::post('teachers/class/{c_id}/messsage',[teachers::class,'PostMessage']);
Route::post('teachers/class/{c_id}/delete/message',[teachers::class,'DeleteMessage']);
Route::post('teachers/class/{c_id}/edit/message',[teachers::class,'EditMessage']);
Route::post('teachers/class/{c_id}/remove/{id}',[teachers::class,'RemoveStudent']);
