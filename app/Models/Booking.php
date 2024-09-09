<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'customer_name',
        'start_date',
        'end_date',
        'total_cost',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
