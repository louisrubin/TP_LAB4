<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($validated);

        return redirect()->route('panel.index', 'Materias')->with('success','Materia creada correctamente.');
    }

    // public function show($id)
    // {
    //     return Professor::findOrFail($id);
    // }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
        ]);
        $subject->update($validated);

        // $subjectsIds = $request->input('commissions_id'); // Obtén solo los IDs de los cursos

        // // Verifica si es un array válido antes de sincronizar
        // if (is_array($subjectsIds)) {
        //     $subject->commissions()->sync($subjectsIds); // Sincroniza los cursos seleccionados
        // } else {
        //     return redirect()->back()->withErrors(['commissions_id' => 'Debes seleccionar al menos una comisión.']);
        // }

        return redirect()->route('panel.show', ['tipo'=>'Materias', 'id'=>$subject->id])->with('success','Materia actualizada correctamente.');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('panel.index', 'Materias')->with('success','Materia eliminada correctamente.');
    }
}
