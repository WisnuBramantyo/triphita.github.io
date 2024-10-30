<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index($hotel_id)
    {
        // List all rooms for a specific hotel
        $rooms = Room::where('hotel_id', $hotel_id)->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create($hotel_id)
    {
        // Display form to create a new room
        return view('rooms.create', ['hotel_id' => $hotel_id]);
    }

    public function store(Request $request)
    {
        // Store new room for a hotel
        Room::create($request->all());
        return redirect()->route('rooms.index', ['hotel_id' => $request->hotel_id]);
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->all());
        return redirect()->route('rooms.index', ['hotel_id' => $room->hotel_id]);
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('rooms.index', ['hotel_id' => $room->hotel_id]);
    }
}
