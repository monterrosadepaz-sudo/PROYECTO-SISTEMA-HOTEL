<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recepcionista\Checkout;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteIngresosController extends Controller
{
    // Mostrar el reporte en pantalla
    public function index(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        $query = Checkout::query();

        if ($desde) {
            $query->whereDate('fechaSalida', '>=', $desde);
        }
        if ($hasta) {
            $query->whereDate('fechaSalida', '<=', $hasta);
        }

        $checkouts = $query->orderByDesc('fechaSalida')->get();

        $totalEstadia  = $checkouts->sum('totalEstadia');
        $totalConsumos = $checkouts->sum('totalConsumos');
        $totalGeneral  = $checkouts->sum('totalGeneral');

        return view('admin.reportesIngresos', compact(
            'checkouts',
            'totalEstadia',
            'totalConsumos',
            'totalGeneral',
            'desde',
            'hasta'
        ));
    }

    // Generar PDF
    public function exportarPdf(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        $query = Checkout::query();

        if ($desde) {
            $query->whereDate('fechaSalida', '>=', $desde);
        }
        if ($hasta) {
            $query->whereDate('fechaSalida', '<=', $hasta);
        }

        $checkouts = $query->orderByDesc('fechaSalida')->get();

        $totalEstadia  = $checkouts->sum('totalEstadia');
        $totalConsumos = $checkouts->sum('totalConsumos');
        $totalGeneral  = $checkouts->sum('totalGeneral');

        $pdf = Pdf::loadView('admin.reportesIngresos', compact(
            'checkouts',
            'totalEstadia',
            'totalConsumos',
            'totalGeneral',
            'desde',
            'hasta'
        ));

        return $pdf->download('reporte_ingresos.pdf');
    }
}
