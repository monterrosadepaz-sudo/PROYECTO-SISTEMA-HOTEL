<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Customer;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['room', 'customer'])->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all();
        $customers = Customer::all();
        return view('admin.bookings.create', compact('rooms', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id'     => 'required|exists:rooms,id',
            'customer_id' => 'required|exists:customers,id',
            'check_in'    => 'required|date',
            'check_out'   => 'required|date|after:check_in',
            'status'      => 'required|in:pendiente,confirmada,cancelada',
        ]);

        Booking::create($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Reserva creada.');
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $rooms = Room::all();
        $customers = Customer::all();
        return view('admin.bookings.edit', compact('booking', 'rooms', 'customers'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'room_id'     => 'required|exists:rooms,id',
            'customer_id' => 'required|exists:customers,id',
            'check_in'    => 'required|date',
            'check_out'   => 'required|date|after:check_in',
            'status'      => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Reserva actualizada.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Reserva eliminada.');
    }
}
