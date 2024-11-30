<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Professor;
use App\Models\course_student;
use App\Models\Commission;

use Illuminate\Http\Request;

class consultasController extends Controller
{
    //Listar materias
    function listarMaterias() {
        // Seleccionar todos los nombres de los cursos
       return $courses = Subject::pluck('name');
    }

    //Listar materias
    function listarMaterias2() {
        // Seleccionar todos los nombres de los cursos
       return $courses = Subject::all();
    }

    function FiltrarAlumnos(Request $peticion) {

        $name = $peticion->input('name', ''); // Valor predeterminado: vacío
        $titulo = 'Estudiantes';
        $courses = Course::all();   // PETICION TODOS LOS CURSOS
        $tipo = 'alumnos';

        
        $students = Student::query();

        // Filtro por nombre si el campo no está vacío
        if (!empty($name)) {
            $students->where('name', 'LIKE', "$name%");
        }

        // Obtener los resultados
        $data = $students->paginate(12);

       return view('panel.index', compact('data', 'courses', 'titulo', 'tipo'));
        
    }

}
