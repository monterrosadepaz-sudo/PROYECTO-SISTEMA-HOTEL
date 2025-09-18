<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Booking;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('booking')->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $bookings = Booking::all();
        return view('admin.invoices.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount'     => 'required|numeric|min:0',
            'status'     => 'required|in:pendiente,pagada',
        ]);

        Invoice::create($request->all());

        return redirect()->route('admin.invoices.index')->with('success', 'Factura creada correctamente.');
    }

    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $bookings = Booking::all();
        return view('admin.invoices.edit', compact('invoice', 'bookings'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount'     => 'required|numeric|min:0',
            'status'     => 'required|in:pendiente,pagada',
        ]);

        $invoice->update($request->all());

        return redirect()->route('admin.invoices.index')->with('success', 'Factura actualizada.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Factura eliminada.');
    }
}
