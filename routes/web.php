<?php
use App\Http\Controllers\CalculationController;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\Course;




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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/calculate', [CalculationController::class, 'showForm'])->name('calculate.form');
Route::post('/calculate', [CalculationController::class, 'calculate'])->name('calculate.result');


Route::get('/saludo', [App\Http\Controllers\mensajesController::class, 'saludo'])->name('saludo.form');


Route::get('/create-student', function() {
     $student = new Student();
     $student->name = 'Juan Pérez';
     $student->email = 'juan.perez@example.com';
     //$student->course_id = 1; // Asegúrate de que el curso con ID 1 exista
     $student->save();
        return 'Estudiante creado exitosamente';
    });


    Route::get('/create-course', function() {
        $course = new Course();
        $course->name = 'Fisica';
        
        $course->save();
           return 'Curso creado exitosamente';
       });
    