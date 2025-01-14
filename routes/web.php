<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('admin.login');
});

Auth::routes(['login' => false,'register' => false]);

Route::post('/refresh-captcha',function(){
    Helper::showCaptcha();
    $captcha = session('captcha_answer');
    return response()->json(['captcha' => $captcha]);
})->name('refresh-captcha');

Route::match(['get','post'],'/admin/login',[App\Http\Controllers\AppController::class, 'login'])->name('admin.login');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Roles

    Route::get('/roles',[App\Http\Controllers\RoleController::class, 'index'])->name('roles');

    Route::match(['get','post'],'/roles/create',[App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');

    Route::match(['get','post'],'/roles/edit/{id}',[App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');

    Route::post('/roles/status',[App\Http\Controllers\RoleController::class, 'status'])->name('roles.status');

    Route::post('/roles/delete',[App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.delete');
});
