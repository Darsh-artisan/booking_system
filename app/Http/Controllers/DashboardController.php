<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $totalBookings = Booking::count();

        $totalRevenue = Booking::sum('total_cost');

        $todayBookings = Booking::whereDate('start_date', Carbon::today())->get();

        $availableRooms = Room::whereDoesntHave('bookings', function ($query) {
            $query->whereDate('start_date', Carbon::today())
                  ->orWhereDate('end_date', Carbon::today());
        })->get();

        return view('dashboard.index', compact('totalRooms', 'totalBookings', 'totalRevenue', 'todayBookings', 'availableRooms'));
    }
}
