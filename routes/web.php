<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\students;
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
Route::get("login", function () {
    if(session()->has('user')){
        return redirect('dashboard');
    }
    return view('login');
});
Route::post('dashboard',[students::class,'Index']) -> middleware('revalidate');
Route::get('dashboard',[students::class,'Dashboard']) ->middleware('revalidate');
Route::get('logout', function () {
    if(session()->has('user')){
        session()->pull('user');
    }
    return redirect('login');
})-> middleware('revalidate');

