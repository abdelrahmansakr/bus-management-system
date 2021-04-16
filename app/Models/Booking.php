<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
