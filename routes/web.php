<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
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

        /*** permissions route */

        Route::get('/permission',[App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
        Route::match(['get','post'],'/permission/create',[App\Http\Controllers\PermissionController::class, 'create'])->name('permission.create');
        Route::match(['get','post'],'/permission/edit/{id}',[App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('/permission/status',[App\Http\Controllers\PermissionController::class, 'status'])->name('permission.status');
        Route::post('/permission/delete',[App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.delete');

        // User

        Route::get('/users',[App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::match(['get','post'],'/users/create',[App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::match(['get','post'],'/users/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/status',[App\Http\Controllers\UserController::class, 'status'])->name('users.status');
        Route::post('/users/delete',[App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');
       

    });

    // Document Type

    Route::get('/document/office_memorandum',[App\Http\Controllers\FormController::class, 'officeMemorandum'])->name('document.office_memorandum.index');
    Route::match(['get','post'],'/document/office_memorandum/create',[App\Http\Controllers\FormController::class, 'create'])->name('document.office_memorandum.create');
    Route::match(['get','post'],'/document/office_memorandum/edit/{id}',[App\Http\Controllers\FormController::class, 'edit'])->name('document.office_memorandum.edit');
    Route::post('/document/office_memorandum/status',[App\Http\Controllers\FormController::class, 'status'])->name('document.office_memorandum.status');
    Route::post('/office_memorandum/delete',[App\Http\Controllers\FormController::class, 'destroy'])->name('office_memorandum.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\FormController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/office_memorandum/get-divisions-by-user', [App\Http\Controllers\FormController::class, 'getDivisionsByUser'])->name('document.office_memorandum.get-divisions-by-user');
    Route::delete('/admin/document/office_memorandum/delete_file', [App\Http\Controllers\FormController::class, 'deleteFile'])->name('document.office_memorandum.delete_file');


    //letter

    Route::get('/document/letter',[App\Http\Controllers\LetterController::class, 'letter'])->name('document.letter.index');
    Route::match(['get','post'],'/document/letter/create',[App\Http\Controllers\LetterController::class, 'create'])->name('document.letter.create');
    Route::match(['get','post'],'/document/letter/edit/{id}',[App\Http\Controllers\LetterController::class, 'edit'])->name('document.letter.edit');
    Route::post('/document/letter/status',[App\Http\Controllers\LetterController::class, 'status'])->name('document.letter.status');
    Route::post('/letter/delete',[App\Http\Controllers\LetterController::class, 'destroy'])->name('letter.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\LetterController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/letter/get-divisions-by-user', [App\Http\Controllers\LetterController::class, 'getDivisionsByUser'])->name('document.letter.get-divisions-by-user');
    Route::delete('/admin/document/letter/delete_file', [App\Http\Controllers\LetterController::class, 'deleteFile'])->name('document.letter.delete_file');

    //officeorder

    Route::get('/document/office_order',[App\Http\Controllers\OfficeOrder::class, 'officeOrder'])->name('document.office_order.index');
    Route::match(['get','post'],'/document/office_order/create',[App\Http\Controllers\OfficeOrder::class, 'create'])->name('document.office_order.create');
    Route::match(['get','post'],'/document/office_order/edit/{id}',[App\Http\Controllers\OfficeOrder::class, 'edit'])->name('document.office_order.edit');
    Route::post('/document/office_order/status',[App\Http\Controllers\OfficeOrder::class, 'status'])->name('document.office_order.status');
    Route::post('/office_order/delete',[App\Http\Controllers\OfficeOrder::class, 'destroy'])->name('office_order.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\OfficeOrder::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/office_order/get-divisions-by-user', [App\Http\Controllers\OfficeOrder::class, 'getDivisionsByUser'])->name('document.office_order.get-divisions-by-user');
    Route::delete('/admin/document/office_order/delete_file', [App\Http\Controllers\OfficeOrder::class, 'deleteFile'])->name('document.office_order.delete_file');

     //Notifications

    Route::get('/document/notification',[App\Http\Controllers\NotificationController::class, 'notification'])->name('document.notification.index');
    Route::match(['get','post'],'/document/notification/create',[App\Http\Controllers\NotificationController::class, 'create'])->name('document.notification.create');
    Route::match(['get','post'],'/document/notification/edit/{id}',[App\Http\Controllers\NotificationController::class, 'edit'])->name('document.notification.edit');
    Route::post('/document/notification/status',[App\Http\Controllers\NotificationController::class, 'status'])->name('document.notification.status');
    Route::post('/notification/delete',[App\Http\Controllers\NotificationController::class, 'destroy'])->name('notification.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\NotificationController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/notification/get-divisions-by-user', [App\Http\Controllers\NotificationController::class, 'getDivisionsByUser'])->name('document.notification.get-divisions-by-user');
    Route::delete('/admin/document/notification/delete_file', [App\Http\Controllers\NotificationController::class, 'deleteFile'])->name('document.notification.delete_file');

    //guideline

    Route::get('/document/guideline',[App\Http\Controllers\GuidelineController::class, 'guideline'])->name('document.guideline.index');
    Route::match(['get','post'],'/document/guideline/create',[App\Http\Controllers\GuidelineController::class, 'create'])->name('document.guideline.create');
    Route::match(['get','post'],'/document/guideline/edit/{id}',[App\Http\Controllers\GuidelineController::class, 'edit'])->name('document.guideline.edit');
    Route::post('/document/guideline/status',[App\Http\Controllers\GuidelineController::class, 'status'])->name('document.guideline.status');
    Route::post('/guideline/delete',[App\Http\Controllers\GuidelineController::class, 'destroy'])->name('guideline.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\GuidelineController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/guideline/get-divisions-by-user', [App\Http\Controllers\GuidelineController::class, 'getDivisionsByUser'])->name('document.guideline.get-divisions-by-user');
    Route::delete('/admin/document/guideline/delete_file', [App\Http\Controllers\GuidelineController::class, 'deleteFile'])->name('document.guideline.delete_file');

    //Recruitment Rules

    Route::get('/document/recruitment',[App\Http\Controllers\RecruitmentController::class, 'recruitment'])->name('document.recruitment.index');
    Route::match(['get','post'],'/document/recruitment/create',[App\Http\Controllers\RecruitmentController::class, 'create'])->name('document.recruitment.create');
    Route::match(['get','post'],'/document/recruitment/edit/{id}',[App\Http\Controllers\RecruitmentController::class, 'edit'])->name('document.recruitment.edit');
    Route::post('/document/recruitment/status',[App\Http\Controllers\RecruitmentController::class, 'status'])->name('document.recruitment.status');
    Route::post('/recruitment/delete',[App\Http\Controllers\RecruitmentController::class, 'destroy'])->name('recruitment.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\RecruitmentController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/recruitment/get-divisions-by-user', [App\Http\Controllers\RecruitmentController::class, 'getDivisionsByUser'])->name('document.recruitment.get-divisions-by-user');
    Route::delete('/admin/document/recruitment/delete_file', [App\Http\Controllers\RecruitmentController::class, 'deleteFile'])->name('document.recruitment.delete_file');
});

Route::get('/get-designations/{roleId}', [App\Http\Controllers\UserController::class, 'getDesignations']);

<<<<<<< HEAD
Route::post('/report-counts', [ReportController::class, 'getCounts']);
Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.home');


=======

Route::get('error404', [App\Http\Controllers\HomeController::class, 'error404'])->name('error404');
>>>>>>> 9d5b04e8be68958432b245809acfb52364aa13f4
