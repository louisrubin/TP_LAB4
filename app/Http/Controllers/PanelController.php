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
        $student = '';     
        $courses = [];
        $titulo = '';

        switch($tipo){
            case 'estudiante':
                $student = Student::with('courses')->find($id);
                $courses = Course::all();
                $titulo = 'Editando Estudiante';
                break;
        }

        return view('panel.edit', compact('student', 'courses', 'titulo'));
    }

    public function index($tipo)
    {
        $data = [];
        $titulo = '';
        
        // Seleccionar qué datos cargar según el tipo
        switch ($tipo) {
            case 'alumnos':
                $data = Student::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Estudiantes';
                
                return view('panel.index', compact('data', 'tipo', 'titulo',));
                break;
            
            case 'materias':
                $data = Subject::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Materias';
                break;
            
            case 'cursos':
                $data = Course::with('subject')
                        ->orderBy('created_at', 'desc') // Ordenar por fecha de creación, de más reciente a más antiguo
                        ->paginate(12);
                $titulo = 'Cursos';
                break;
            
            case 'profesores':
                $data = Professor::orderBy('created_at', 'desc')->paginate(12);
                $titulo = 'Profesores';
                break;
            
            case 'comisiones':
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
            case 'estudiantes':
                $data = Student::with('courses')->findOrFail($id);
                $titulo = 'Estudiante';
                break;

            case 'profesores':
                $data = Professor::with('commissions')->findOrFail($id);
                $titulo = 'Profesor';
                break;

            case 'materias':
                $data = Subject::with('courses')->findOrFail($id);
                $titulo = 'Materia';
                break;

            case 'cursos':
                $data = Course::with(['commissions', 'subject'])->findOrFail($id);
                $titulo = 'Curso';
                break;

            case 'comisiones':
                $data = Commission::with(['professors', 'course'])->findOrFail($id);
                $titulo = 'Comision';
                break;

            default:
                abort(404, 'Tipo de recurso no encontrado.');
        }

        return view('panel.show', compact('data', 'titulo'));
    }
}

