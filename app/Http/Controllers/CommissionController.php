<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function store(Request $request){

        // verifica los campos traidos desde el blade
        $validated = $request->validate(
            ['aula'=>'required|string|max:255',
            'course_id' => 'required|exists:courses,id',       // nombre de tabla donde verificar id
            'professor_id' => 'required|exists:professors,id',     //      seguido campo id
            'professors_id' => 'nullable|array',        // Validar que sea un array
            'professors_id.*' => 'exists:professors,id',   // Validar que cada profesor exista
        ]);

        // ingreso de horario incorrecto
        if ($request->horario1 >= $request->horario2) {
            return redirect()->back()->with('error', 'El horario de entrada no puede ser mayor o igual al de salida.');
        }

        $commission = new Commission();
        $commission->aula = 'Aula ' . $request->aula;   
        $commission->horario = $request->horario1 . ' - ' . $request->horario2; 
        $commission->course_id = $request->course_id;           // asigna id de curso
        $commission->professor_id = $request->professor_id;     // asigna id de profesor
        
        $commission->save();    // guarda antes de asociar con cursos y profesores

        // Asignar los profesores a la comisión en la tabla pivote
        $commission->professors()->sync($request->professors_id);

        return redirect()->route('panel.index' , 'Comisiones')->with('success','Comisión creada correctamente.');

    }
    /*
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

    /*
    public function destroy(Course $course){
        //dd( $student->id);
        $course->delete();
        return redirect()->route('panel.index' , 'Cursos')
                        ->with('success','Curso <'.$course->name.' - '.$course->subject->name.'> se eliminó');
    }
    */
}
