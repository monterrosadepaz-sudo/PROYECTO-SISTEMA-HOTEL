<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'type'  => 'required|in:individual,doble,suite',
            'price' => 'required|numeric|min:0',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Habitación creada correctamente.');
    }

    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name'  => 'required|string',
            'type'  => 'required|in:individual,doble,suite',
            'price' => 'required|numeric|min:0',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Habitación actualizada.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Habitación eliminada.');
    }
}
