<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Route;
use App\Models\Seat;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BookingController extends Controller
{
    public static function getAvailableSeats($from, $to)
    {
        $routes = Route::getRoutes($from, $to);
        $routes_info = [];
        foreach ($routes as $key => $route) {
            $route_available_seats = $route->getAvailableSeats();
            array_push($routes_info, $route_available_seats);
        }

        $result = [
            "available-seats" => false,
        ];

        if(empty($routes_info))
        {
            return $result;
        }

        $routes_info= Arr::flatten($routes_info, 1);

        $result["available-seats"] = true;
        $info = [];
        foreach ($routes_info as $key => $route_info) {
            $route = Route::find($route_info["route_id"]);
            $temp = [];
            $temp["from_station_id"] = $route->from_station;
            $temp["to_station_id"] = $route->to_station;
            $temp["available_seats"] = $route_info["available_seats_id"];
            if(count($temp["available_seats"]) == 0)
            {
                $result["available-seats"] = false;
            }
            array_push($info, $temp);
        }
        $result["routes_info"] = $info;
        return $result;
    }

    public static function bookSeat(Request $request)
    {
        $input = $request->input();
        $from_station_id = $input["from_station"];
        $to_station_id = $input["to_station"];
        $user_id = $input["user_id"];

        $result = [];
        $result["booking_status"] = false;

        $from_station = Station::find($from_station_id)->first();
        $to_station = Station::find($to_station_id)->first();
        $user = User::find($user_id);
        if(empty($from_station))
        {
            $result["message"] = "Start station does not exist.";
            return $result;
        }

        if(empty($to_station))
        {
            $result["message"] = "End station does not exist.";
            return $result;
        }

        if(empty($user))
        {
            $result["message"] = "User does not exist.";
            return $result;
        }


        $available_seats = self::getAvailableSeats($from_station_id, $to_station_id);
        if($available_seats["available-seats"] == false)
        {
            $result["message"] = "No available seats.";
            return $result;
        }

        $booked_seats = [];
        foreach ($available_seats["routes_info"] as $key => $route_info) {
            $route = Route::where('from_station', $route_info["from_station_id"])->where('to_station', $route_info["to_station_id"])->first();
            $trip = $route->trips->first();
            $seat = Seat::find($route_info["available_seats"][0]);

            $booking = new Booking();
            $booking->user()->associate($user);
            $booking->seat()->associate($seat);
            $booking->route()->associate($route);
            $booking->trip()->associate($trip);
            $booking->save();

            $booking = [
                "from_station_id" => $route->from_station,
                "to_station_id" => $route->to_station,
                "booked_seat_id" => $seat->id
            ];
            array_push($booked_seats, $booking);
        }
        $result["booking_status"] = true;
        $result["booked_seats"] = $booked_seats;

        return $result;
    }
}
