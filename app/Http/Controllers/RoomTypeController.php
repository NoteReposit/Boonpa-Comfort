<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomTypeController extends Controller
{
    public function index()
    {
        return Inertia::render('RoomTypes/Index', [
            'roomtypes' => RoomType::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('RoomTypes/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        RoomType::create($request->all());

        return redirect()->route('roomtypes.index')
            ->with('success', 'Room Type created successfully.');
    }

    public function edit(RoomType $roomtype)
    {
        return Inertia::render('RoomTypes/Edit', [
            'roomtype' => $roomtype
        ]);
    }

    public function update(Request $request, RoomType $roomtype)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $roomtype->update($request->all());

        return redirect()->route('roomtypes.index')
            ->with('success', 'Room Type updated successfully.');
    }

    public function destroy(RoomType $roomtype)
    {
        $roomtype->delete();

        return redirect()->route('roomtypes.index')
            ->with('success', 'Room Type deleted successfully.');
    }
}
