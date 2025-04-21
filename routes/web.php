<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssementManagementController;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', function () {
    return redirect()->route('custom_middleware');
});

Auth::routes();

Route::get('/custom_middleware', [App\Http\Controllers\HomeController::class, 'custom_middleware'])->name('custom_middleware');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['admin'])->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/user-management/index', [UserManagementController::class, 'index'])->name('admin.user-management.index');
    Route::get('admin/user-management/create', [UserManagementController::class, 'create'])->name('admin.user-management.create');
    Route::post('admin/user-management/store', [UserManagementController::class, 'store'])->name('admin.user-management.store');
    Route::get('admin/user-management/edit/{id}', [UserManagementController::class, 'edit'])->name('admin.user-management.edit');
    Route::post('admin/user-management/update/{id}', [UserManagementController::class, 'update'])->name('admin.user-management.update');
    Route::get('admin/user-management/destroy/{id}', [UserManagementController::class, 'destroy'])->name('admin.user-management.destroy');
    Route::get('admin/user-management/customers', [UserManagementController::class, 'customers'])->name('admin.assessment-management.customers');

    Route::get('admin/assessment-management/create-assessment', [AssementManagementController::class, 'create'])->name('admin.assessment-management.create');
    Route::post('admin/assessment-management/store', [AssementManagementController::class, 'store'])->name('admin.assessment-management.store');
    Route::get('admin/assessment-management/preview/{assessment_code}', [AssementManagementController::class, 'assessment_preview'])->name('admin.assessment-management.assessment_preview');
    Route::post('admin/send_report/{assessment_no}', [AssementManagementController::class, 'send_report'])->name('send.report');
    Route::get('admin/assessment-management/download_report/{assessment_code}', [AssementManagementController::class, 'donwload_pdf_report'])->name('admin.assessment-management.donwload_pdf_report');

    Route::get('admin/assessment-management/setting/index', [AssementManagementController::class, 'setting_index'])->name('admin.assessment-management.setting.index');
    
    Route::post('admin/assessment-management/store_question', [AssementManagementController::class, 'store_question'])->name('admin.assessment-management.store_question');
    Route::get('admin/assessment-management/edit_question/{type_id}', [AssementManagementController::class, 'edit_question'])->name('admin.assessment-management.setting.edit_question');
    Route::post('admin/assessment-management/update_question/{question_id}', [AssementManagementController::class, 'update_question'])->name('admin.assessment-management.update_question');
    Route::get('admin/assessment-management/delete_question/{type_id}', [AssementManagementController::class, 'delete_question'])->name('admin.assessment-management.setting.delete_question');


    Route::post('admin/report_setting', [ReportController::class, 'store_report_setting'])->name('admin.report_setting');

});


Route::middleware(['employee'])->group(function () {

    Route::get('employee/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('employee.dashboard');
});
