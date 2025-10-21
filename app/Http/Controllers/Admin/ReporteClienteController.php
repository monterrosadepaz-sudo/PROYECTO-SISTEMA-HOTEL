<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ClienteH;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteClienteController extends Controller
{
    /**
     * Muestra la vista HTML del reporte.
     */
    public function index()
    {
        $clientes = ClienteH::orderBy('created_at', 'desc')->get();
        return view('admin.reportesCliente', compact('clientes'));
    }

    /**
     * Genera el PDF del reporte.
     */
   public function generarPDF()
    {
    $clientes = ClienteH::orderBy('created_at', 'desc')->get();
    $pdf = Pdf::loadView('admin.reportesCliente', compact('clientes'));

    // Descarga directa del PDF
    return $pdf->download('reporte_clientes.pdf');
    }
}
