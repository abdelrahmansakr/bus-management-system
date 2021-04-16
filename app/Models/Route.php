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

    public function getAvailableSeats()
    {
        $route_trips = $this->trips;
        $route_bookings = $this->bookings->groupBy('trip_id');

        $trips_available_seats = [];
        foreach ($route_trips as $key => $trip) {
            $trip_seats["trip_id"] = $trip->id;
            $trip_seats["route_id"] = $this->id;
            if($route_bookings->keys()->contains($trip->id))
            {
                $booking = $route_bookings[$trip->id];
                $trip_seats["booked_seats_id"] = $booking->pluck('seat_id')->toArray();
                $trip_seats["available_seats_id"] = Seat::whereNotIn('id', $trip_seats["booked_seats_id"])->pluck('id')->toArray();
            }
            else
            {
                $trip_seats["booked_seats_id"] = [];
                $trip_seats["available_seats_id"] = Seat::all()->pluck('id')->toArray();
            }
            array_push($trips_available_seats, $trip_seats);
        }
        return $trips_available_seats;
    }

    public static function getRoutes($from_station, $to_station)
    {
        $path_so_far = [];
        return self::getPath($path_so_far, $from_station, $to_station);
    }

    public static function getPath($path_so_far, $from_station, $to_station)
    {
        $route = Route::where('from_station', $from_station)->first();

        if($route == null)
        {
            return [];
        }

        array_push($path_so_far, $route);

        if($route->to_station == $to_station)
        {
            return $path_so_far;
        }

        return self::getPath($path_so_far, $route->to_station, $to_station);
    }
}
