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

    function FiltrarAlumnos() {
        // Seleccionar todos los estudiantes cuyo nombre comience con 'A'
       return $students = Student::where('name', 'LIKE', 'A%')->get();
        
    }
    function Alumnos() {
        // Seleccionar todos los estudiantes cuyo nombre comience con 'A'
       return $students = Student::all();
        
    }

    function cursos()  {
        
        return Course::all();
    }

    function alumnos_del_curso2()  {
        $curso=Course::find(2);
        $alumnos=$curso->students()->get();

        return $alumnos;
    }

    function curso_materia() {
        
    // Seleccionar cursos y materias relacionados
    $courses = DB::table('courses')
    ->join('subjects', 'subjects.id', '=', 'courses.subject_id')
    ->get();


    return $courses;
    }


}
