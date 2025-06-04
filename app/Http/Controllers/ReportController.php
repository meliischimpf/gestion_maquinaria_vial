<?php

namespace App\Http\Controllers;

use App\Models\Assignment; // Importa el modelo Assignment
use Carbon\Carbon;          // Importa Carbon para el manejo de fechas
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Importa la fachada de DomPDF

class ReportController extends Controller
{
    /**
     * Muestra un formulario para seleccionar el mes y año del reporte.
     *
     * @return \Illuminate\View\View
     */
    public function showAssignedMachinesReportForm()
    {
        $currentYear = Carbon::now()->year;
        $years = range($currentYear, $currentYear - 5); 

        return view('reports.assigned_machines_form', compact('years'));
    }

    /**
     * Genera un PDF de las máquinas asignadas para un mes y año específicos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function exportAssignedMachinesPdf(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1900|max:' . Carbon::now()->year,
        ]);

        $month = $request->input('month');
        $year = $request->input('year');

        $startDateOfMonth = Carbon::createFromDate($year, $month, 1)->startOfDay();
        $endDateOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();

        $assignments = Assignment::with(['machine', 'work'])
            ->where(function ($query) use ($startDateOfMonth, $endDateOfMonth) {
                $query->where('start_date', '<=', $endDateOfMonth)
                      ->where(function ($q) use ($startDateOfMonth) {
                          $q->whereNull('end_date') 
                            ->orWhere('end_date', '>=', $startDateOfMonth); 
                      });
            })
            ->orderBy('start_date', 'asc')
            ->get();

        $data = [
            'assignments' => $assignments,
            'monthName' => Carbon::createFromDate($year, $month, 1)->monthName, 
            'year' => $year,
        ];

        $pdf = Pdf::loadView('reports.assigned_machines_monthly_pdf', $data);

        $pdf->setPaper('A4', 'landscape');


        return $pdf->download('reporte_maquinas_asignadas_' . $data['monthName'] . '_' . $data['year'] . '.pdf');
    }
}