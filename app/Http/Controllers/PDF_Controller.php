<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Professor; // Importa los modelos necesarios
use App\Models\Commission;
use App\Models\Course;

class PDF_Controller extends Controller
{
    public function exportToPdf($tipo)
    {
        // Define las entidades según el tipo
        switch ($tipo) {
            case 'Profesores':
                $data = Professor::all();
                $view = 'exports.professors'; // Vista Blade para profesores
                break;
            case 'Comisiones':
                $data = Commission::with(['course', 'professors'])->get();
                $view = 'exports.commissions'; // Vista Blade para comisiones
                break;
            case 'Cursos':
                $data = Course::with(['subject', 'students'])
                                ->get();
                $view = 'exports.export-courses'; // Vista Blade para cursos

                // Generar PDF
                $pdf = Pdf::loadView($view, compact('data'));
                return $pdf->download("{$tipo}.pdf");
                break;
            default:
                return redirect()->back()->with('error', 'Tipo no válido');
        }

        // Generar PDF
        $pdf = Pdf::loadView($view, compact('data'));
        return $pdf->download("{$tipo}.pdf");
    }
}
