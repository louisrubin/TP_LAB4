<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

class StudentController extends Controller
{
    //
    public function index()
    {
        //$students = Student::all();

        //return view('student.index',compact('students'));
        return view('home');
    }

    //
    public function create()
    {
        return view('student.edit');
    }

    //
    public function store(Request $request){
      
      //dd($request->name .' email    '.$request->email);

      $v= $request->validate(
        ['name'=>'required|string|max:255',
         'email'=>'required|email|unique:students,email,',
         //'course_id' => 'required|exists:courses,id', // Validar que el curso existe en la tabla courses 
      ]);

        $student = new Student();
        $student->name = $request->name; 
        $student->email = $request->email;      
        //$student->course_id =$request->course_id;        
        $student->save();    
        
        // Asociar el curso al estudiante en la tabla pivote
        //$student->courses()->attach($request->course_id);

        return redirect()->route('students.index')->with('success','Estudiante creado correctamente.');

    }

    public function edit($id)
    {
        /*$student = Student::find($id);
        return view('student.edit',compact('student'));
        */
        $student = Student::with('courses')->findOrFail($id);
        $courses = Course::all(); // Obtén todos los cursos disponibles para mostrar en el formulario
        
        return view('student.edit', compact('student', 'courses'));
    }

    //
    public function update(Request $request, Student $student){

        //dd($request->course_id);
        $valid= $request->validate(
            ['name'=>'required|string|max:255',
            'email'=>'required|email|unique:students,email,'.$student->id, 
            ]//'course_id'=>'required|exists:courses,id']
        );

        $courseIds = $request->input('course_id'); // Obtén solo los IDs de los cursos

        // Verifica si es un array válido antes de sincronizar
        if (is_array($courseIds)) {
            $student->courses()->sync($courseIds); // Sincroniza los cursos seleccionados
        } else {
            return redirect()->back()->withErrors(['course_id' => 'Debes seleccionar al menos un curso.']);
        }

        return redirect()->route('panel.show', ['tipo'=>'Estudiantes', 'id'=>$student->id])->with('success','Estudiante actualizado correctamente.');
    }

    public function show(Student $student)
    {
       //dd($student->name);
       $student = Student::with(['courses.subject', 'courses.commissions'])->findOrFail($student->id);
       
       return view('student.show', compact('student'));
    }

    //
    public function destroy(Request $request,Student $student){
       //dd( $student->id);
       $student->delete();
       return redirect()->route('panel.index' , 'Estudiantes')->with('success','Estudiante <'.$student->id.' - '.$student->name.'> se eliminó');
    }
}
