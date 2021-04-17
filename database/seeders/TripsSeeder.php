<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Station;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Trip 1
        $station_1 = Station::where('name', 'Cairo')->first();
        $station_2 = Station::where('name', 'Asyut')->first();
        $bus_1 = Bus::find(1);

        $trip = new Trip();
        $trip->fromStation()->associate($station_1);
        $trip->toStation()->associate($station_2);
        $trip->bus()->associate($bus_1);
        $trip->save();


        // Trip 2
        $station_3 = Station::where('name', 'Sohag')->first();
        $station_4 = Station::where('name', 'Luxor')->first();
        $bus_2 = Bus::find(2);

        $trip = new Trip();
        $trip->fromStation()->associate($station_3);
        $trip->toStation()->associate($station_4);
        $trip->bus()->associate($bus_2);
        $trip->save();
    }
}
