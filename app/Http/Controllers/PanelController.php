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
    public function edit($tipo, $id){        
        $student = null;     
        $courses = [];

        switch($tipo){
            case 'Estudiante':
                $student = Student::with('courses')->find($id);
                $courses = Course::all();
                break;
        }

        return view('panel.edit', compact('student', 'courses', 'tipo'));
    }

    public function index($tipo)
    {
        $data = [];
        $titulo = '';
        
        // Seleccionar qué datos cargar según el tipo
        switch ($tipo) {
            case 'Estudiantes':
                $data = Student::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Estudiantes';
                
                return view('panel.index', compact('data', 'tipo', 'titulo',));
                break;
            
            case 'Materias':
                $data = Subject::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Materias';
                break;
            
            case 'Cursos':
                $data = Course::with('subject')
                        ->orderBy('created_at', 'desc') // Ordenar por fecha de creación, de más reciente a más antiguo
                        ->paginate(12);
                $titulo = 'Cursos';
                break;
            
            case 'Profesores':
                $data = Professor::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Profesores';
                break;
            
            case 'Comisiones':
                $data = Commission::with(['course', 'professors'])
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(12);
                $titulo = 'Comisiones';
                break;

            default:
                abort(404, 'Página no encontrada');
        }

        return view('panel.index', compact('data', 'titulo', 'tipo',));
    }

    public function show($tipo, $id){
        $data = null;
        $titulo = '';

        switch ($tipo) {
            case 'Estudiantes':
                $data = Student::with('courses')->findOrFail($id);
                $titulo = 'Estudiante';
                break;

            case 'Profesores':
                $data = Professor::with('commissions')->findOrFail($id);
                $titulo = 'Profesor';
                break;

            case 'Materias':
                $data = Subject::with('courses')->findOrFail($id);
                $titulo = 'Materia';
                break;

            case 'Cursos':
                $data = Course::with(['commissions', 'subject'])->findOrFail($id);
                $titulo = 'Curso';
                break;

            case 'Comisiones':
                $data = Commission::with(['professors', 'course'])->findOrFail($id);
                $titulo = 'Comision';
                break;

            default:
                abort(404, 'Tipo de recurso no encontrado.');
        }

        return view('panel.show', compact('data', 'titulo'));
    }
}

