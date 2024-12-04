<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'commissions_id' => 'required|array', // Validar que sea un array
            'commissions_id.*' => 'exists:commissions,id', // Validar que cada comisión exista
        ]);

        // Crear el profesor
        $professor = Professor::create([
            'name' => $validated['name'],
            'specialization' => $validated['specialization'],
        ]);

        // Asignar la comisión al profesor en la tabla pivote
        $professor->commissions()->attach($validated['commissions_id']);

        return redirect()->route('panel.index', 'Profesores')->with('success','Profesor creado correctamente.');
    }

    public function show($id)
    {
        return Professor::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $professor = Professor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'specialization' => 'sometimes|string|max:255',
        ]);
        $professor->update($validated);

        $comissionsIds = $request->input('commissions_id'); // Obtén solo los IDs de los cursos

        // Verifica si es un array válido antes de sincronizar
        if (is_array($comissionsIds)) {
            $professor->commissions()->sync($comissionsIds); // Sincroniza los cursos seleccionados
        } else {
            return redirect()->back()->withErrors(['no_commission_asigned' => 'Debes seleccionar al menos una comisión.']);
        }

        return redirect()->route('panel.show', ['tipo'=>'Profesores', 'id'=>$professor->id])->with('success','Profesor actualizado correctamente.');
    }

    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();

        return redirect()->route('panel.index', 'Profesores')->with('success','Profesor eliminado correctamente.');
    }
}