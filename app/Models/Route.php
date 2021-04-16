<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    public function fromStation()
    {
        return $this->belongsTo(Station::class, 'from_station');
    }

    public function toStation()
    {
        return $this->belongsTo(Station::class, 'to_station');
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'route_trip', 'route_id', 'trip_id')->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'route_id');
    }
}
