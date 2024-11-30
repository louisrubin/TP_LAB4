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
        $tipo = 'alumnos';

        $data = Student::query()->where('name', 'LIKE', "$name%")->paginate(12);
       return view('panel.index', compact('data', 'titulo', 'tipo'));        
    }

    function FiltrarProfesores(Request $peticion) {

        $name = $peticion->input('name', ''); // Valor predeterminado: vacío
        $titulo = 'Profesores';
        $tipo = 'profesores';

        $data = Professor::query()->where('name', 'LIKE', "$name%")->paginate(12);
       return view('panel.index', compact('data', 'titulo', 'tipo'));        
    }

    function FiltrarMaterias(Request $peticion) {

        $name = $peticion->input('name', ''); // Valor predeterminado: vacío
        $titulo = 'Materias';
        $tipo = 'materias';

        $data = Subject::query()->where('name', 'LIKE', "$name%")->paginate(12);
       return view('panel.index', compact('data', 'titulo', 'tipo'));        
    }

    function FiltrarEntidad(Request $peticion) {

        // creando una funcion para que una sola funcion busque los registros dependiendo del tipo de entidad        
    }
}
