<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

// Route::get('/', [TeacherController::class, 'index']);

Route::get('/', function(){
    return view('login');
});
Route::POST('/loginData', [TeacherController::class,'loginData']);


Route::middleware(['checklogin'])->group(function () {



    Route::get('studentDetails',[StudentController::class,'index']);
    
    Route::post('/addstudent', [StudentController::class,'addStudent']);
    
    Route::get('/delete-data/{id}',[StudentController::class,'deleteData']);
    Route::put('/update-data/{id}',[StudentController::class,'updateData']);
    
    
    
    Route::get('/get-student-data/{id}', [StudentController::class, 'getStudentData'])->name('students.getData');

    Route::get('/logout', [TeacherController::class, 'logout'])->name('logout');
    

});


// Route::post('/addstudent', [StudentController::class, 'store'])->name('students.store');
// Route::put('/update-data/{id}', [StudentController::class, 'update'])->name('students.update');
