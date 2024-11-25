<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Professor;
use App\Models\Commission;

class PanelController extends Controller
{
    public function index($tipo)
    {
        $data = [];
        $titulo = '';

        // Seleccionar qué datos cargar según el tipo
        switch ($tipo) {
            case 'alumnos':
                $data = Student::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Estudiantes';
                break;
            
            case 'materias':
                $data = Subject::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Materias';
                break;
            
            case 'cursos':
                $data = Course::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Cursos';
                break;
            
            case 'profesores':
                $data = Professor::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Profesores';
                break;

            default:
                abort(404, 'Página no encontrada');
        }

        return view('panel.index', compact('data', 'titulo', 'tipo'));
    }
}

