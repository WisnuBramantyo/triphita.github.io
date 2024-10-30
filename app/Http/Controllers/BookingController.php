<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // List all bookings
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create($room_id)
    {
        // Display form to book a room
        $room = Room::findOrFail($room_id);
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request)
    {
        // Store new booking
        Booking::create($request->all());
        return redirect()->route('bookings.index');
    }

    public function show($id)
    {
        // Show booking details
        $booking = Booking::findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->route('bookings.index');
    }
}
