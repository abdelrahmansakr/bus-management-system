<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function fromStation()
    {
        return $this->belongsTo(Station::class, 'from_station');
    }

    public function toStation()
    {
        return $this->belongsTo(Station::class, 'to_station');
    }

    public function routes()
    {
        return $this->belongsToMany(Route::class, 'route_trip', 'trip_id', 'route_id')->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'trip_id');
    }
}
