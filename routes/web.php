<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use PhpParser\Comment\Doc;

Route::get('/', function () {
    return view('clinic.login.login');
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('clinic.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/patients',[PatientController::class,'allPatient'])->name('all.patient');
    Route::post('/save',[PatientController::class,'savePatient'])->name('patient.save');
    Route::post('/patients/{id}',[PatientController::class,'deletePatient'])->name('delete.patient');
    Route::get('/patient/{id}',[PatientController::class,'getPatient'])->name('get.patient');
    Route::put('patients-update/{id}',[PatientController::class,'patientUpdate'])->name('update.patient');
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/departments',[DepartmentController::class,'allDepartments'])->name('all.departments');
    Route::get('/department',[DepartmentController::class,'department'])->name('department');
    Route::post('/save-department',[DepartmentController::class,'saveDepartment'])->name('department.save');
    Route::get('/department/{id}',[DepartmentController::class,'getDepartment'])->name('get.department');
    Route::put('department-update/{id}',[DepartmentController::class,'updateDepartment'])->name('update.department');
    Route::post('/department/{id}',[DepartmentController::class,'deleteDepartment'])->name('delete.department');
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/doctors',[DoctorController::class,'allDoctors'])->name('all.doctors');
    Route::post('/save-doctor',[DoctorController::class,'saveDoctor'])->name('doctor.save');
    Route::get('/doctor/{id}',[DoctorController::class,'getDoctor'])->name('get.doctor');
    // Route::put('doctor-update/{id}',[DoctorController::class,'updateDoctor'])->name('update.doctor');
    // Route::post('/doctor/{id}',[DoctorController::class,'deleteDoctor'])->name('delete.doctor');
});

require __DIR__.'/auth.php';
