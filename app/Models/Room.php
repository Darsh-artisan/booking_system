<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_no', 'room_type', 'bathtub', 'balcony', 'mini_bar', 'max_occupancy', 'rate_per_day'];


    public function rents()
    {
        return $this->hasMany(RoomRent::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
