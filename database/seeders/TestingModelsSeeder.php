<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestingModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $station_1 = new Station();
        $station_1->name = "Station 1";
        $station_1->save();

        $station_2 = new Station();
        $station_2->name = "Station 2";
        $station_2->save();

        $station_3 = new Station();
        $station_3->name = "Station 3";
        $station_3->save();

        $station_4 = new Station();
        $station_4->name = "Station 4";
        $station_4->save();

        $bus = new Bus();
        $bus->save();

        $trip = new Trip();
        $trip->fromStation()->associate($station_1);
        $trip->toStation()->associate($station_4);
        $trip->bus()->associate($bus);
        $trip->save();

        $route_1 = new Route();
        $route_1->fromStation()->associate($station_1);
        $route_1->toStation()->associate($station_2);
        $route_1->save();

        $route_2 = new Route();
        $route_2->fromStation()->associate($station_2);
        $route_2->toStation()->associate($station_3);
        $route_2->save();

        $route_3 = new Route();
        $route_3->fromStation()->associate($station_3);
        $route_3->toStation()->associate($station_4);
        $route_3->save();

        $trip->routes()->attach($route_1->id);
        $trip->routes()->attach($route_2->id);
        $trip->routes()->attach($route_3->id);

        $user = new User();
        $user->name="Abdelrahman Sakr";
        $user->email="abdelrahmansakr@gmail.com";
        $user->password= Hash::make('123456');
        $user->save();

        $seat = new Seat();
        $seat->save();

        $booking = new Booking();
        $booking->user()->associate($user);
        $booking->seat()->associate($seat);
        $booking->route()->associate($route_3);
        $booking->trip()->associate($trip);
        $booking->save();
    }
}
