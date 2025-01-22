<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

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

    Route::middleware(['is_access'])->group(function () {

        // Roles

        Route::get('/roles',[App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');

        Route::match(['get','post'],'/roles/create',[App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');

        Route::match(['get','post'],'/roles/edit/{id}',[App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');

        Route::post('/roles/status',[App\Http\Controllers\RoleController::class, 'status'])->name('roles.status');

        Route::post('/roles/delete',[App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.delete');

        // Designation

        Route::get('/designation',[App\Http\Controllers\DesignationController::class, 'index'])->name('designation.index');
        Route::match(['get','post'],'/designation/create',[App\Http\Controllers\DesignationController::class, 'create'])->name('designation.create');
        Route::match(['get','post'],'/designation/edit/{id}',[App\Http\Controllers\DesignationController::class, 'edit'])->name('designation.edit');
        Route::post('/designation/delete',[App\Http\Controllers\DesignationController::class, 'destroy'])->name('designation.delete');
        
        // Division

        Route::get('/division',[App\Http\Controllers\DivisionController::class, 'index'])->name('division.index');
        Route::match(['get','post'],'/division/create',[App\Http\Controllers\DivisionController::class, 'create'])->name('division.create');
        Route::match(['get','post'],'/division/edit/{id}',[App\Http\Controllers\DivisionController::class, 'edit'])->name('division.edit');
        Route::post('/division/delete',[App\Http\Controllers\DivisionController::class, 'destroy'])->name('division.delete');


        // User

        Route::get('/users',[App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::match(['get','post'],'/users/create',[App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::match(['get','post'],'/users/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/status',[App\Http\Controllers\UserController::class, 'status'])->name('users.status');
        Route::post('/users/delete',[App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');
    });

    // Document Type

    Route::get('/document/office_memorandum',[App\Http\Controllers\FormController::class, 'officeMemorandum'])->name('document.office_memorandum.index');

    Route::match(['get','post'],'/document/office_memorandum/create',[App\Http\Controllers\FormController::class, 'officeMemorandumCreate'])->name('document.office_memorandum.create');

    Route::match(['get','post'],'/document/office_memorandum/edit/{id}',[App\Http\Controllers\FormController::class, 'officeMemorandumEdit'])->name('document.office_memorandum.edit');

    Route::post('/document/office_memorandum/status',[App\Http\Controllers\FormController::class, 'officeMemorandumStatus'])->name('document.office_memorandum.status');

    Route::post('/document/office_memorandum/delete',[App\Http\Controllers\FormController::class, 'officeMemorandumDestroy'])->name('document.office_memorandum.delete');


});
