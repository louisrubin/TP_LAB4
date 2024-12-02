<?php
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\SubjectController;
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



// ########## PANEL PERSONALIZADO PARA CADA ENTIDAD ##############

Route::get('/panel/{tipo}', [App\Http\Controllers\PanelController::class, 'index'])->name('panel.index');
Route::get('/panel/{tipo}/{id}', [App\Http\Controllers\PanelController::class, 'show'])->name('panel.show');

Route::get('/edit/{tipo}/{id?}', [App\Http\Controllers\PanelController::class, 'edit'])->name('panel.edit');
Route::get('/create/{tipo}', [App\Http\Controllers\PanelController::class, 'create'])->name('panel.create');   
Route::put('/update/{tipo}/{id}', [App\Http\Controllers\PanelController::class, 'update'])->name('panel.update');   


    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('professors', ProfessorController::class);
    Route::resource('subjects', SubjectController::class);


    Route::get('/blog', function () {
        return view('nueva_vista.blog'); // Muestra la vista del blog
    });
    
    Route::get('/contacto', function () {
        return view('nueva_vista.contacto'); // Muestra la vista de contacto
    });

    Route::get('/filtrar/{entidad}', [App\Http\Controllers\consultasController::class, 'FiltrarEntidad'])->name('entity.filter');

           