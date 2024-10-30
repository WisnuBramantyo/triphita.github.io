<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function search(Request $request)
    {
        $tours = Tour::query();

        // Filter by tour destination if provided
        if ($request->filled('destination')) {
            // $tours->where('destination', 'like', '%', $request->destination . '%');
            $tours->where('name', 'like', '%' . $request->destination . '%');
        }

        // Filter by tour duration
        if ($request->filled('duration')) {
            $tours->where('duration', '==', $request->duration);
        }

        // Filter by available dates
        if ($request->filled('date')) {                  
            $tours->where('available_to', '==', $request->date);
        }

        // Filter by tour duration
        if ($request->filled('adults')) {
            $tours->where('adults', '<=', $request->adults);
        }

        // Filter by tour duration
        if ($request->filled('children')) {
            $tours->where('children', '<=', $request->children);
        }

         // Get the filtered tours
         $tours = $tours->get();

         // Pass the hotels to the view
        return view('welcome', compact('tours'));

    }
}
