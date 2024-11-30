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
    // FILTRA POR NOMBRE PARA CADA ENTIDAD ENVIADA DESDE EL BLADE
    function FiltrarEntidad(Request $peticion, $entidad) {

        $name = $peticion->input('name', ''); // Valor predeterminado: vacío
        $data = null;
        $titulo = $entidad; // necesita el blade

        if ($entidad == 'Estudiantes') {
            $data = Student::query()->where('name', 'LIKE', "$name%")->paginate(12);
        }   
        else if ($entidad == 'Profesores') {
            $data = Professor::query()->where('name', 'LIKE', "$name%")->paginate(12);
        }    
        else if ($entidad == 'Materias') {
            $data = Subject::query()->where('name', 'LIKE', "$name%")->paginate(12);
        }    
        else if ($entidad == 'Cursos') {
            $data = Course::query()->where('name', 'LIKE', "$name%")->paginate(12);
        }   
        else if ($entidad == 'Comisiones') {
            $data = Commission::query()->where('name', 'LIKE', "$name%")->paginate(12);
        }  
        
       return view('panel.index', compact('data', 'titulo')); 
    }
}
