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
    public function create($tipo){
        if ($tipo == "Cursos") {
            $subjects = Subject::all();
            return view('panel.create', compact('subjects', 'tipo'));
        }
        return view('panel.create', ['tipo' => $tipo]);
    }



    public function edit($tipo, $id){

        switch($tipo){
            case 'Estudiante':
                $student = Student::with('courses')->find($id);
                $courses = Course::all();
                $tablaRelacion = "Curso";

                return view('panel.edit', compact('student', 'courses', 'tipo', 'tablaRelacion'));
                break;
            case 'Profesor':
                $professor = Professor::with('commissions')->find($id);
                $tablaRelacion = "Comisión";       // tabla con relacion a esta entidad para el blade                            
                $commissions = Commission::all();
                
                return view('panel.edit-professor', compact('professor', 'commissions', 'tipo', 'tablaRelacion'));
                break;
                
            case 'Materia':
                $subject = Subject::find($id);
                $tablaRelacion = "";
                //$tablaRelacion = "Comisión";       // tabla con relacion a esta entidad para el blade                            
                //$commissions = Commission::all();
                
                return view('panel.edit-subject', compact('subject', 'tipo', 'tablaRelacion'));
                break;
            
                //  UPDATE 
            case 'Curso':
                $course = Course::with(['students', 'subject'])->findOrFail($id);
                $tablaRelacion = "Estudiantes";
                //$tablaRelacion = "Comisión";       // tabla con relacion a esta entidad para el blade                            
                $students = Student::all();
                $subjects = Subject::all();
                
                return view('panel.edit-course', compact('course', 'students', 'subjects', 'tipo', 'tablaRelacion'));
                break;
            /*
            case 'Comision':
                $commission = Commission::find($id);
                $tablaRelacion = "Profesor";
                //$tablaRelacion = "Comisión";       // tabla con relacion a esta entidad para el blade                            
                //$commissions = Commission::all();
                
                return view('panel.edit-commission', compact('commission', 'tipo', 'tablaRelacion'));
                break;
            */
        }

    }

    public function index($tipo)
    {
        $data = null;
        $titulo = $tipo;
        
        // Seleccionar qué datos cargar según el tipo
        switch ($tipo) {
            case 'Estudiantes':
                $data = Student::orderBy('created_at', 'desc')->paginate(12);
                
                return view('panel.index', compact('data', 'tipo', 'titulo',));
                break;
            
            case 'Materias':
                $data = Subject::orderBy('created_at', 'desc')->paginate(12);
                break;
            
            case 'Cursos':
                $data = Course::with(['commissions', 'subject'])
                        ->orderBy('created_at', 'desc') // Ordenar por fecha de creación, de más reciente a más antiguo
                        ->paginate(12);
                break;
            
            case 'Profesores':
                $data = Professor::orderBy('created_at', 'desc')->paginate(12);
                break;
            
            case 'Comisiones':
                $data = Commission::with(['course', 'professors'])
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(12);
                break;

            default:
                abort(404, 'Página no encontrada');
        }

        return view('panel.index', compact('data', 'titulo', 'tipo',));
    }

    public function show($tipo, $id){
        $data = null;
        $tituloBtnVolver = $tipo;
        if ($tipo == 'Profesores') {
            $titulo = 'Profesor';
        } elseif ($tipo == 'Comisiones'){
            $titulo = 'Comision';
        } else {
            $titulo = substr($tipo, 0, -1) ;  // elimina el ultimo caracter 'Estudiantes' -> 'Estudiante'
        }

        switch ($tipo) {
            case 'Estudiantes':
                $data = Student::with('courses')->findOrFail($id);
                break;

            case 'Profesores':
                $data = Professor::with('commissions')->findOrFail($id);
                break;

            case 'Materias':
                $data = Subject::with('courses')->findOrFail($id);
                break;

            case 'Cursos':
                $data = Course::with(['students', 'subject'])->findOrFail($id);
                break;

            case 'Comisiones':
                $data = Commission::with(['professors', 'course'])->findOrFail($id);
                break;

            default:
                abort(404, 'Tipo de recurso no encontrado.');
        }

        return view('panel.show', compact('data', 'titulo', 'tituloBtnVolver'));
    }
}

