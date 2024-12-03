<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    
    public function store(Request $request){

        $v= $request->validate(
            ['name'=>'required|string|max:255',
            'subject_id' => 'required', // Validar que el curso existe en la tabla courses 
        ]);

        $course = new Course();
        $course->name = $request->name;   
        $course->subject_id = $request->subject_id;     
        $course->save();

        return redirect()->route('panel.index' , 'Cursos')->with('success','Curso creado correctamente.');

    }

    public function update(Request $request, Course $course){

        //dd($request->course_id);
        $valid= $request->validate(
            ['name'=> 'required|string|max:255', 
             'subject_id'=> 'required|exists:subjects,id'
            ]
        );

        $course->update($valid);       // guardar los datos de name y email

        $studentIds = $request->input('students_id', []); // obtiene la lista del blade o default vacio

        $course->students()->sync($studentIds);

        return redirect()->route('panel.show', ['tipo'=>'Cursos', 'id'=>$course->id])->with('success','Curso actualizado correctamente.');       
    }

    
    public function destroy(Course $course){
        //dd( $student->id);
        $course->delete();
        return redirect()->route('panel.index' , 'Cursos')
                        ->with('success','Curso <'.$course->name.' - '.$course->subject->name.'> se eliminó');
    }
}
