<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
        return Professor::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
        ]);

        return Professor::create($validated);
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
            return redirect()->back()->withErrors(['commissions_id' => 'Debes seleccionar al menos una comisión.']);
        }

        return redirect()->route('panel.show', ['tipo'=>'Profesores', 'id'=>$professor->id])->with('success','Profesor actualizado correctamente.');
    }

    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();

        return response()->json(['message' => 'Professor deleted successfully']);
    }
}