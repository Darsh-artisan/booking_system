@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>

    <div class="stats">
        <h3>Total Rooms: {{ $totalRooms }}</h3>
        <h3>Total Bookings: {{ $totalBookings }}</h3>
        <h3>Total Revenue: ${{ number_format($totalRevenue, 2) }}</h3>
    </div>

    <div class="today-bookings">
        <h3>Today's Bookings:</h3>
        @if($todayBookings->count() > 0)
            <ul>
                @foreach($todayBookings as $booking)
                    <li>{{ $booking->customer_name }} - Room {{ $booking->room->room_no }} ({{ $booking->start_date }} to {{ $booking->end_date }})</li>
                @endforeach
            </ul>
        @else
            <p>No bookings for today.</p>
        @endif
    </div>

    <div class="available-rooms">
        <h3>Available Rooms:</h3>
        @if($availableRooms->count() > 0)
            <ul>
                @foreach($availableRooms as $room)
                    <li>Room {{ $room->room_no }} ({{ $room->room_type }})</li>
                @endforeach
            </ul>
        @else
            <p>No rooms available today.</p>
        @endif
    </div>
@endsection
