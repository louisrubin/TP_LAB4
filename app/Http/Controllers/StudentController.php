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
        $students = Student::all();

        return view('student.index',compact('students'));
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

        // $student->update($v);
        //$student = Student::findOrFail($id);
        $student->update($valid);

        // Sincroniza el curso en la tabla pivote
        $student->courses()->sync([$request->course_id]);
        
        return redirect()->route('students.index')->with('success','Estudiante actualizado correctamente.');
    }

    public function show(Student $student)
    {
       //dd($student->name);
       return view('student.show',compact('student'));
    }

    //
    public function destroy(Request $request,Student $student){
       //dd( $student->id);
       $student->delete();
       return redirect()->route('students.index')->with('success','Estudiante '.$student->id.' se elimino');
    }
}
