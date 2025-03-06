<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

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

     //achievenment 

     Route::get('/document/achievenment',[App\Http\Controllers\AchievementController::class, 'achievenment'])->name('document.achievenment.index');
     Route::match(['get','post'],'/document/achievenment/create',[App\Http\Controllers\AchievementController::class, 'create'])->name('document.achievenment.create');
     Route::match(['get','post'],'/document/achievenment/edit/{id}',[App\Http\Controllers\AchievementController::class, 'edit'])->name('document.achievenment.edit');
     Route::post('/document/achievenment/status',[App\Http\Controllers\AchievementController::class, 'status'])->name('document.achievenment.status');
     Route::post('/achievenment/delete',[App\Http\Controllers\AchievementController::class, 'destroy'])->name('achievenment.delete');
     Route::get('view-pdf/{file}', [App\Http\Controllers\AchievementController::class, 'viewPdf'])->name('view.pdf');
     Route::get('/admin/document/achievenment/get-divisions-by-user', [App\Http\Controllers\AchievementController::class, 'getDivisionsByUser'])->name('document.achievenment.get-divisions-by-user');
     Route::delete('/admin/document/achievenment/delete_file', [App\Http\Controllers\AchievementController::class, 'deleteFile'])->name('document.achievenment.delete_file');

     // Record of Discussion 

    Route::get('/document/records_of_discussion',[App\Http\Controllers\RecordController::class, 'records_of_discussion'])->name('document.records_of_discussion.index');
    Route::match(['get','post'],'/document/records_of_discussion/create',[App\Http\Controllers\RecordController::class, 'create'])->name('document.records_of_discussion.create');
    Route::match(['get','post'],'/document/records_of_discussion/edit/{id}',[App\Http\Controllers\RecordController::class, 'edit'])->name('document.records_of_discussion.edit');
    Route::post('/document/records_of_discussion/status',[App\Http\Controllers\RecordController::class, 'status'])->name('document.records_of_discussion.status');
    Route::post('/records_of_discussion/delete',[App\Http\Controllers\RecordController::class, 'destroy'])->name('records_of_discussion.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\RecordController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/records_of_discussion/get-divisions-by-user', [App\Http\Controllers\RecordController::class, 'getDivisionsByUser'])->name('document.records_of_discussion.get-divisions-by-user');
    Route::delete('/admin/document/records_of_discussion/delete_file', [App\Http\Controllers\RecordController::class, 'deleteFile'])->name('document.records_of_discussion.delete_file');


    // Minutes of Meeting 

    Route::get('/document/minutes_of_metting',[App\Http\Controllers\MinutesOfMetting::class, 'minutes_of_metting'])->name('document.minutes_of_metting.index');
    Route::match(['get','post'],'/document/minutes_of_metting/create',[App\Http\Controllers\MinutesOfMetting::class, 'create'])->name('document.minutes_of_metting.create');
    Route::match(['get','post'],'/document/minutes_of_metting/edit/{id}',[App\Http\Controllers\MinutesOfMetting::class, 'edit'])->name('document.minutes_of_metting.edit');
    Route::post('/document/minutes_of_metting/status',[App\Http\Controllers\MinutesOfMetting::class, 'status'])->name('document.minutes_of_metting.status');
    Route::post('/minutes_of_metting/delete',[App\Http\Controllers\MinutesOfMetting::class, 'destroy'])->name('minutes_of_metting.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\MinutesOfMetting::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/minutes_of_metting/get-divisions-by-user', [App\Http\Controllers\MinutesOfMetting::class, 'getDivisionsByUser'])->name('document.minutes_of_metting.get-divisions-by-user');
    Route::delete('/admin/document/minutes_of_metting/delete_file', [App\Http\Controllers\MinutesOfMetting::class, 'deleteFile'])->name('document.minutes_of_metting.delete_file');


    // Gazette Notifications

    Route::get('/document/gazette_notification',[App\Http\Controllers\GazetteNotification::class, 'gazette_notification'])->name('document.gazette_notification.index');
    Route::match(['get','post'],'/document/gazette_notification/create',[App\Http\Controllers\GazetteNotification::class, 'create'])->name('document.gazette_notification.create');
    Route::match(['get','post'],'/document/gazette_notification/edit/{id}',[App\Http\Controllers\GazetteNotification::class, 'edit'])->name('document.gazette_notification.edit');
    Route::post('/document/gazette_notification/status',[App\Http\Controllers\GazetteNotification::class, 'status'])->name('document.gazette_notification.status');
    Route::post('/gazette_notification/delete',[App\Http\Controllers\GazetteNotification::class, 'destroy'])->name('gazette_notification.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\GazetteNotification::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/gazette_notification/get-divisions-by-user', [App\Http\Controllers\GazetteNotification::class, 'getDivisionsByUser'])->name('document.gazette_notification.get-divisions-by-user');
    Route::delete('/admin/document/gazette_notification/delete_file', [App\Http\Controllers\GazetteNotification::class, 'deleteFile'])->name('document.gazette_notification.delete_file');


    
    // Presentations

    Route::get('/document/presentations',[App\Http\Controllers\PresentationController::class, 'presentations'])->name('document.presentations.index');
    Route::match(['get','post'],'/document/presentations/create',[App\Http\Controllers\PresentationController::class, 'create'])->name('document.presentations.create');
    Route::match(['get','post'],'/document/presentations/edit/{id}',[App\Http\Controllers\PresentationController::class, 'edit'])->name('document.presentations.edit');
    Route::post('/document/presentations/status',[App\Http\Controllers\PresentationController::class, 'status'])->name('document.presentations.status');
    Route::post('/presentations/delete',[App\Http\Controllers\PresentationController::class, 'destroy'])->name('presentations.delete');
    Route::get('view-pdf/{file}', [App\Http\Controllers\PresentationController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/admin/document/presentations/get-divisions-by-user', [App\Http\Controllers\PresentationController::class, 'getDivisionsByUser'])->name('document.presentations.get-divisions-by-user');
    Route::delete('/admin/document/presentations/delete_file', [App\Http\Controllers\PresentationController::class, 'deleteFile'])->name('document.presentations.delete_file');

    /*** routes for change password */
    
    Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('password.update');

     //  PM Reference

     Route::get('/document/pm_reference',[App\Http\Controllers\PmReferenceController::class, 'pm_reference'])->name('document.pm_reference.index');
     Route::match(['get','post'],'/document/pm_reference/create',[App\Http\Controllers\PmReferenceController::class, 'create'])->name('document.pm_reference.create');
     Route::match(['get','post'],'/document/pm_reference/edit/{id}',[App\Http\Controllers\PmReferenceController::class, 'edit'])->name('document.pm_reference.edit');
     Route::post('/document/pm_reference/status',[App\Http\Controllers\PmReferenceController::class, 'status'])->name('document.pm_reference.status');
     Route::post('/pm_reference/delete',[App\Http\Controllers\PmReferenceController::class, 'destroy'])->name('pm_reference.delete');
     Route::get('view-pdf/{file}', [App\Http\Controllers\PmReferenceController::class, 'viewPdf'])->name('view.pdf');
     Route::get('/admin/document/pm_reference/get-divisions-by-user', [App\Http\Controllers\PmReferenceController::class, 'getDivisionsByUser'])->name('document.pm_reference.get-divisions-by-user');
     Route::delete('/admin/document/pm_reference/delete_file', [App\Http\Controllers\PmReferenceController::class, 'deleteFile'])->name('document.pm_reference.delete_file');

      //  VIP Reference

      Route::get('/document/vip_reference',[App\Http\Controllers\VIPReferenceController::class, 'vip_reference'])->name('document.vip_reference.index');
      Route::match(['get','post'],'/document/vip_reference/create',[App\Http\Controllers\VIPReferenceController::class, 'create'])->name('document.vip_reference.create');
      Route::match(['get','post'],'/document/vip_reference/edit/{id}',[App\Http\Controllers\VIPReferenceController::class, 'edit'])->name('document.vip_reference.edit');
      Route::post('/document/vip_reference/status',[App\Http\Controllers\VIPReferenceController::class, 'status'])->name('document.vip_reference.status');
      Route::post('/vip_reference/delete',[App\Http\Controllers\VIPReferenceController::class, 'destroy'])->name('vip_reference.delete');
      Route::get('view-pdf/{file}', [App\Http\Controllers\VIPReferenceController::class, 'viewPdf'])->name('view.pdf');
      Route::get('/admin/document/vip_reference/get-divisions-by-user', [App\Http\Controllers\VIPReferenceController::class, 'getDivisionsByUser'])->name('document.vip_reference.get-divisions-by-user');
      Route::delete('/admin/document/vip_reference/delete_file', [App\Http\Controllers\VIPReferenceController::class, 'deleteFile'])->name('document.vip_reference.delete_file');

      //  Cabinet Note

      Route::get('/document/cabinet_note',[App\Http\Controllers\CabinetController::class, 'cabinet_note'])->name('document.cabinet_note.index');
      Route::match(['get','post'],'/document/cabinet_note/create',[App\Http\Controllers\CabinetController::class, 'create'])->name('document.cabinet_note.create');
      Route::match(['get','post'],'/document/cabinet_note/edit/{id}',[App\Http\Controllers\CabinetController::class, 'edit'])->name('document.cabinet_note.edit');
      Route::post('/document/cabinet_note/status',[App\Http\Controllers\CabinetController::class, 'status'])->name('document.cabinet_note.status');
      Route::post('/cabinet_note/delete',[App\Http\Controllers\CabinetController::class, 'destroy'])->name('cabinet_note.delete');
      Route::get('view-pdf/{file}', [App\Http\Controllers\CabinetController::class, 'viewPdf'])->name('view.pdf');
      Route::get('/admin/document/cabinet_note/get-divisions-by-user', [App\Http\Controllers\CabinetController::class, 'getDivisionsByUser'])->name('document.cabinet_note.get-divisions-by-user');
      Route::delete('/admin/document/cabinet_note/delete_file', [App\Http\Controllers\CabinetController::class, 'deleteFile'])->name('document.cabinet_note.delete_file');
});

Route::get('/get-designations/{roleId}', [App\Http\Controllers\UserController::class, 'getDesignations']);

Route::get('error404', [App\Http\Controllers\HomeController::class, 'error404'])->name('error404');

Route::post('/report-counts', [App\Http\Controllers\ReportController::class, 'getCounts']);



