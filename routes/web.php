<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\TypingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Absence_controller;
use App\Http\Controllers\AuthTestController;
use App\Http\Controllers\TeachingController;
use App\Http\Controllers\GroupTeachingController;
use App\Http\Controllers\justification_controller;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now storecreate something great!
|
*/



Route::view('/welecome','welecome');
Route::view('/','welecome');

// Log In
Route::controller(AuthTestController::class)->group(function () {
    Route::post('checkLoginGuard', 'checkLoginGuard')->name('checkLoginGuard');
    Route::get('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
    Route::get('{Auth}/Update/Password', 'updatePassword')->name('updatePassword');
    Route::post('Post/Update/Password', 'postUpdatePassword')->name('postUpdatePassword');
    Route::post('contact/Us', 'contactUs')->name('contactUs');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}/{userType}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');

});

// CRUD Teacher 
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::controller(TeacherController::class)->group(function () {
        Route::get('Dashboard', 'dashboard')->name('dashboard');
        Route::get('Manage/Teachers', 'manage')->name('manageTeacher');
        Route::post('Store/Teacher', 'store')->name('storeTeacher');
        Route::post('Destroy/Teacher', 'destroy')->name('destroyTeacher');
        Route::post('Edit/Teacher', 'edit')->name('editTeacher');
        Route::post('Update/Teacher', 'update')->name('updateTeacher');
        Route::get('Edit/Teacher/Password/{id}',  'editTeacherPassword')->name('editTeacherPassword');
        Route::post('Update/Teacher/Password',  'updateTeacherPassword')->name('updateTeacherPassword');
    });

    // END CRUD Teacher 
    // CRUD Student 
    // Route::resource('student',StudentController::class);
    Route::resource('students', StudentController::class,[
        'except'=>['show']
    ]);
    Route::controller(StudentController::class)->group(function () {
        Route::get('students/{student}/edit/password',  'editStudentPassword')->name('student.editPassword');
        Route::post('students/{student}/edit/password',  'updateStudentPassword')->name('updateStudentPassword');
        Route::get('students/excluded',  'displayExcludedStudents')->name('displayExcludedStudents');

    });

    // END CRUD Student 


    // CRUD Module Sections --------------------------------
    Route::controller(TypingController::class)->group(function () {
        Route::get('Manage/Module',  'manage')->name('manageModuleSections');
        Route::post('Store/Module',  'store')->name('storeTyping');
        Route::post('Destroy/module',  'destroy')->name('destroyTyping');
        Route::post('Edit/Module', 'edit')->name('editTyping');
        Route::post('Update/Module', 'update')->name('updateTyping');
    });

    // END CRUD Module Sections --------------------------------

    // CRUD Type Teaching  --------------------------------

    Route::controller(TeachingController::class)->group(function () {
        Route::get('Manage/Teaching',  'manage')->name('manageTeaching');
        Route::post('Store/Teaching',  'store')->name('storeTeaching');
        Route::post('Teaching/GetTypes',  'getTypes')->name('getTypes');
        Route::post('Destroy/Teaching',  'destroy')->name('destroyTeaching');
    });
    // END CRUD Type Teaching  --------------------------------




    Route::controller(GroupTeachingController::class)->group(function () {
        // CRUD Geoup Teaching  --------------------------------

        Route::get('Manage/Group/Teaching', 'manage')->name('manageGroupTeaching');
        Route::post('getModuleAndTypes_GrTeaching',  'getModuleAndTypes_GrTeaching')->name('getModuleAndTypes_GrTeaching');
        Route::post('getTypes_GrTeaching', 'getTypes_GrTeaching')->name('getTypes_GrTeaching');
        Route::post('Store/Group/Teaching', 'store')->name('storeGroupTeaching');
        Route::post('Destroy/Group/Teaching', 'destroy')->name('destroyGroupTeaching');


        // END CRUD Geoup Teaching  --------------------------------
    });

        Route::controller(justification_controller::class)->group(function () {
        Route::get('Display/Justifications',  'index')->name('displayJustifications');
        Route::post('Delete/Justifications',  'destroy')->name('deleteJustifications');
        Route::post('Decide',  'update')->name('decide');
        });
});




// CRUD Session

Route::prefix('Teacher')->middleware(['auth:teacher'])->group(function () {
    Route::get('Dashboard', [StudyController::class, 'dashboard'])->name('teacherDashboard');
    Route::get('manage/Study', [StudyController::class, 'manageStudy'])->name('manageStudy');
    Route::post('storeStudy', [StudyController::class, 'storeStudy'])->name('storeStudy');
    Route::post('list', [StudyController::class, 'list'])->name('list');
    Route::post('set/Absence', [StudyController::class, 'setAbsence'])->name('setAbsence');
    Route::get('view/Attendance/{module}/{type}/{group}', [StudyController::class, 'viewAttendance'])->name('viewAttendance');
    Route::post('updateAbsenceStatus', [StudyController::class, 'updateAbsenceStatus'])->name('updateAbsenceStatus');
    Route::post('deleteAbsence', [StudyController::class, 'deleteAbsence'])->name('deleteAbsence');
    Route::post('deleteSession', [StudyController::class, 'deleteSession'])->name('deleteSession');
    // END CRUD Session 
});

//  Student profile
Route::prefix('Student')->middleware(['auth:student'])->group(function () {
    Route::get('Dashboard', [justification_controller::class, 'student_dashboard'])->name('student_dashboard');
    Route::get('MyAbsence', [Absence_controller::class, 'index'])->name("SeeMyAbsence");
    Route::post('Store/justifications', [justification_controller::class,'store'])->name('justifications');
});
// END Student profile  