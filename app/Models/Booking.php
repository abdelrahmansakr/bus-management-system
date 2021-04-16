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

    public static function getAvailableTrips($from_station, $to_station)
    {
        $routes = Route::getRoutes($from_station, $to_station);
        $res = [];
        foreach ($routes as $key => $route) {
            $route_available_seats = $route->getAvailableSeats();
            array_push($res, $route_available_seats);
        }
        dd($res);

        $trip = Trip::where('from_station', $from_station)->where('to_station', $to_station)->first();
        // dd($trip);
        $trip_routes = $trip->routes;
        $res = [];
        foreach ($trip_routes as $key => $trip_route) {
            $route_available_seats = $trip_route->getAvailableSeats();
            array_push($res, $route_available_seats);
        }
        dd($res);
        $route = Route::where('from_station', $from_station)->where('to_station', $to_station)->first();
        $route_available_seats = $route->getAvailableSeats();
        dd($route_available_seats);
        $route_bookings = $route->bookings->groupBy('trip_id');
        $trips_bookings = [];
        foreach ($route_bookings as $key => $route_booking) {
            $trip_bookings["trip_id"] = $key;
            $trip_bookings["booked_seats_id"] = $route_booking->pluck('seat_id')->toArray();
            $trip_bookings["available_seats_id"] = Seat::whereNotIn('id', $trip_bookings["booked_seats_id"])->pluck('id')->toArray();
            array_push($trips_bookings, $trip_bookings);
        }
        dd($trips_bookings);
        dd($route_bookings[6]->pluck('seat_id'));
        // $seats_ids = [1,2,3,4];
        // $seats = Seat::whereNotIn('id', $seats_ids)->get();
        // dd($route);
        dd($route_bookings);
        // dd($seats);
    }

    public static function getRouteAvailableSeats($route)
    {

    }
}
