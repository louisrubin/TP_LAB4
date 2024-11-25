<?php
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
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
/*
Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [StudentController::class, 'index'])->name('home');//indico cula sera la ruta de inicio
Route::get('/students2', [StudentController::class, 'allStudents'])->name('students.section');//indico cula sera la ruta de inicio

Route::get('/calculate', [CalculationController::class, 'showForm'])->name('calculate.form');
Route::post('/calculate', [CalculationController::class, 'calculate'])->name('calculate.result');


    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);


    Route::get('/blog', function () {
        return view('nueva_vista.blog'); // Muestra la vista del blog
    });
    
    Route::get('/contacto', function () {
        return view('nueva_vista.contacto'); // Muestra la vista de contacto
    });


    Route::get('/Q_Materias', [App\Http\Controllers\consultasController::class, 'listarMaterias']);
    Route::get('/Q_Materias2', [App\Http\Controllers\consultasController::class, 'listarMaterias2']);
    Route::get('/Q_FiltrarAlumnos', [App\Http\Controllers\consultasController::class, 'FiltrarAlumnos'])->name('students.filter');
    Route::get('/Q_Alumnos', [App\Http\Controllers\consultasController::class, 'Alumnos']);
    Route::get('/Q_Cursos', [App\Http\Controllers\consultasController::class, 'cursos']);
    Route::get('/Q_alumnos_del_curso', [App\Http\Controllers\consultasController::class, 'alumnos_del_curso']);
    Route::get('/Q_curso_materia', [App\Http\Controllers\consultasController::class, 'curso_materia']);
    Route::get('/Q_CursosConMasDeTresEstudiantes', [App\Http\Controllers\consultasController::class, 'CursosConMasDeTresEstudiantes']);
    Route::get('/Q_ProfesoresEspecializacion', [App\Http\Controllers\consultasController::class, 'ProfesoresEspecializacion']);
    Route::get('/Q_EntreFechas', [App\Http\Controllers\consultasController::class, 'EntreFechas']);
    Route::get('/Q_NuevoEstudiante_Pedro', [App\Http\Controllers\consultasController::class, 'NuevoEstudiante_Pedro']);
    Route::get('/Q_FiltroEstudiantes_2', [App\Http\Controllers\consultasController::class, 'FiltroEstudiantes_2']);

           