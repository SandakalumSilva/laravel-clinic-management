<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DepartmentController;

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
    Route::post('/save-department',[DepartmentController::class,'saveDepartment'])->name('department.save');
});

require __DIR__.'/auth.php';
