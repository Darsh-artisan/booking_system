<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_no' => 'required',
            'room_type' => 'required',
            'max_occupancy' => 'required|integer',
        ]);
    
        $room = Room::create([
            'room_no' => $validatedData['room_no'],
            'room_type' => $validatedData['room_type'],
            'max_occupancy' => $validatedData['max_occupancy'],
            'bathtub' => $request->has('bathtub') ? 1 : 0,
            'balcony' => $request->has('balcony') ? 1 : 0,
            'mini_bar' => $request->has('mini_bar') ? 1 : 0,
        ]);
    
        if ($request->has('rents')) {
            foreach ($request->rents as $rent) {
                $room->rents()->create($rent);
            }
        }
    
        return response()->json(['success' => true]);
    }

    public function calculateCost(Request $request, $id)
    {
        $room = Room::find($id);

        if ($room) {
            $startDate = new \DateTime($request->input('start_date'));
            $endDate = new \DateTime($request->input('end_date'));

            $interval = $startDate->diff($endDate);
            $days = $interval->days;

            $ratePerDay = 100; 
            $cost = $days * $ratePerDay;

            return response()->json(['success' => true, 'cost' => $cost]);
        }

        return response()->json(['success' => false]);
    }
}
