<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        $rooms = Room::all();
        return view('bookings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $room = Room::find($request->room_id);

        if ($room) {
            $cost = $this->calculateCost($room, $request->start_date, $request->end_date);  

           Booking::create([
                'room_id' => $request->room_id,
                'customer_name' => $request->customer_name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_cost' => $cost,
            ]);

           
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Room not found']);
    }

    public function calculateCost(Room $room, $startDate, $endDate)
    {
        $days = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
    
        $ratePerDay = $room->rate_per_day;
    
        if ($ratePerDay === null) {
            $ratePerDay = 0; 
        }
    
        return $days * $ratePerDay;
    }
    

    public function calculateRoomCost(Request $request, $roomId)
    {
        $room = Room::find($roomId);
        
        if ($room) {
            $cost = $this->calculateCost($room, $request->start_date, $request->end_date);
            return response()->json(['success' => true, 'cost' => $cost]);
        }

        return response()->json(['success' => false, 'message' => 'Room not found']);
    }
    
}
