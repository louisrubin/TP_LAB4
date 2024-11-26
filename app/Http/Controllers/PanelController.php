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
        $ruta = '';
        // Seleccionar qué datos cargar según el tipo
        switch ($tipo) {
            case 'alumnos':
                $data = Student::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Estudiantes';
                $ruta = 'students.create';
                break;
            
            case 'materias':
                $data = Subject::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Materias';
                $ruta = 'subjects.create';
                break;
            
            case 'cursos':
                $data = Course::with('subject')
                        ->orderBy('created_at', 'desc') // Ordenar por fecha de creación, de más reciente a más antiguo
                        ->paginate(12);
                $titulo = 'Cursos';
                $ruta = 'courses.create';
                break;
            
            case 'profesores':
                $data = Professor::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Profesores';
                $ruta = 'professors.create';
                break;
            
            case 'comisiones':
                $data = Commission::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Comisiones';
                $ruta = 'commissions.create';
                break;

            default:
                abort(404, 'Página no encontrada');
        }

        return view('panel.index', compact('data', 'titulo', 'tipo', 'ruta'));
    }

    public function show($tipo, $id){
        $data = [];

        switch ($tipo) {
            case 'alumnos':

                break;
                
            default:
                abort(404, 'Página no encontrada');
        }
    }
}

