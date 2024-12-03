<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /*
    public function store(Request $request){

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

        return redirect()->route('panel.index' , 'Estudiantes')->with('success','Estudiante creado correctamente.');

    }
    
    public function edit($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        $courses = Course::all(); // Obtén todos los cursos disponibles para mostrar en el formulario
        
        return view('student.edit', compact('student', 'courses'));
    }
    */
    //
    public function update(Request $request, Course $course){

        //dd($request->course_id);
        $valid= $request->validate(
            ['name'=> 'required|string|max:255', 
             'subject_id'=> 'required|exists:subjects,id'
            ]
        );

        $course->update($valid);       // guardar los datos de name y email

        $studentIds = $request->input('students_id'); // Obtén solo los IDs de los cursos

        // Verifica si es un array válido antes de sincronizar
        if (is_array($studentIds)) {
            $course->students()->sync($studentIds); // Sincroniza los cursos seleccionados
        } else {
            return redirect()->back()->withErrors(['students_id' => 'Debes seleccionar al menos un alumno.']);
        }

        return redirect()->route('panel.show', ['tipo'=>'Cursos', 'id'=>$course->id])->with('success','Curso actualizado correctamente.');       
    }
    /*
    public function show(Student $student)
    {
        //dd($student->name);
        $student = Student::with(['courses.subject', 'courses.commissions'])->findOrFail($student->id);
        
        return view('student.show', compact('student'));
    }

    
    public function destroy(Request $request, Student $student){
        //dd( $student->id);
        $student->delete();
        return redirect()->route('panel.index' , 'Estudiantes')->with('success','Estudiante <'.$student->id.' - '.$student->name.'> se eliminó');
    }
        */
}
