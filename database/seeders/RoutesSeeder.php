<?php

namespace Database\Seeders;

use App\Models\Route;
use App\Models\Station;
use Illuminate\Database\Seeder;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Trip 1 - Routes
        $station_1 = Station::where('name', 'Cairo')->first();
        $station_2 = Station::where('name', 'Faiyum')->first();
        $station_3 = Station::where('name', 'Minya')->first();
        $station_4 = Station::where('name', 'Asyut')->first();

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


        // Trip 2 - Routes
        $station_1 = Station::where('name', 'Sohag')->first();
        $station_2 = Station::where('name', 'Qena')->first();
        $station_3 = Station::where('name', 'Luxor')->first();

        $route_1 = new Route();
        $route_1->fromStation()->associate($station_1);
        $route_1->toStation()->associate($station_2);
        $route_1->save();

        $route_2 = new Route();
        $route_2->fromStation()->associate($station_2);
        $route_2->toStation()->associate($station_3);
        $route_2->save();
    }
}
