<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function search(Request $request)
    {
        $hotels = Hotel::query();

        // Filter by destination if provided
        if ($request->filled('destination')) {
            $hotels->where('destination', 'like', '%' . $request->destination . '%');
        }

        // Filter by available dates
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $hotels->where('available_from', '<=', $request->check_in)
                   ->where('available_to', '>=', $request->check_out);
        }

        // Filter by price limit if provided
        if ($request->filled('price_limit')) {
            $hotels->where('price', '<=', $request->price_limit);
        }

        // Filter by number of rooms if provided
        if ($request->filled('rooms')) {
            $hotels->where('rooms', '>=', $request->rooms);
        }

        // Get the filtered hotels
        $hotels = $hotels->get();

        // Pass the hotels to the view
        return view('welcome', compact('hotels'));
    }
}
